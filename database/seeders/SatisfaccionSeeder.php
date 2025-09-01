<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatisfaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('satisfaccion')->insert(    [
            [
                'desc_satisfaccion' => 'Si',
                'activo' => '0'
            ],
            [
                'desc_satisfaccion' => 'No',
                'activo' => '0'
            ],
            [
                'desc_satisfaccion' => 'Sin responder',
                'activo' => '0'
            ],
            [
                'desc_satisfaccion' => 'En Tramite',
                'activo' => '0'
            ],
            [
                'desc_satisfaccion' => 'Cumplido',
                'activo' => '0'
            ],
            [
                'desc_satisfaccion' => '1',
                'activo' => '1'
            ],
            [
                'desc_satisfaccion' => '2',
                'activo' => '1'
            ],
            [
                'desc_satisfaccion' => '3',
                'activo' => '1'
            ],
            [
                'desc_satisfaccion' => '4',
                'activo' => '1'
            ],
            [
                'desc_satisfaccion' => '5',
                'activo' => '1'
            ],

            ]);
    }
}
