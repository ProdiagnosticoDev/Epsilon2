<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPrioridad extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_prioridad')->insert([
            [
                'desc_prioridad' => 'Alta',
                'fk_area' => '1'
            ],
            [
                'desc_prioridad' => 'Media',
                'fk_area' => '1'
            ],
            [
                'desc_prioridad' => '0 - 7 dias',
                'fk_area' => '3'
            ],
            [
                'desc_prioridad' => '7 - 15 dias',
                'fk_area' => '3'
            ],
            [
                'desc_prioridad' => '15 - 30 dias',
                'fk_area' => '3'
            ],
            [
                'desc_prioridad' => '1 - 2 dias',
                'fk_area' => '4'
            ],
            [
                'desc_prioridad' => '1 semana',
                'fk_area' => '4'
            ],
            [
                'desc_prioridad' => 'No Urgente: 4 - 5 días',
                'fk_area' => '9'
            ],
            [
                'desc_prioridad' => 'Urgente: 2 - 3 días',
                'fk_area' => '9'
            ],
            [
                'desc_prioridad' => 'Urgente',
                'fk_area' => '8'
            ],
            [
                'desc_prioridad' => 'No Urgente',
                'fk_area' => '8'
            ],
            [
                'desc_prioridad' => 'Urgente',
                'fk_area' => '2'
            ],
            [
                'desc_prioridad' => 'Baja',
                'fk_area' => '1'
            ],
            [
                'desc_prioridad' => 'No urgente',
                'fk_area' => '2'
            ]

        ]);
    }
}
