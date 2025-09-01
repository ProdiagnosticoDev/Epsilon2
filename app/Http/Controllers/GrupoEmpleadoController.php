<?php

namespace App\Http\Controllers;

use App\Models\GrupoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoEmpleadoController extends Controller
{
    public function obtenerGrupoEmpleados(){

        //$grupoempleado = GrupoEmpleado::all();
        $grupoEmpleado = DB::select("select id, descripcion from grupo_empleado");

        return view("paginas.crear_usuarios", [
                    'grupoEmpleado' => $grupoEmpleado
        ]);

    }
}
