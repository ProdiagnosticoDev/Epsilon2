<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSolicitudes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_solicitudes')->insert([
            [
                'descripcion' => 'Aplicativos',
                'estado' => 1,
            ],
            [
                'descripcion' => 'Cámaras',
                'estado' => 1,
            ],
            [
                'descripcion' => 'Impresoras',
                'estado' => 1,
            ],
            [
                'Infraestructura' => 'Infraestructura',
                'estado' => 1
            ],
            [
                'Infraestructura' => 'PC',
                'estado' => 1
            ],
            [
                'Infraestructura' => '',
                'estado' => 1
            ],

        ]);
    }
}
