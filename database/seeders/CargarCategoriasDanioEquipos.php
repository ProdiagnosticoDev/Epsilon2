<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargarCategoriasDanioEquipos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement("SET @OLD_SQL_MODE := @@SESSION.sql_mode");

        // Add NO_AUTO_VALUE_ON_ZERO to the session (without blowing away other flags)
        DB::statement("
            SET SESSION sql_mode = CONCAT(
                @@SESSION.sql_mode,
                IF(@@SESSION.sql_mode = '' OR @@SESSION.sql_mode IS NULL, '', ','),
                'NO_AUTO_VALUE_ON_ZERO'
            )
        ");

        $rows = [
            [
                'id' => '0',  'descripcion' => 'Parcial'
            ],
            [
                'id' => '1', 'descripcion' => 'Total'
            ],

            ];

            DB::table('categoria_danio_equipo')->upsert(
            $rows,
            //['idservicio'],                            // conflict key
            ['id', 'descripcion', 'created_at', 'updated_at'] // columns to update
        );
    }
}
