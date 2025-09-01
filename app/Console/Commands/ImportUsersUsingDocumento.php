<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// php artisan make:command ImportUsersUsingDocumento
// php artisan users:import-from-legacy --only-active
// php artisan users:import-from-legacy

class ImportUsersUsingDocumento extends Command
{
    protected $signature = 'users:import-from-legacy {--chunk=500} {--only-active : Importar solo registros con idestado_actividad = 1}';
    protected $description = 'Importa usuarios desde legacy (funcionarios + usuario.email). Documento/clave = idfuncionario.';

    private array $map = [
        'table'     => 'funcionario',
        'order_key' => 'idfuncionario',
        'cols' => [
            'idfuncionario'       => 'idfuncionario',
            'nombres'             => 'nombres',
            'apellidos'           => 'apellidos',
            'id_grupo_empleado'   => 'idgrupo_empleado',
            'id_tipo_documento'   => 'idtipo_documento',
            'direccion'           => 'direccion',
            'fecha_nacimiento'    => 'fecha_nacimiento',
            'telefonos'           => 'telefonos',
            'estado_act'          => 'idestado_actividad',
            'salario'             => 'salario',
            'auxilio_transporte'  => 'auxtransporte',
            'fecha_ingreso'       => 'fecha_ingreso',
            'boss_ref'            => 'id_jefedirecto',
        ],
        'email_domain' => 'empresa.local',
        'emails' => [
            'table'             => 'usuario',
            'fk'                => 'idusuario', // igual a funcionarios.idfuncionario
            'email_candidates'  => ['email','correo','correo_electronico','mail','e_mail'],
            'active_candidates' => ['activo','estado','is_active','habilitado'],
            'prefer_domains'    => ['empresa.com'],
            // Si las conoces, puedes fijarlas:
            // 'email_col'  => 'correo',
            // 'active_col' => 'activo',
        ],
    ];

    public function handle()
    {
        $legacy = DB::connection('legacy')->table($this->map['table']);
        $c      = $this->map['cols'];
        $order  = $this->map['order_key'];

        // 🔎 Filtro opcional: solo activos
        if ($this->option('only-active')) {
            $legacy->where($c['estado_act'], 1);
        }

        $total = (clone $legacy)->count();
        if ($total === 0) {
            $msg = $this->option('only-active')
                ? 'No se encontraron funcionarios ACTIVOS (idestado_actividad = 1) en legacy.'
                : 'No se encontraron registros en legacy.';
            $this->warn($msg);
            return 0;
        }

        $this->info("Importando {$total} usuarios desde legacy" . ($this->option('only-active') ? ' (solo activos)…' : '…'));
        $this->output->progressStart($total);

        $created = $updated = $skipped = 0;
        $placeholderCount = 0;

        $legacyIdToNewId = []; // idfuncionario -> users.id
        $pendingBoss     = []; // [ newUserId => boss_idfuncionario ]

        $legacy->orderBy($order)->chunk((int)$this->option('chunk'), function ($rows) use (&$created, &$updated, &$skipped, &$placeholderCount, &$legacyIdToNewId, &$pendingBoss, $c) {
            foreach ($rows as $r) {
                $idfunc = trim((string)($r->{$c['idfuncionario']} ?? ''));
                if ($idfunc === '') { $skipped++; $this->output->progressAdvance(); continue; }

                $name  = trim(implode(' ', array_filter([
                    (string)($r->{$c['nombres']} ?? ''),
                    (string)($r->{$c['apellidos']} ?? ''),
                ]))) ?: "Usuario {$idfunc}";

                // Email desde `usuario` donde usuario.idusuario == funcionarios.idfuncionario
                $legacyEmail = $this->fetchLegacyEmailByFuncionarioId($idfunc);

                // Permite re-imports sin marcar como duplicado su propio email
                $existing = User::where('documento', $idfunc)->first();
                $email = $this->ensureUniqueEmail($legacyEmail, $idfunc, $existing?->id);
                if ($email === $this->placeholderEmail($idfunc)) $placeholderCount++;

                // Documento/clave inicial
                $doc = $idfunc;
                $plainPassword = $this->makePlainFromDocumento($doc);

                // Opcionales
                $telefono  = $this->nullableStr($r->{$c['telefonos']} ?? null);
                $direccion = $this->nullableStr($r->{$c['direccion']} ?? null);
                $fnac      = $this->dateOrNull($r->{$c['fecha_nacimiento']} ?? null);
                $fing      = $this->dateOrNull($r->{$c['fecha_ingreso']} ?? null);
                $estado    = $this->toBool($r->{$c['estado_act']} ?? 1) ? 1 : 0;

                // FKs seguras (NULL si no existen en tablas padre)
                $tipoDocIdRaw = $this->intOrNull($r->{$c['id_tipo_documento']} ?? null);
                $grupoIdRaw   = $this->intOrNull($r->{$c['id_grupo_empleado']} ?? null);
                $tipoDocId    = $this->ensureFk('tipo_documento', $tipoDocIdRaw);
                $grupoId      = $this->ensureFk('grupo_empleado', $grupoIdRaw);

                $payload = [
                    'name'               => $name,
                    'email'              => $email,
                    'documento'          => $doc,
                    'telefono'           => $telefono,
                    'direccion'          => $direccion,
                    'fecha_nacimiento'   => $fnac,
                    'fecha_ingreso'      => $fing,
                    'estado'             => $estado,
                    'id_tipo_documento'  => $tipoDocId,
                    'id_grupo_empleado'  => $grupoId,
                    'salario'            => $this->floatOrNull($r->{$c['salario']} ?? null),
                    'auxilio_transporte' => $this->floatOrNull($r->{$c['auxilio_transporte']} ?? null),
                    'password'           => Hash::make($plainPassword),
                    'email_verified_at'  => now(), // pon null si no quieres marcarlos verificados
                ];

                // Upsert por DOCUMENTO (más estable que email)
                $user = User::updateOrCreate(['documento' => $doc], $payload);

                $legacyIdToNewId[$idfunc] = $user->id;

                // Jefe (segunda pasada) — también es un idfuncionario
                $bossLegacy = $r->{$c['boss_ref']} ?? null;
                if (!empty($bossLegacy)) {
                    $pendingBoss[$user->id] = (string)$bossLegacy;
                }

                $user->wasRecentlyCreated ? $created++ : $updated++;
                $this->output->progressAdvance();
            }
        });

        // Segunda pasada: id_jefedirecto
        foreach ($pendingBoss as $newUserId => $bossLegacyIdfunc) {
            $bossNewId = $legacyIdToNewId[$bossLegacyIdfunc]
                ?? optional(User::where('documento', $bossLegacyIdfunc)->first())->id;

            if ($bossNewId) {
                User::whereKey($newUserId)->update(['id_jefedirecto' => $bossNewId]);
            }
        }

        $this->output->progressFinish();
        $this->info("Listo. Creados: {$created}, Actualizados: {$updated}, Omitidos: {$skipped}");
        if ($this->option('only-active')) $this->info("Filtro aplicado: idestado_actividad = 1");
        $this->info("Emails placeholder usados: {$placeholderCount} (formato: {idfuncionario}@{$this->map['email_domain']}).");
        $this->info("Contraseña inicial = DOCUMENTO (idfuncionario) sin separadores (bcrypt).");

        return 0;
    }

    // ===== Helpers =====

    private function fetchLegacyEmailByFuncionarioId(string $idfunc): ?string
    {
        $cfg   = $this->map['emails'];
        $table = $cfg['table'];   // 'usuario'
        $fk    = $cfg['fk'];      // 'idusuario'

        // Autodetectar columnas con SHOW COLUMNS (compatible MySQL/MariaDB antiguos)
        $columns  = $this->legacyColumns($table);
        $emailCol  = $cfg['email_col']  ?? $this->firstMatchingColumn($columns, $cfg['email_candidates']  ?? []);
        $activeCol = $cfg['active_col'] ?? $this->firstMatchingColumn($columns, $cfg['active_candidates'] ?? []);

        if (!$emailCol) return null;

        $q = DB::connection('legacy')->table($table)->where($fk, $idfunc);
        if ($activeCol) $q->where($activeCol, 1);

        $rows = $q->pluck($emailCol)
            ->filter()
            ->map(fn($e) => trim((string)$e))
            ->filter(fn($e) => $e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values();

        if ($rows->isEmpty()) return null;

        foreach (($cfg['prefer_domains'] ?? []) as $dom) {
            foreach ($rows as $e) {
                if (Str::endsWith(strtolower($e), '@'.strtolower($dom))) return $e;
            }
        }
        return $rows->first();
    }

    private function legacyColumns(string $table): array
    {
        static $cache = [];
        if (isset($cache[$table])) return $cache[$table];

        if (!preg_match('/^[A-Za-z0-9_]+$/', $table)) {
            throw new \RuntimeException("Invalid legacy table name: {$table}");
        }

        $rows = DB::connection('legacy')->select("SHOW COLUMNS FROM `{$table}`");
        $cols = [];
        foreach ($rows as $row) {
            $cols[] = $row->Field ?? $row->COLUMN_NAME ?? null;
        }
        return $cache[$table] = array_values(array_filter($cols));
    }

    private function firstMatchingColumn(array $columns, array $candidates): ?string
    {
        if (empty($columns) || empty($candidates)) return null;
        $lowerIndex = [];
        foreach ($columns as $col) $lowerIndex[strtolower($col)] = $col;
        foreach ($candidates as $cand) {
            $k = strtolower($cand);
            if (isset($lowerIndex[$k])) return $lowerIndex[$k];
        }
        return null;
    }

    private function placeholderEmail(string $idfunc): string
    {
        $domain = $this->map['email_domain'] ?? 'empresa.local';
        return "{$idfunc}@{$domain}";
    }

    private function ensureUniqueEmail(?string $email, string $idfunc, ?int $existingUserId = null): string
    {
        $email = $email ?: $this->placeholderEmail($idfunc);
        $ownerId = optional(User::where('email', $email)->first())->id;
        if ($ownerId && $ownerId !== $existingUserId) {
            $this->warn("Email duplicado '{$email}' para funcionario {$idfunc}; usando placeholder.");
            return $this->placeholderEmail($idfunc);
        }
        return $email;
    }

    private function makePlainFromDocumento(string $doc): string
    {
        $clean = preg_replace('/\D+/', '', $doc);
        return $clean !== '' ? $clean : trim($doc);
    }

    private function dateOrNull($v): ?string
    {
        if (empty($v)) return null;
        try { return Carbon::parse($v)->toDateString(); } catch (\Throwable $e) { return null; }
    }

    private function nullableStr($v): ?string
    {
        $s = trim((string)$v);
        return $s === '' ? null : $s;
    }

    private function toBool($v): bool
    {
        if (is_bool($v)) return $v;
        if (is_numeric($v)) return (int)$v > 0;
        $s = strtolower(trim((string)$v));
        return in_array($s, ['1','true','t','si','sí','y','yes','activo','act'], true);
    }

    private function intOrNull($v): ?int
    {
        if ($v === null || $v === '') return null;
        return is_numeric($v) ? (int)$v : null;
    }

    private function floatOrNull($v): ?float
    {
        if ($v === null || $v === '') return null;
        return (float)str_replace([','], ['.'], (string)$v);
    }

    private function ensureFk(string $table, ?int $id): ?int
    {
        if (!$id) return null;
        return DB::table($table)->where('id', $id)->exists() ? $id : null;
    }
}
