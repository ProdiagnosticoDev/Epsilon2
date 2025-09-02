<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CargarSolicitudesDesdeCsvSeeder extends Seeder
{
    /** Ruta del CSV */
    private const CSV_PATH = 'database/seeders/data/solicitud_legacy.csv';

    /** Tamaño del lote para inserción */
    private const BATCH_SIZE = 500;

    /** Si quieres desactivar FK checks durante la importación (útil si el CSV no está 100% consistente) */
    private const DISABLE_FK_CHECKS = true;

    public function run(): void
    {
        $path = base_path(self::CSV_PATH);
        if (! File::exists($path)) {
            $this->command->error("No se encontró el archivo CSV en: {$path}");
            return;
        }

        // Índice de users: documento => id
        $usersByDocumento = DB::table('users')
            ->select('id','documento')
            ->whereNotNull('documento')
            ->pluck('id', 'documento'); // ['CC123' => 5, ...]

        // Abrimos CSV con fgetcsv (delimitador coma, comillas dobles)
        $fh = fopen($path, 'r');
        if (! $fh) {
            $this->command->error("No se pudo abrir el archivo: {$path}");
            return;
        }

        // Encabezados
        $headers = fgetcsv($fh, 0, ',', '"', '"');
        if (! $headers) {
            fclose($fh);
            $this->command->error("El CSV no tiene encabezado o está vacío.");
            return;
        }

        // Normalizamos encabezados a minúsculas y sin espacios
        $normHeaders = array_map(fn($h) => $this->normKey($h), $headers);

        // Mapeo flexible de encabezado CSV -> columna destino
        // (si tu CSV tiene 'idsede', lo mapeamos a 'idseede', si trae 'ans' lo mapeamos a 'ANS')
        $headerToDb = [
            'idsolicitud'             => 'idsolicitud',
            'idseede'                 => 'idseede',
            'idsede'                  => 'idseede', // alias
            'idarea'                  => 'idarea',
            'desc_requerimiento'      => 'desc_requerimiento',
            'fechahora_solicitud'     => 'fechahora_solicitud',
            'fechahora_visita'        => 'fechahora_visita',
            'asunto'                  => 'asunto',
            'idfuncionario'           => 'idfuncionario',            // EN CSV viene documento, lo convertimos a users.id
            'idsatisfaccion'          => 'idsatisfaccion',
            'id_adquisicion'          => 'id_adquisicion',
            'horasolicitud'           => 'horasolicitud',
            'horavisita'              => 'horavisita',
            'idfuncionarioresponde'   => 'idfuncionarioresponde',    // EN CSV viene documento, lo convertimos a users.id
            'idprioridad'             => 'idprioridad',
            'id_estado_compra'        => 'id_estado_compra',
            'id_presupuesto'          => 'id_presupuesto',
            'id_referencia'           => 'id_referencia',
            'porque'                  => 'porque',
            'idservicio'              => 'idservicio',
            'monto'                   => 'monto',
            'cantidad'                => 'cantidad',
            'solicitud_asociada'      => 'solicitud_asociada',
            'fuera_servicio'          => 'fuera_servicio',
            'fecha_fuera_servicio'    => 'fecha_fuera_servicio',
            'fecha_puesta_marcha'     => 'fecha_puesta_marcha',
            'categoria_danio'         => 'categoria_danio',
            'fecha_entrega'           => 'fecha_entrega',
            'id_categoria'            => 'id_categoria',
            'id_subcategoria'         => 'id_subcategoria',
            'id_subcategoria_detalle' => 'id_subcategoria_detalle',
            'ans'                     => 'ANS',                       // alias a mayúsculas
            'cumplimiento_ans'        => 'cumplimiento_ans',
            'created_at'              => 'created_at',               // opcional en CSV
            'updated_at'              => 'updated_at',               // opcional en CSV
        ];

        // Posiciones: de índice CSV -> key normalizada
        $positions = [];
        foreach ($normHeaders as $i => $h) {
            $positions[$i] = $h;
        }

        if (self::DISABLE_FK_CHECKS) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $rows = [];
        $lineNo = 1; // ya leímos cabecera

        while (($data = fgetcsv($fh, 0, ',', '"', '"')) !== false) {
            $lineNo++;

            // Construir array asociativo normalizado (por header normalizado)
            $row = [];
            foreach ($data as $i => $value) {
                $key = $positions[$i] ?? null;
                if ($key !== null) {
                    $row[$key] = $this->raw($value);
                }
            }

            // Helper para obtener valores por encabezado (normalizado)
            $get = fn($key, $default = null) => $row[$this->normKey($key)] ?? $default;

            // Mapear documentos a users.id
            $idFuncionario = $this->mapDocumentoToUserId($get('idfuncionario'), $usersByDocumento, 'idfuncionario', $lineNo);
            $idFuncionarioResp = $this->mapDocumentoToUserId($get('idfuncionarioresponde'), $usersByDocumento, 'idfuncionarioresponde', $lineNo);

            // Fechas y horas
            $fechaSolicitud  = $this->toDateNN($get('fechahora_solicitud'), '1970-01-01', 'fechahora_solicitud', $lineNo);
            $fechaVisita     = $this->toDateNN($get('fechahora_visita'), '1970-01-01', 'fechahora_visita', $lineNo);
            $fueraServicio   = $this->toDateNN($get('fuera_servicio'), '1970-01-01', 'fuera_servicio', $lineNo);
            $fechaFueraServ  = $this->toDateNN($get('fecha_fuera_servicio'), '1970-01-01', 'fecha_fuera_servicio', $lineNo);
            $fechaPuesta     = $this->toDateNN($get('fecha_puesta_marcha'), '1970-01-01', 'fecha_puesta_marcha', $lineNo);
            $fechaEntrega    = $this->toDateNN($get('fecha_entrega'), '1970-01-01', 'fecha_entrega', $lineNo);

            $horaSolicitud   = $this->toTimeNN($get('horasolicitud'), '00:00:00', 'horasolicitud', $lineNo);
            $horaVisita      = $this->toTimeNN($get('horavisita'), '00:00:00', 'horavisita', $lineNo);

            // Campos NOT NULL con defaults seguros si faltan
            $idAdquisicion   = $this->toIntNN($get('id_adquisicion'), 0);
            $idPresupuesto   = $this->toIntNN($get('id_presupuesto'), 0);
            $cantidad        = $this->toIntNN($get('cantidad'), 0);
            $solAsociada     = $this->toIntNN($get('solicitud_asociada'), 0);
            $ans             = $this->toStrNN($get('ans') ?? $get('ANS'), '');
            $cumplAns        = $this->toStrNN($get('cumplimiento_ans'), '');
            $asunto          = $this->toStrNN($get('asunto'), '');
            $descReq         = $this->toStrNN($get('desc_requerimiento'), '');
            $porque          = $this->toStrNN($get('porque'), '');
            $monto           = $this->toStrNN($get('monto'), '');

            // Armamos registro destino
            $ins = [
                'idsolicitud'             => $this->toIntNN($get('idsolicitud'), null, true), // si falta, lanzamos aviso
                'idseede'                 => $this->toInt($get('idseede') ?? $get('idsede')),
                'idarea'                  => $this->toInt($get('idarea')),
                'desc_requerimiento'      => $descReq,
                'fechahora_solicitud'     => $fechaSolicitud,
                'fechahora_visita'        => $fechaVisita,
                'asunto'                  => $asunto,
                'idfuncionario'           => $idFuncionario,
                'idsatisfaccion'          => $this->toInt($get('idsatisfaccion')),
                'id_adquisicion'          => $idAdquisicion,
                'horasolicitud'           => $horaSolicitud,
                'horavisita'              => $horaVisita,
                'idfuncionarioresponde'   => $idFuncionarioResp,
                'idprioridad'             => $this->toInt($get('idprioridad')),
                'id_estado_compra'        => $this->toInt($get('id_estado_compra')),
                'id_presupuesto'          => $idPresupuesto,
                'id_referencia'           => $this->toInt($get('id_referencia')),
                'porque'                  => $porque,
                'idservicio'              => $this->toInt($get('idservicio')),
                'monto'                   => $monto,
                'cantidad'                => $cantidad,
                'solicitud_asociada'      => $solAsociada,
                'fuera_servicio'          => $fueraServicio,
                'fecha_fuera_servicio'    => $fechaFueraServ,
                'fecha_puesta_marcha'     => $fechaPuesta,
                'categoria_danio'         => $this->toInt($get('categoria_danio')),
                'fecha_entrega'           => $fechaEntrega,
                'id_categoria'            => $this->toInt($get('id_categoria')),
                'id_subcategoria'         => $this->toInt($get('id_subcategoria')),
                'id_subcategoria_detalle' => $this->toInt($get('id_subcategoria_detalle')),
                'ANS'                     => $ans,
                'cumplimiento_ans'        => $cumplAns,
                'created_at'              => $this->parseDateTimeOrNow($get('created_at')),
                'updated_at'              => $this->parseDateTimeOrNow($get('updated_at')),
            ];

            if ($ins['idsolicitud'] === null) {
                $this->command->warn("Línea {$lineNo}: falta 'idsolicitud', se omite la fila.");
                continue;
            }

            $rows[] = $ins;

            if (count($rows) >= self::BATCH_SIZE) {
                $this->flushBatch($rows);
                $rows = [];
            }
        }
        fclose($fh);

        if ($rows) {
            $this->flushBatch($rows);
        }

        // Ajustar AUTO_INCREMENT por si luego insertas sin id explícito
        $max = DB::table('solicitud')->max('idsolicitud') ?? 0;
        DB::statement('ALTER TABLE solicitud AUTO_INCREMENT = '.((int)$max + 1));

        if (self::DISABLE_FK_CHECKS) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $this->command->info('Seed de "solicitud" completado.');
    }

    /* ==================== Helpers ==================== */

    private function flushBatch(array $rows): void
    {
        // upsert por PK 'idsolicitud'
        DB::table('solicitud')->upsert(
            $rows,
            ['idsolicitud'],
            [
                'idseede','idarea','desc_requerimiento','fechahora_solicitud','fechahora_visita',
                'asunto','idfuncionario','idsatisfaccion','id_adquisicion','horasolicitud','horavisita',
                'idfuncionarioresponde','idprioridad','id_estado_compra','id_presupuesto','id_referencia',
                'porque','idservicio','monto','cantidad','solicitud_asociada','fuera_servicio',
                'fecha_fuera_servicio','fecha_puesta_marcha','categoria_danio','fecha_entrega',
                'id_categoria','id_subcategoria','id_subcategoria_detalle','ANS','cumplimiento_ans',
                'created_at','updated_at',
            ]
        );
    }

    private function normKey(?string $k): string
    {
        return strtolower(trim((string)$k));
    }

    private function raw($v)
    {
        if ($v === null) return null;
        // Limpia comillas sueltas, espacios, etc.
        $v = trim($v);
        $v = trim($v, " \t\n\r\0\x0B\"'");
        return $v;
    }

    private function isNullish($v): bool
    {
        if ($v === null) return true;
        $s = strtoupper(trim((string)$v));
        return $s === '' || $s === 'NULL' || $s === 'N/A' || $s === 'NA';
    }

    private function toInt($v): ?int
    {
        if ($this->isNullish($v)) return null;
        // valores como "1,234" → 1234
        return (int)preg_replace('/[^\d\-]/', '', (string)$v);
    }

    private function toIntNN($v, int $default = 0, bool $allowNull = false)
    {
        if ($this->isNullish($v)) return $allowNull ? null : $default;
        return $this->toInt($v) ?? ($allowNull ? null : $default);
    }

    private function toStrNN($v, string $default = ''): string
    {
        if ($this->isNullish($v)) return $default;
        return (string)$v;
    }

    private function toDate(?string $v): ?string
    {
        if ($this->isNullish($v)) return null;
        try {
            return Carbon::parse($v)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function toDateNN(?string $v, string $fallback, string $field, int $lineNo): string
    {
        $d = $this->toDate($v);
        if ($d === null) {
            // Aviso para rastrear si tu CSV trae vacíos en campos NOT NULL
            $this->command->warn("Línea {$lineNo}: '{$field}' vacío/invalid → usando {$fallback}");
            return $fallback;
        }
        return $d;
    }

    private function toTime(?string $v): ?string
    {
        if ($this->isNullish($v)) return null;
        $s = trim($v);
        // Intentamos varios formatos comunes
        $formats = ['H:i:s','H:i','g:i A','g:iA','H.i','H.i.s'];
        foreach ($formats as $fmt) {
            $dt = Carbon::createFromFormat($fmt, $s, config('app.timezone'));
            if ($dt !== false) {
                return $dt->format('H:i:s');
            }
        }
        // fallback parse genérico
        try {
            return Carbon::parse($s)->format('H:i:s');
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function toTimeNN(?string $v, string $fallback, string $field, int $lineNo): string
    {
        $t = $this->toTime($v);
        if ($t === null) {
            $this->command->warn("Línea {$lineNo}: '{$field}' vacío/invalid → usando {$fallback}");
            return $fallback;
        }
        return $t;
    }

    private function parseDateTimeOrNow($v): string
    {
        if ($this->isNullish($v)) return now()->toDateTimeString();
        try {
            return Carbon::parse($v)->toDateTimeString();
        } catch (\Throwable $e) {
            return now()->toDateTimeString();
        }
    }

    /**
     * Mapear documento (del CSV) a users.id usando el índice precargado.
     * Si no encuentra, devuelve NULL y muestra un warning.
     */
    private function mapDocumentoToUserId($raw, \Illuminate\Support\Collection $index, string $field, int $lineNo): ?int
    {
        if ($this->isNullish($raw)) return null;

        $doc = trim((string)$raw, "\"' \t\n\r\0\x0B");
        if ($doc === '') return null;

        // Búsqueda exacta
        if ($index->has($doc)) {
            return (int)$index->get($doc);
        }
        // Intento “suave” quitando espacios
        $docSoft = preg_replace('/\s+/', '', $doc);
        if ($docSoft !== $doc && $index->has($docSoft)) {
            return (int)$index->get($docSoft);
        }

        $this->command->warn("Línea {$lineNo}: documento '{$doc}' en '{$field}' no existe en users.documento → se guarda NULL.");
        return null;
    }
}
