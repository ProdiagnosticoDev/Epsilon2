<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrearEstadosSolicitud extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estado_solicitud' )->insert([
            [
                'descestado_solicitud' => 'Enviado'
            ],
            [
                'descestado_solicitud' => 'En Proceso'
            ],
            [
                'descestado_solicitud' => 'Cumplido'
            ],
            [
                'descestado_solicitud' => 'No Cumplido'
            ],
            [
                'descestado_solicitud' => 'Aprobado'
            ],
            [
                'descestado_solicitud' => 'No Aprobado'
            ],
            [
                'descestado_solicitud' => 'En Tramite'
            ],
            [
                'descestado_solicitud' => 'Pre-Aprobado'
            ],
            [
                'descestado_solicitud' => 'Cancelada'
            ],
            [
                'descestado_solicitud' => 'Devuelto'
            ],
            [
                'descestado_solicitud' => 'Sin Asignar'
            ],
            [
                'descestado_solicitud' => 'Cerrado'
            ],
            [
                'descestado_solicitud' => 'Abierto'
            ],
            [
                'descestado_solicitud' => 'Cancelado'
            ],
            [
                'descestado_solicitud' => 'En Espera'
            ]

        ]);
    }
}
