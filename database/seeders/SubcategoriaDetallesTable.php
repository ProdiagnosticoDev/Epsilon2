<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriaDetallesTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement("
            SET SESSION sql_mode = CONCAT(
                @@SESSION.sql_mode,
                IF(@@SESSION.sql_mode = '' OR @@SESSION.sql_mode IS NULL, '', ','),
                'NO_AUTO_VALUE_ON_ZERO'
            )
        ");

        $rows = [
            [ 'id' => 3 , 'descripcion' => 'Acceso remoto' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 4 , 'descripcion' => 'Cambio contraseña' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 5 , 'descripcion' => 'Creación usuario' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 6 , 'descripcion' => 'Permisos' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 7 , 'descripcion' => '' , 'estado' => '1' , 'idcategoria' => '6'],            
            [ 'id' => 8 , 'descripcion' => 'Inconsistencia desarrollo' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 9 , 'descripcion' => 'Actualizacion Aplicativo' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 10 , 'descripcion' => 'Cambiar Fecha Facturas' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 11 , 'descripcion' => 'Registro Dsiponibiliades' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 12 , 'descripcion' => 'Parametrización PSL' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 13 , 'descripcion' => 'Error BTW' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 14 , 'descripcion' => 'Epertura cuadro de turnos' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 15 , 'descripcion' => 'Inconsistencia usuario' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 16 , 'descripcion' => 'Agregar contenido' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 17 , 'descripcion' => 'Parameterización CUPS' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 18 , 'descripcion' => 'Cambiar estado' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 19 , 'descripcion' => 'Agregar cufe' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 20 , 'descripcion' => 'Registro Insumos Facturables' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 21 , 'descripcion' => 'Traslado de imágenes' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 22 , 'descripcion' => 'Restablecer imágenes' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 23 , 'descripcion' => 'Modificar datos' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 24 , 'descripcion' => 'Eliminar estudio' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 25 , 'descripcion' => 'Crear reporte EPSILON' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 26 , 'descripcion' => 'Crear reporte EPSILON' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 27 , 'descripcion' => 'Numero de acceso' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 28 , 'descripcion' => 'Revisar configuración' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 29 , 'descripcion' => 'Modificación de estudio' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 30 , 'descripcion' => 'Transferir ClearCanvas' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 31 , 'descripcion' => 'Usuarios combinados' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 32 , 'descripcion' => 'Paso de imágenes' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 33 , 'descripcion' => 'Apertura disponibilidades' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 34 , 'descripcion' => 'No cargan imágenes' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 35 , 'descripcion' => 'Modificar valores factura' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 36 , 'descripcion' => 'Error PSL' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 37 , 'descripcion' => 'Bloquear accesos' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 38 , 'descripcion' => 'Activar usuarios' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 39 , 'descripcion' => 'Agregar funcionalidada módulo' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 41 , 'descripcion' => 'Tablet' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 42 , 'descripcion' => 'Modificar valores tablas de entrada' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 43 , 'descripcion' => 'Modificar reporte EPSILON' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 44 , 'descripcion' => 'Eliminar nota aclaratoria' , 'estado' => '1' , 'idcategoria' => '1'],
            [ 'id' => 45 , 'descripcion' => 'Modificar plantilla portal de nómina' , 'estado' => '1' , 'idcategoria' => '1'],
        ];

        // subcategorias_detalles
        DB::table('subcategorias_detalles')->upsert(
            $rows,
            //['idservicio'],                            // conflict key
            ['id', 'descripcion', 'created_at', 'updated_at'] // columns to update
        );
    }
}
