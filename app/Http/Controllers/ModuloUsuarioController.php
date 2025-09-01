<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuloUsuarioController extends Controller
{
    public function create(){

        $modulos = Modulo::all();

        return view("paginas.TalentoHumano.gestion_roles", [
                'modulos' => $modulos,
        ]);
        

    }
}
