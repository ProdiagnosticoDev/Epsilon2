<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CargarListaEquiposBiomedicos extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/equipos_biomedicos_legacy.csv');
        if (! File::exists($path)) {
            $this->command?->error("No se encontró el archivo: {$path}");
            return;
        }

        // Detecta tabla padre de la FK de sede (ajusta si tu FK apunta a otra tabla/columna)
        $fkSedeTable = Schema::hasTable('sede') ? 'sede' : (Schema::hasTable('sede') ? 'sede' : null);
        $fkSedePk    = 'idsede';
        $validSedes  = [];
        if ($fkSedeTable) {
            $validSedes = DB::table($fkSedeTable)->pluck($fkSedePk)->map(fn($v) => (int)$v)->all();
        }

        $toNull = function ($v) {
            $s = trim((string)$v);
            if ($s === '' || strcasecmp($s, 'NULL') === 0 || strcasecmp($s, 'N/A') === 0 || strcasecmp($s, 'NA') === 0) {
                return null;
            }
            return $s;
        };

        $h = fopen($path, 'r');
        if (! $h) {
            $this->command?->error("No se pudo abrir el archivo: {$path}");
            return;
        }

        $now = now();
        $lineNo = 0;
        $ok = 0;
        $fkMiss = 0;
        $sqlErr = 0;
        $unknownSedes = [];

        while (($raw = fgets($h)) !== false) {
            $lineNo++;
            $raw = trim($raw);
            if ($raw === '') continue;

            // Tu archivo viene como "...." con comillas dobles escapadas como ""
            if (strlen($raw) >= 2 && $raw[0] === '"' && substr($raw, -1) === '"') {
                $raw = substr($raw, 1, -1);
            }
            $raw = str_replace('""', '"', $raw);

            // CSV con coma y quote "
            $cols = str_getcsv($raw, ',', '"');
            if (count($cols) < 8) {
                $cols = array_pad($cols, 8, null);
            }

            // Orden correcto: id_referencia, idsede, equipo, marca, modelo, serie, nro_activo, estado
            [$idRef, $idSede, $equipo, $marca, $modelo, $serie, $nroActivo, $estado] = $cols;

            // Normalizaciones
            $idRef    = is_numeric($idRef) ? (int)$idRef : $idRef;
            $idSede   = $toNull($idSede);
            $idSede   = is_numeric($idSede) ? (int)$idSede : $idSede; // si no numérico quedará como string
            $serie    = $toNull($serie);
            $nroActivo= $toNull($nroActivo);
            $estado   = is_numeric($estado) ? (int)$estado : 1;

            // Chequeo FK idsede (si conocemos la tabla)
            if ($fkSedeTable && !is_null($idSede) && !in_array((int)$idSede, $validSedes, true)) {
                $fkMiss++;
                $unknownSedes[(string)$idSede] = true;
                $this->command?->warn("[L{$lineNo}] idsede={$idSede} no existe en {$fkSedeTable}. Fila: {$raw}");
                // seguimos, pero esto fallará si la FK está activa
            }

            $row = [
                'id_referencia' => $idRef,
                'idsede'        => $idSede,
                'equipo'        => trim((string)$equipo),
                'marca'         => trim((string)$marca),
                'modelo'        => trim((string)$modelo),
                'serie'         => $serie,
                'nro_activo'    => $nroActivo,
                'estado'        => $estado,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];

            // Inserta/actualiza UNA por UNA para capturar el error exacto
            try {
                DB::table('equipos_biomedicos')->updateOrInsert(
                    ['id_referencia' => $idRef],
                    $row
                );
                $ok++;
            } catch (QueryException $e) {
                $sqlErr++;
                $msg = $e->getMessage();
                // Muestra constraint si viene en el mensaje
                $this->command?->error("[L{$lineNo}] Error SQL: {$msg}");
                $this->command?->line("Fila → ".json_encode($row, JSON_UNESCAPED_UNICODE));
                // También lo mandamos al log
                \Log::error('EquiposBiomedicos seeding error', ['line'=>$lineNo, 'row'=>$row, 'error'=>$msg]);
                // continuamos con la siguiente
            }
        }
        fclose($h);

        // Resumen
        if (!empty($unknownSedes)) {
            $this->command?->warn('idsede inexistentes detectados: '.implode(', ', array_keys($unknownSedes)));
        }
        $this->command?->info("Listo. OK={$ok}, FK-miss (avisados)={$fkMiss}, SQL-errores={$sqlErr}.");

        // (Opcional) ajustar AUTO_INCREMENT del id (si lo tienes)
        try {
            $maxId = DB::table('equipos_biomedicos')->max('id');
            if ($maxId) {
                DB::statement('ALTER TABLE equipos_biomedicos AUTO_INCREMENT = '.((int)$maxId + 1));
            }
        } catch (\Throwable $e) {/* ignorar si no aplica */}
    }
}
