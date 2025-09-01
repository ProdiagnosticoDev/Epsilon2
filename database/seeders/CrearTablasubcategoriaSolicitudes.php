<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrearTablasubcategoriaSolicitudes extends Seeder
{
    public function run(): void
    {
        $now = now();

        $rows = [
            ['id'=>1,  'descripcion'=>'Atasco papel',                     'estado'=>1, 'idcategoria'=>3, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,  'descripcion'=>'Instalación',                      'estado'=>1, 'idcategoria'=>3, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,  'descripcion'=>'Servicio técnico',                 'estado'=>1, 'idcategoria'=>3, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,  'descripcion'=>'Tonner',                           'estado'=>1, 'idcategoria'=>3, 'created_at'=>$now,'updated_at'=>$now],

            ['id'=>5,  'descripcion'=>'Diadema',                          'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,  'descripcion'=>'Disco duro',                       'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>7,  'descripcion'=>'Monitor',                          'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>8,  'descripcion'=>'Mouse',                            'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>9,  'descripcion'=>'Servicio técnico',                 'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>10, 'descripcion'=>'Teclado',                          'estado'=>1, 'idcategoria'=>5, 'created_at'=>$now,'updated_at'=>$now],

            ['id'=>11, 'descripcion'=>'Aquila',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>12, 'descripcion'=>'Bizneo',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>13, 'descripcion'=>'BTW',                              'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>14, 'descripcion'=>'CLEARCANVAS',                      'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>15, 'descripcion'=>'Correo',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>16, 'descripcion'=>'Daruma',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>17, 'descripcion'=>'Drago',                            'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>18, 'descripcion'=>'EPSILON',                          'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>19, 'descripcion'=>'Google',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>20, 'descripcion'=>'Horos',                            'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>21, 'descripcion'=>'Kpacs',                            'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>22, 'descripcion'=>'Moodle',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>23, 'descripcion'=>'Nómina Web',                       'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>24, 'descripcion'=>'Office',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>25, 'descripcion'=>'Osiris',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>26, 'descripcion'=>'PSL',                              'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>27, 'descripcion'=>'RIS',                              'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>28, 'descripcion'=>'TeamViewer',                       'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>29, 'descripcion'=>'ThunderBierd',                     'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>30, 'descripcion'=>'Weasis',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>31, 'descripcion'=>'WordPress',                        'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>32, 'descripcion'=>'ZkTeco',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>33, 'descripcion'=>'Zoiper',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>34, 'descripcion'=>'',                                 'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now], // vacío a propósito
            ['id'=>35, 'descripcion'=>'SIPE',                             'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>36, 'descripcion'=>'Portal pacientes',                 'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            // (no hay 37)
            ['id'=>38, 'descripcion'=>'Pacs',                             'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>39, 'descripcion'=>'Teams',                            'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
            ['id'=>40, 'descripcion'=>'Wolvox',                           'estado'=>1, 'idcategoria'=>1, 'created_at'=>$now,'updated_at'=>$now],
        ];

        // Inserta/actualiza sin duplicar (permite re-ejecutar)
        DB::table('subcategorias_solicitudes')->upsert(
            $rows,
            ['id'], // clave
            ['descripcion','estado','idcategoria','updated_at']
        );

        // Ajusta AUTO_INCREMENT para futuras inserciones
        $next = (int) DB::table('subcategorias_solicitudes')->max('id') + 1;
        DB::statement('ALTER TABLE subcategorias_solicitudes AUTO_INCREMENT = '.$next);
    }
}
