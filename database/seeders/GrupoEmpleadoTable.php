<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoEmpleadoTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("grupo_empleado")->insert([
            [
                'descripcion' => 'Coordinadores'
            ],
            [
                'descripcion' => 'Auxiliar Administrativo'
            ],
            [
                'descripcion' => 'Enfermeria'
            ],
            [
                'descripcion' => 'Medicos'
            ],
            [
                'descripcion' => 'Tec. Imagenes Diagnosticas'
            ],
            [
                'descripcion' => 'Facturación y Auditoria'
            ],
            [
                'descripcion' => 'Logistica y Suministros'
            ],
            [
                'descripcion' => 'Talento Humano'
            ],
            [
                'descripcion' => 'Sistemas'
            ],
            [
                'descripcion' => 'Otros Cargos Administrativos'
            ],
            [
                'descripcion' => 'Servicios Generales'
            ],
            [
                'descripcion' => 'Practicante'
            ],
            [
                'descripcion' => 'Auxiliar Administrativo de Transcripción'
            ],
            [
                'descripcion' => 'Auxiliar Administrativo Call Center'
            ],
            [
                'descripcion' => 'Tecnologo en costos'
            ],
            [
                'descripcion' => 'Auxiliar Biomédico'
            ],
            [
                'descripcion' => 'Auditoría'
            ],
            [
                'descripcion' => 'Todos'
            ]
        ]);
    }
}
