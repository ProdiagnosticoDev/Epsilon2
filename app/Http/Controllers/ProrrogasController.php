<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered; 
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ProrrogasController extends Controller
{ 
    
    public function create(): View
    {
        //return view('auth.register');///////////////////       

        $tipoDocumento = DB::select("SELECT * FROM tipo_documento");
        $grupoEmpleado = DB::select("SELECT id, descripcion FROM grupo_empleado");
        $listaUsuarios = DB::select("SELECT id, name FROM users where id_grupo_empleado = 1");
        $usuarios =  DB::select("SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.fecha_ingreso, u.email, ge.descripcion as cargo
                                        FROM users u
                                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
                                        INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado"); 

        $tipo_carta_th = DB::select("SELECT * FROM tipo_carta_th");                                                                                    

        //$usuarios = Usuarios::all();

        return view("paginas.TalentoHumano.Cartas.generar_prorrogas", [
            'tipoDocumento' => $tipoDocumento,
            'grupoEmpleado' => $grupoEmpleado,
            'listaUsuarios' => $listaUsuarios,
            'usuarios' => $usuarios,
            'tipo_carta_th' => $tipo_carta_th
        ]);
        

    } 
    
    
    public function obtenerUsuariosDatatable(){ 

        $sql = "SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.fecha_ingreso, u.email, ge.descripcion as cargo
                                        FROM users u
                                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
                                        INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado";

        $q = DB::table(DB::raw("({$sql}) as sub"));
      //return DataTables::of($q)->toJson();

        return DataTables::of($q)
        ->addColumn('actions', fn ($u) =>
            view('paginas.partials.actions_thcartas', ['u' => $u])->render()
        )
        ->rawColumns(['actions'])   // permite HTML en la columna
        ->toJson();

    }    


    public function generatePDF(Request $request)
    {
        //mirar todo el request
        //dd($request->all()); 

        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
        $date = date("Y-m-d");

        $user = Auth::user();

    
        $currentuser = $user["name"];

        $id_currentuser = $user["documento"];

        $data = [

            'date' => strftime('%d %B %Y',strtotime($date)),
            'name' => $request->input('name'),
            'TipoDocumento' => $request->input('TipoDocumento'),
            'documento' => $request->input('documento'),
            'cargo' => $request->input('cargo'),
            'tipo_carta' => $request->input('tipo_carta'),
            'fecha_ingreso' => $request->input('fecha_ingreso'),
            'fecha_fin' => $request->input('fecha_fin'),
            'currentuser' => $currentuser,
            'currentuser_id' => $id_currentuser,
        ];

        //dd($id_u);

        $pdf = Pdf::loadView('paginas.TalentoHumano.Cartas.pdfProrroga', $data);

        if($request->input('tipo_carta') == "1"){

            return $pdf->download('Prórroga_' . $request->input('name') . '.pdf');

        }else{

            return $pdf->download('No Prórroga_' . $request->input('name') . '.pdf');
        }

        //return $pdf->download('prorroga_' . now()->format('Ymd_His') . '.pdf');
    }


}
