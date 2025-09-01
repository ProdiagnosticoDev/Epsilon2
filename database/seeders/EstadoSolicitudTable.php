<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSolicitudTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estadocompra')->insert([
            [
                'desc_estado_compra' => 'Sin Responder'
            ],
            [
                'desc_estado_compra' => 'En Tramite'
            ],
            [
                'desc_estado_compra' => 'Cumplido'
            ],
            [
                'desc_estado_compra' => 'Entregado'
            ],
            ]);
    }
}
