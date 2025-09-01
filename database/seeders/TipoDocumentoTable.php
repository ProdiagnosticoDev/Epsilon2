<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_documento')->insert([
            [
                'descripcion' => 'Cédula de Ciudadanía',
                'codigo' => 'CC',
                'estado' => 1
            ],
            [
                'descripcion' => 'Cédula de Extranjería',
                'codigo' => 'CE',
                'estado' => 1
            ],
            [
                'descripcion' => 'Tarjeta de Identidad',
                'codigo' => 'TI',
                'estado' => 1
            ],
            [
                'descripcion' => 'Registro Civil',
                'codigo' => 'RC',
                'estado' => 1
            ],
            [
                'descripcion' => 'Otro',
                'codigo' => 'OT',
                'estado' => 1
            ],
            [
                'descripcion' => 'Pasaporte',
                'codigo' => 'PA',
                'estado' => 1
            ],
            [
                'descripcion' => 'Carnet diplomático',
                'codigo' => 'CD',
                'estado' => 1
            ],
            [
                'descripcion' => 'Permiso Especial de Permanencia',
                'codigo' => 'PE',
                'estado' => 1
            ],
            [
                'descripcion' => 'Código investigación',
                'codigo' => 'CO',
                'estado' => 1
            ],
            [
                'descripcion' => 'Adulto sin identificación',
                'codigo' => 'AS',
                'estado' => 1
            ],
            [
                'descripcion' => 'Menor sin identificación',
                'codigo' => 'MS',
                'estado' => 1
            ],
            [
                'descripcion' => 'Salvoconducto',
                'codigo' => 'SV',
                'estado' => 1
            ]
        ]);
    }
}
