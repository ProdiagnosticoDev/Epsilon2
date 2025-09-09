<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class CargarSolicitudesDesdeXLSSeeder extends Seeder
{
    /** Ruta del XLS/XLSX (ajústala si es necesario) */
    private const XLS_PATH = 'database/seeders/data/solicitud_legacy.xlsx';

    /** Tamaño de lote */
    private const BATCH_SIZE = 400;

    /** Desactivar FK checks durante la importación (opcional; déjalo en false para detectar errores reales) */
    private const DISABLE_FK_CHECKS = false;

    /** Nombre de la tabla destino */
    private const TABLE = 'solicitud';

    /** Meta del schema de columnas (llenado por loadTableSchema) */
    private array $tableSchema = [];

    /** Mapa de FKs: columna => [table, column] (llenado por loadForeignKeys) */
    private array $foreignKeys = [];

    /** Cache de existencia de valores por FK (col => [valor => bool]) para evitar consultas repetidas */
    private array $fkValueCache = [];

    public function run(): void
    {
        $path = base_path(self::XLS_PATH);
        if (!File::exists($path)) {
            $this->command->error("No se encontró el archivo Excel: {$path}");
            return;
        }

        // Índice de users: documento => id
        $usersByDocumento = DB::table('users')
            ->select('id', 'documento')
            ->whereNotNull('documento')
            ->pluck('id', 'documento'); // ['123456' => 5, ...]

        // ====== LEER XLSX CON PhpSpreadsheet ======
        $spreadsheet = IOFactory::load($path);
        $sheet       = $spreadsheet->getSheet(0); // primera hoja
        $rowsSheet   = $sheet->toArray(null, false, false, false);
        // ==========================================

        if (empty($rowsSheet)) {
            $this->command->error('El Excel está vacío.');
            return;
        }

        // Cargar metadatos de tabla y FKs
        $this->loadTableSchema();
        $this->loadForeignKeys();

        // La primera fila son encabezados:
        $headers = array_map(fn($h) => $this->normKey((string)$h), $rowsSheet[0] ?? []);
        if (empty($headers)) {
            $this->command->error('No se detectaron encabezados en la primera fila del Excel.');
            return;
        }

        // Posiciones: índice -> header normalizado
        $positions = [];
        foreach ($headers as $i => $h) {
            $positions[$i] = $h;
        }

        if (self::DISABLE_FK_CHECKS) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $batch     = [];
        $batchMeta = []; // paralelo a $batch: ['excel_line' => int, 'idsolicitud' => mixed]
        $lineNo    = 1; // ya contamos cabecera

        for ($r = 1; $r < count($rowsSheet); $r++) {
            $lineNo++;
            $rowArr = $rowsSheet[$r];

            // Ignora filas totalmente vacías
            if ($this->isBlankRow($rowArr)) continue;

            // Construye fila asociativa por header normalizado
            $src = [];
            foreach ($rowArr as $i => $val) {
                $key = $positions[$i] ?? null;
                if ($key !== null) {
                    $src[$key] = $val;
                }
            }

            // helper para obtener valor por header (normalizado)
            $get = function (string $key, $default = null) use ($src) {
                $nk = $this->normKey($key);
                return array_key_exists($nk, $src) ? $src[$nk] : $default;
            };

            // ids y texto
            $idsolicitud = $this->toIntOrNull($get('idsolicitud'));

            // Mapear documentos a users.id
            $idFuncionario     = $this->mapDocumentoToUserId($get('idfuncionario'), $usersByDocumento, 'idfuncionario', $lineNo);
            $idFuncionarioResp = $this->mapDocumentoToUserId($get('idfuncionarioresponde'), $usersByDocumento, 'idfuncionarioresponde', $lineNo);

            // ===== Fechas/Horas =====
            $fSolicitud   = $this->excelDateToYmd($get('fechahora_solicitud')) ?? null;
            // OJO: en Excel viene como "fecha_hora_visita"
            $fVisita      = $this->excelDateToYmd($get('fecha_hora_visita')) ?? null;
            // Flag/booleano (puede ser null)
            $fueraServFlg = $this->toIntOrNull($get('fuera_servicio'));
            // La fecha correcta es "fecha_fuera_servicio" (no "fuera_servicio")
            $fFechaFuera  = $this->excelDateToYmd($get('fecha_fuera_servicio')) ?? null;
            $fPuesta      = $this->excelDateToYmd($get('fecha_puesta_marcha')) ?? null;
            $fEntrega     = $this->excelDateToYmd($get('fecha_entrega')) ?? null;

            // Horas (conservan NULL si la celda está vacía)
            $hSolicitud   = $this->excelTimeToHis($get('horasolicitud')) ?? null;
            $hVisita      = $this->excelTimeToHis($get('horavisita'))    ?? null;

            // Construir inserción
            $ins = [
                'idsolicitud'             => $idsolicitud,
                'idsede'                  => $this->toIntOrNull($get('idsede')),
                'idarea'                  => $this->toIntOrNull($get('idarea')),
                'desc_requerimiento'      => $this->toStr($get('desc_requerimiento')),
                'fechahora_solicitud'     => $fSolicitud,
                'fechahora_visita'        => $fVisita,
                'idestado_solicitud'      => $this->toIntOrNull($get('idestado_solicitud')),
                'asunto'                  => $this->toStr($get('asunto')),
                'idfuncionario'           => $idFuncionario,
                'idsatisfaccion'          => $this->toIntOrNull($get('idsatisfaccion')),
                'id_adquisicion'          => $this->toIntOrNull($get('id_adquisicion')),
                'horasolicitud'           => $hSolicitud,
                'horavisita'              => $hVisita,
                'idfuncionarioresponde'   => $idFuncionarioResp,
                'idprioridad'             => $this->toIntOrNull($get('idprioridad')),
                'id_estadocompra'         => $this->toIntOrNull($get('id_estadocompra')),
                'id_presupuesto'          => $this->toIntOrNull($get('id_presupuesto')),
                'id_referencia'           => $this->toIntOrNull($get('id_referencia')),
                'porque'                  => $this->toStr($get('porque')),
                'idservicio'              => $this->toIntOrNull($get('idservicio')),
                'monto'                   => $this->toStr($get('monto')),
                'cantidad'                => $this->toIntDefault($get('cantidad'), 0),
                'solicitud_asociada'      => $this->toIntDefault($get('solicitud_asociada'), 0),
                'fuera_servicio'          => $fueraServFlg,            // puede ser NULL
                'fecha_fuera_servicio'    => $fFechaFuera,             // puede ser NULL o fecha
                'fecha_puesta_marcha'     => $fPuesta,
                'categoria_danio'         => $this->toIntOrNull($get('categoria_danio')),
                'fecha_entrega'           => $fEntrega,
                'id_categoria'            => $this->toIntOrNull($get('id_categoria')),
                'id_subcategoria'         => $this->toIntOrNull($get('id_subcategoria')),
                'id_subcategoria_detalle' => $this->toIntOrNull($get('id_subcategoria_detalle')),
                'ANS'                     => $this->toStr($get('ans') ?? $get('ANS') ?? ''),
                'cumplimiento_ans'        => $this->toStr($get('cumplimiento_ans') ?? ''),
                'created_at'              => $this->toDateTimeOrNow($get('created_at')),
                'updated_at'              => $this->toDateTimeOrNow($get('updated_at')),
            ];

            // Ajustar longitudes de columnas tipo string, si aplica (trunca y avisa)
            $ins = $this->fitStringsToSchema($ins, $lineNo, $idsolicitud);

            // Validación de FKs (corrige 0->NULL y chequea existencia)
            [$ins, $fkErrors] = $this->validateAndFixForeignKeys($ins, $lineNo, $idsolicitud);
            if (!empty($fkErrors)) {
                $this->command->error("Fila Excel {$lineNo} (idsolicitud: {$idsolicitud}): Se omite por FK(s) obligatoria(s) inexistente(s): " . implode(' | ', $fkErrors));
                break;
            }

            $batch[] = $ins;
            $batchMeta[] = ['excel_line' => $lineNo, 'idsolicitud' => $idsolicitud];

            if (count($batch) >= self::BATCH_SIZE) {
                $this->flushBatch($batch, $batchMeta);
                $batch = [];
                $batchMeta = [];
            }
        }

        if ($batch) {
            $this->flushBatch($batch, $batchMeta);
        }

        // Ajusta AUTO_INCREMENT para posteriores inserts sin id
        $max = DB::table(self::TABLE)->max('idsolicitud') ?? 0;
        DB::statement('ALTER TABLE ' . self::TABLE . ' AUTO_INCREMENT = ' . ((int)$max + 1));

        if (self::DISABLE_FK_CHECKS) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $this->command->info('Seed desde XLS a "' . self::TABLE . '" completado.');
    }

    /* ==================== Carga de meta (schema/FKs) ==================== */

    private function loadTableSchema(): void
    {
        $db    = DB::getDatabaseName();
        $table = self::TABLE;

        try {
            $rows = DB::select(
                "SELECT
                    COLUMN_NAME              AS column_name,
                    DATA_TYPE                AS data_type,
                    IS_NULLABLE              AS is_nullable,
                    CHARACTER_MAXIMUM_LENGTH AS char_len,
                    NUMERIC_PRECISION        AS num_precision,
                    NUMERIC_SCALE            AS num_scale
                 FROM information_schema.columns
                 WHERE table_schema = ? AND table_name = ?",
                [$db, $table]
            );
        } catch (\Throwable $e) {
            $rows = [];
            $this->command->warn("No se pudo leer information_schema.columns: {$e->getMessage()}");
        }

        $this->tableSchema = [];
        foreach ($rows as $r) {
            $c = (array)$r;
            $name = $c['column_name'] ?? null;
            if (!$name) continue;
            $this->tableSchema[$name] = [
                'data_type'     => strtolower((string)($c['data_type'] ?? 'varchar')),
                'is_nullable'   => strtoupper((string)($c['is_nullable'] ?? 'YES')) === 'YES',
                'char_len'      => $c['char_len'] ?? null,
                'num_precision' => $c['num_precision'] ?? null,
                'num_scale'     => $c['num_scale'] ?? null,
            ];
        }

        $this->command->info('Schema cargado: ' . count($this->tableSchema) . ' columnas.');
    }

    private function loadForeignKeys(): void
    {
        $db    = DB::getDatabaseName();
        $table = self::TABLE;

        try {
            $rows = DB::select(
                "SELECT
                    kcu.COLUMN_NAME            AS column_name,
                    kcu.REFERENCED_TABLE_NAME  AS ref_table,
                    kcu.REFERENCED_COLUMN_NAME AS ref_column
                 FROM information_schema.KEY_COLUMN_USAGE kcu
                 JOIN information_schema.TABLE_CONSTRAINTS tc
                   ON tc.CONSTRAINT_NAME = kcu.CONSTRAINT_NAME
                  AND tc.TABLE_SCHEMA    = kcu.TABLE_SCHEMA
                 WHERE tc.CONSTRAINT_TYPE = 'FOREIGN KEY'
                   AND kcu.TABLE_SCHEMA   = ?
                   AND kcu.TABLE_NAME     = ?",
                [$db, $table]
            );
        } catch (\Throwable $e) {
            $rows = [];
            $this->command->warn("No se pudo leer FKs: {$e->getMessage()}");
        }

        $this->foreignKeys = [];
        foreach ($rows as $r) {
            $c = (array)$r;
            if (!empty($c['column_name']) && !empty($c['ref_table']) && !empty($c['ref_column'])) {
                $this->foreignKeys[$c['column_name']] = [
                    'table'  => $c['ref_table'],
                    'column' => $c['ref_column'],
                ];
            }
        }

        $this->command->info('FKs detectadas: ' . count($this->foreignKeys));
    }

    /* ==================== Inserción por lotes con fallback ==================== */

    private function flushBatch(array $rows, array $metas): void
    {
        // Intento de upsert masivo
        try {
            DB::table(self::TABLE)->upsert(
                $rows,
                ['idsolicitud'], // PK
                [
                    'idsede','idarea','desc_requerimiento','fechahora_solicitud','fechahora_visita',
                    'asunto','idfuncionario','idsatisfaccion','id_adquisicion','horasolicitud','horavisita',
                    'idfuncionarioresponde','idprioridad','id_estadocompra','id_presupuesto','id_referencia',
                    'porque','idservicio','monto','cantidad','solicitud_asociada','fuera_servicio',
                    'fecha_fuera_servicio','fecha_puesta_marcha','categoria_danio','fecha_entrega',
                    'id_categoria','id_subcategoria','id_subcategoria_detalle','ANS','cumplimiento_ans',
                    'created_at','updated_at',
                ]
            );
            return; // éxito
        } catch (\Throwable $e) {
            $this->command->warn("Fallo el upsert por lote: {$e->getMessage()} → intentando fila a fila para ubicar errores…");
        }

        // Fallback: fila a fila para ubicar la que falla con detalle
        foreach ($rows as $i => $row) {
            $meta = $metas[$i] ?? ['excel_line' => '?', 'idsolicitud' => $row['idsolicitud'] ?? '?'];

            try {
                DB::table(self::TABLE)->upsert(
                    [$row],
                    ['idsolicitud'],
                    [
                        'idsede','idarea','desc_requerimiento','fechahora_solicitud','fechahora_visita',
                        'asunto','idfuncionario','idsatisfaccion','id_adquisicion','horasolicitud','horavisita',
                        'idfuncionarioresponde','idprioridad','id_estadocompra','id_presupuesto','id_referencia',
                        'porque','idservicio','monto','cantidad','solicitud_asociada','fuera_servicio',
                        'fecha_fuera_servicio','fecha_puesta_marcha','categoria_danio','fecha_entrega',
                        'id_categoria','id_subcategoria','id_subcategoria_detalle','ANS','cumplimiento_ans',
                        'created_at','updated_at',
                    ]
                );
            } catch (\Throwable $e) {
                $this->command->error(
                    "❌ Fila Excel {$meta['excel_line']} (idsolicitud: {$meta['idsolicitud']}): Motivo: {$e->getMessage()}"
                );
                // No lanzamos excepción para permitir seguir con las otras filas
            }
        }
    }

    /* ==================== Validaciones/ajustes por fila ==================== */

    private function fitStringsToSchema(array $row, int $excelLine, $idsolicitud): array
    {
        foreach ($row as $col => $val) {
            if (!array_key_exists($col, $this->tableSchema)) continue;

            $meta = $this->tableSchema[$col];
            $type = $meta['data_type'] ?? 'varchar';
            $len  = $meta['char_len'] ?? null;

            // Solo chequear tipos de longitud fija (char/varchar)
            if (is_string($val) && $len && in_array($type, ['char','varchar'])) {
                if (mb_strlen($val) > (int)$len) {
                    $this->command->warn("Fila Excel {$excelLine} (idsolicitud: {$idsolicitud}): valor en '{$col}' excede {$len} chars → se trunca.");
                    $row[$col] = mb_substr($val, 0, (int)$len);
                }
            }
        }
        return $row;
    }

    private function validateAndFixForeignKeys(array $row, int $excelLine, $idsolicitud): array
    {
        $errors = [];

        foreach ($this->foreignKeys as $col => $ref) {
            if (!array_key_exists($col, $row)) continue;

            $val = $row[$col];
            $nullable = $this->tableSchema[$col]['is_nullable'] ?? true;

            // 0 o vacío -> NULL si la columna lo permite
            $isZero = is_numeric($val) && (int)$val === 0;
            if ($val === null || $val === '' || $isZero) {
                if ($isZero && $nullable) {
                    $row[$col] = null;
                    $this->command->warn("Fila Excel {$excelLine} (idsolicitud: {$idsolicitud}): {$col}=0 → se cambia a NULL (FK).");
                } elseif (($val === '' || $val === null) && !$nullable) {
                    $errors[] = "FK obligatoria {$col} está vacía y la columna no acepta NULL.";
                }
                continue;
            }

            // Cache por columna/valor
            $cacheKey = (string)$val;
            if (!isset($this->fkValueCache[$col])) $this->fkValueCache[$col] = [];
            if (array_key_exists($cacheKey, $this->fkValueCache[$col])) {
                $exists = $this->fkValueCache[$col][$cacheKey];
            } else {
                $exists = DB::table($ref['table'])->where($ref['column'], $val)->exists();
                $this->fkValueCache[$col][$cacheKey] = $exists;
            }

            if (!$exists) {
                if ($nullable) {
                    $this->command->warn("Fila Excel {$excelLine} (idsolicitud: {$idsolicitud}): FK inválida {$col}={$val} → NO existe en {$ref['table']}.{$ref['column']} → se guarda NULL.");
                    $row[$col] = null;
                } else {
                    $errors[] = "FK inválida {$col}={$val} (no existe en {$ref['table']}.{$ref['column']}, y la columna no acepta NULL).";
                }
            }
        }

        return [$row, $errors];
    }

    /* ==================== Helpers ==================== */

    private function normKey(?string $k): string
    {
        // Normaliza: minúsculas + sin espacios ni guiones bajos
        $k = strtolower(trim((string)$k));
        return preg_replace('/[\s_]+/', '', $k);
    }

    private function isBlankRow(?array $row): bool
    {
        if (!$row) return true;
        foreach ($row as $v) {
            if (is_numeric($v)) return false;
            if (is_string($v) && trim($v) !== '') return false;
            if (!is_null($v)) return false;
        }
        return true;
    }

    private function isNullish($v): bool
    {
        if ($v === null) return true;
        if (is_string($v)) {
            $s = strtoupper(trim($v));
            return $s === '' || $s === 'NULL' || $s === 'N/A' || $s === 'NA';
        }
        return false;
    }

    private function toIntOrNull($v): ?int
    {
        if ($this->isNullish($v)) return null;
        if (is_numeric($v)) return (int)$v;
        $n = preg_replace('/[^\d\-]/', '', (string)$v);
        return $n === '' ? null : (int)$n;
    }

    private function toIntDefault($v, int $default = 0): int
    {
        $n = $this->toIntOrNull($v);
        return $n === null ? $default : $n;
    }

    private function toStr($v): string
    {
        if ($this->isNullish($v)) return '';
        return (string)$v;
    }

    private function tryExcelDate($v): ?Carbon
    {
        // Si es numérico, puede ser serie Excel (fecha/fecha-hora/tiempo)
        if (is_numeric($v)) {
            try {
                $dt = ExcelDate::excelToDateTimeObject((float)$v);
                return Carbon::instance($dt);
            } catch (\Throwable $e) {
                return null;
            }
        }
        // Si es string, intentar parsear con Carbon (flexible)
        if (is_string($v) && trim($v) !== '') {
            try {
                return Carbon::parse($v);
            } catch (\Throwable $e) {
                return null;
            }
        }
        return null;
    }

    private function excelDateToYmd($v): ?string
    {
        $c = $this->tryExcelDate($v);
        return $c ? $c->format('Y-m-d') : null;
    }

    private function excelTimeToHis($v): ?string
    {
        $c = $this->tryExcelDate($v);
        return $c ? $c->format('H:i:s') : null;
    }

    private function toDateTimeOrNow($v): string
    {
        if ($this->isNullish($v)) return now()->toDateTimeString();
        $c = $this->tryExcelDate($v);
        return $c ? $c->toDateTimeString() : now()->toDateTimeString();
    }

    /**
     * Mapea documento (del Excel) a users.id usando el índice precargado.
     * Si no encuentra, devuelve NULL y muestra un warning.
     */
    private function mapDocumentoToUserId($raw, \Illuminate\Support\Collection $index, string $field, int $lineNo): ?int
    {
        if ($this->isNullish($raw)) return null;

        $doc = trim((string)$raw, "\"' \t\n\r\0\x0B");
        if ($doc === '') return null;

        if ($index->has($doc)) return (int)$index->get($doc);

        // intento suave: quitar espacios
        $docSoft = preg_replace('/\s+/', '', $doc);
        if ($docSoft !== $doc && $index->has($docSoft)) {
            return (int)$index->get($docSoft);
        }

        $this->command->warn("Fila {$lineNo}: documento '{$doc}' en '{$field}' no existe en users.documento → se guarda NULL.");
        return null;
    }
}
