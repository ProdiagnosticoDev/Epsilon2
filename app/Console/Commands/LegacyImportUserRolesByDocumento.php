<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


// php artisan make:command LegacyImportUserRolesByDocumento

class LegacyImportUserRolesByDocumento extends Command
{
    protected $signature = 'legacy:import-roles-doc
        {--replace : Replace existing roles instead of merging}
        {--chunk=500 : Users chunk size}';

    protected $description = 'Import legacy roles for each user by matching documento';

    // ─────────── CONFIG: change these to your schema ───────────
    // If legacy tables are in another DB connection, set it here (and in config/database.php).
    private const LEGACY_CONN            = 'legacy'; // e.g. 'legacy' or null to use default

    // Legacy roles catalog table (id, name) — used to map IDs → role names
    private const LEGACY_ROLES_TABLE     = 'modulo'; // e.g. 'roles'

    // Legacy pivot table that stores role assignments per documento
    private const LEGACY_PIVOT_TABLE     = 'modulo_usuario'; // e.g. 'usuarios_roles'
    private const LEGACY_PIVOT_DOC_COL   = 'idusuario';  // FK to legacy user.documento (string)
    private const LEGACY_PIVOT_ROLE_ID   = 'idmodulo';    // FK to LEGACY_ROLES_TABLE.id
    // If your pivot stores role NAMES instead of IDs, see the comment below in handle().

    // Laravel users table documento column name
    private const LARAVEL_USER_DOC_COL   = 'documento';
    // ───────────────────────────────────────────────────────────

    public function handle(): int
    {
        $replace = (bool) $this->option('replace');
        $chunk   = (int) $this->option('chunk') ?: 500;

        $conn = self::LEGACY_CONN
            ? DB::connection(self::LEGACY_CONN)
            : DB::connection();

        // Map legacy role ID → role name (Spatie uses names)
        $idToName = $conn->table(self::LEGACY_ROLES_TABLE)->pluck('descmodulo', 'idmodulo')->all();

        // Optional: pre-build an index documento → [role_id,...] to minimize queries.
        // If the pivot is small(ish), this is convenient:
        $byDoc = $conn->table(self::LEGACY_PIVOT_TABLE)
            ->select([self::LEGACY_PIVOT_DOC_COL, self::LEGACY_PIVOT_ROLE_ID])
            ->get()
            ->groupBy(self::LEGACY_PIVOT_DOC_COL)
            ->map(fn($rows) => $rows->pluck(self::LEGACY_PIVOT_ROLE_ID)->all());

        $this->info('Starting import by documento…');

        User::query()->orderBy('id')->chunkById($chunk, function ($users) use ($byDoc, $idToName, $replace) {
            foreach ($users as $user) {
                $doc = $user->{self::LARAVEL_USER_DOC_COL};
                if (!$doc) {
                    $this->warn("User {$user->id} has empty documento — skipping");
                    continue;
                }

                // Normalize if needed (trim spaces; if your docs are strictly numeric, you
                // could also strip non-digits — adapt as appropriate)
                $docKey = $this->normalizeDocumento($doc);

                // Get legacy role IDs for this documento
                $legacyRoleIds = collect($byDoc->get($docKey, []));

                // If your pivot stores role NAMES instead of IDs, replace the two lines above with:
                // $legacyRoleNames = collect($byDoc->get($docKey, []))->map('strval');

                if ($legacyRoleIds->isEmpty()) {
                    // Not an error; just no roles in legacy for this documento
                    continue;
                }

                // Map IDs → names
                $names = $legacyRoleIds
                    ->map(fn($rid) => $idToName[$rid] ?? null)
                    ->filter()
                    ->values()
                    ->all();

                if (empty($names)) {
                    $this->warn("User {$user->id} documento {$docKey}: no matching role names for IDs");
                    continue;
                }

                try {
                    if ($replace) {
                        $user->syncRoles($names);      // overwrite any existing roles
                    } else {
                        $user->assignRole($names);     // merge with existing roles
                    }
                } catch (\Throwable $e) {
                    $this->warn("User {$user->id} documento {$docKey}: {$e->getMessage()}");
                }
            }
        });

        $this->callSilent('permission:cache-reset');
        $this->info('Import complete.');
        return self::SUCCESS;
    }

    private function normalizeDocumento($raw): string
    {
        // Adjust as needed for your data. For numeric-only IDs, you might prefer:
        // return preg_replace('/\D+/', '', (string) $raw);
        return trim((string) $raw);
    }
}
