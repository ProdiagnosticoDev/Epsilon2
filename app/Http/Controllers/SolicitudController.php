<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SolicitudController extends Controller
{
    public function create(): View
    {
        
        return view("paginas.Sistemas.gestion_solicitudes");      
    }



    public function list(){

            $sql = "SELECT so.idsolicitud,  s.descsede as sede , so.asunto, so.fechahora_solicitud,so.idestado_solicitud, so.horasolicitud, so.fechahora_visita, so.horavisita, sa.desc_satisfaccion, so.idsatisfaccion,s.descsede, est.descestado_solicitud, us.name as  nombre, so.idfuncionario, tp.desc_prioridad , us2.name as asignado_a, so.idfuncionarioresponde, cs.descripcion as categoria_descripcion
            from solicitud so
            inner join sede s on s.idsede = so.idsede
            inner join estado_solicitud est on est.idestado_solicitud = so.idestado_solicitud
            inner join users us on us.id = so.idfuncionario
            left join users us2 on us2.id = so.idfuncionarioresponde
            inner join tipo_prioridad tp on tp.idprioridad = so.idprioridad
            left join categorias_solicitudes cs on cs.id = so.id_categoria
            left join satisfaccion sa on sa.idsatisfaccion = so.idsatisfaccion
            WHERE so.idarea=1 AND fechahora_solicitud BETWEEN '2025-06-01' AND '2025-06-20' ";

        $q = DB::table(DB::raw("({$sql}) as sub"));
       // return DataTables::of($q)->toJson();

        return DataTables::of($q)
        ->addColumn('actions', fn ($u) =>
            view('paginas.partials.actions_gestion_solcitudes', ['u' => $u])->render()
        )
        ->rawColumns(['actions'])   // permite HTML en la columna
        ->toJson();



    }
}