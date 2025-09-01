<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrearTablaServicio extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
    DB::transaction(function () {

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
            [ 'idservicio' => 0 , 'descservicio' => 'Error de Servicio' , 'idestado_actividad' => '1' , 'alias' => null , 'idCentroCostos' => '0' ],
            [ 'idservicio' => 1 , 'descservicio' => 'Rayos X' , 'idestado_actividad' => '1' , 'alias' => 'CR' , 'idCentroCostos' => '11' ],
            [ 'idservicio' => 2 , 'descservicio' => 'Tomografía' , 'idestado_actividad' => '1' , 'alias' => 'CT' , 'idCentroCostos' => '22' ],
            [ 'idservicio' => 3 , 'descservicio' => 'Ecografia' , 'idestado_actividad' => '1' , 'alias' => 'US' , 'idCentroCostos' => '14' ],
            [ 'idservicio' => 4 , 'descservicio' => 'Estudios Especiales' , 'idestado_actividad' => '1' , 'alias' => 'RF' , 'idCentroCostos' => '16' ],
            [ 'idservicio' => 5 , 'descservicio' => 'Hemodinamia' , 'idestado_actividad' => '1' , 'alias' => 'XA' , 'idCentroCostos' => '18' ],
            [ 'idservicio' => 6 , 'descservicio' => 'Ecografías Ginecológica' , 'idestado_actividad' => '1' , 'alias' => 'US' , 'idCentroCostos' => '14' ],
            [ 'idservicio' => 7 , 'descservicio' => 'Biopsias y/o drenajes' , 'idestado_actividad' => '1' , 'alias' => 'US' , 'idCentroCostos' => '12' ],
            [ 'idservicio' => 8 , 'descservicio' => 'Unidad Gastro' , 'idestado_actividad' => '1' , 'alias' => 'XO' , 'idCentroCostos' => '15' ],
            [ 'idservicio' => 9 , 'descservicio' => 'Pletismografia' , 'idestado_actividad' => '1' , 'alias' => NULL , 'idCentroCostos' => '20' ],
            [ 'idservicio' => 10 , 'descservicio' => 'Resonancia Magnetica' , 'idestado_actividad' => '1' , 'alias' => 'MR' , 'idCentroCostos' => '21' ],
            [ 'idservicio' => 11 , 'descservicio' => 'General' , 'idestado_actividad' => '1' , 'alias' => NULL , 'idCentroCostos' => '0' ],
            [ 'idservicio' => 20 , 'descservicio' => 'Mamografia' , 'idestado_actividad' => '1' , 'alias' => 'MG' , 'idCentroCostos' => '19' ],
            [ 'idservicio' => 21 , 'descservicio' => 'Colposcopias y Conizaciones' , 'idestado_actividad' => '1' , 'alias' => '' , 'idCentroCostos' => '24' ],
            [ 'idservicio' => 22 , 'descservicio' => 'Apoyo' , 'idestado_actividad' => '1' , 'alias' => '' , 'idCentroCostos' => '0' ],
            [ 'idservicio' => 23 , 'descservicio' => 'Cirugia' , 'idestado_actividad' => '1' , 'alias' => 'CX' , 'idCentroCostos' => '17' ],
            [ 'idservicio' => 50 , 'descservicio' => 'Administrativo' , 'idestado_actividad' => '1' , 'alias' => '' , 'idCentroCostos' => '0' ],
            [ 'idservicio' => 51 , 'descservicio' => 'Ecografia Doppler' , 'idestado_actividad' => '1' , 'alias' => 'US' , 'idCentroCostos' => '14' ],
            [ 'idservicio' => 52 , 'descservicio' => 'Estudios Vasculares no Invasivos' , 'idestado_actividad' => '1' , 'alias' => 'XO' , 'idCentroCostos' => '20' ],        
            [ 'idservicio' => 53 , 'descservicio' => 'Procedimientos Ginecologicos' , 'idestado_actividad' => '1' , 'alias' => 'XO' , 'idCentroCostos' => '24' ],        
            [ 'idservicio' => 54 , 'descservicio' => 'Electrocardiograma' , 'idestado_actividad' => '2' , 'alias' => 'EKG' , 'idCentroCostos' => '0' ],        
            [ 'idservicio' => 55 , 'descservicio' => 'Valoracion preanestesica' , 'idestado_actividad' => '1' , 'alias' => 'VPA' , 'idCentroCostos' => '0' ],        
            [ 'idservicio' => 56 , 'descservicio' => 'Densitometria' , 'idestado_actividad' => '1' , 'alias' => 'OT' , 'idCentroCostos' => '25' ],        
            [ 'idservicio' => 58 , 'descservicio' => 'Servicios Tercerizados' , 'idestado_actividad' => '2' , 'alias' => NULL , 'idCentroCostos' => '0' ],        
            [ 'idservicio' => 100 , 'descservicio' => 'Capacitacion' , 'idestado_actividad' => '1' , 'alias' => NULL , 'idCentroCostos' => '0' ],        
            [ 'idservicio' => 101 , 'descservicio' => 'No tiene servicio' , 'idestado_actividad' => '1' , 'alias' => NULL , 'idCentroCostos' => '0' ],        
        ];

        DB::table('servicio')->upsert(
            $rows,
            //['idservicio'],                            // conflict key
            ['idservicio', 'descservicio', 'idestado_actividad', 'alias' , 'idCentroCostos', 'created_at', 'updated_at'] // columns to update
        );

    });

    }
}
