<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use App\Models\GrupoEmpleado;
use App\Models\TiposDocumento;
use App\Models\User;
use App\Models\Usuarios;
use App\Models\Gastos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class GastosController extends Controller
{
    public function inicio(Request $request){

        //dd($request->all()); 

        $user = Auth::user();

        $currentuser = $user['name'];

        $id_currentuser = $user['documento'];


        $tipoDocumento = DB::select('SELECT * FROM tipo_documento');
        $tipo_gastos = DB::select('SELECT id, descripcion, min, max FROM tipo_gastos');
        $listaUsuarios = DB::select('SELECT id, name FROM users where id_grupo_empleado = 1');
        //$usuarios =  DB::select('SELECT u.id, td.descripcion AS TipoDocumento, u.documento, u.name, u.email, ge.descripcion AS cargo, u.estado, u.id_jefedirecto, jefe.name AS nombre_jefe_directo FROM users u INNER JOIN tipo_documento td ON td.id = u.id_tipo_documento INNER JOIN grupo_empleado ge ON ge.id = u.id_grupo_empleado LEFT JOIN users jefe ON jefe.id = u.id_jefedirecto'); 

        
        $usuarios = DB::select("
                                                    
        SELECT 
	        re.documento,
            re.id, 
            re.fecha, 
            tg.descripcion AS tipo_gasto, 
            re.importe, 
            CASE 
                WHEN re.tipo_moneda = 1 THEN 'COP'
                WHEN re.tipo_moneda = 2 THEN 'USD'
                ELSE 'EUR'
            END AS moneda,
            re.descripcion
        FROM registro_gastos re
        INNER JOIN tipo_gastos tg ON tg.id = re.tipo_gasto
            WHERE re.currentuser = '$id_currentuser'
        "); 



        return view("paginas.TalentoHumano.Gastos.inicio", [
            'tipoDocumento' => $tipoDocumento,
            'tipo_gastos' => $tipo_gastos,
            'listaUsuarios' => $listaUsuarios,
            'usuarios' => $usuarios,
            'currentuser' => $id_currentuser

        ]);         
            


    } 


    public function tipo_gasto($id){

        //dd($request->all()); 

        $user = Auth::user();

        $currentuser = $user['name'];

        $id_currentuser = $user['documento'];


        $tipo_gastos = DB::select("SELECT id, min, max FROM tipo_gastos WHERE id = ?", [$id]);
        

        return response()->json([
            'tipo_gastos' => $tipo_gastos
        ]);      
            


    }   
    
    
public function store(Request $request) : RedirectResponse 
{
    

    $user = Auth::user();
    $currentuser = $user->name;
    $id_currentuser = $user->documento;

  //dd($id_currentuser);

    $request->validate([
        'documento' => ['required', 'string', 'max:255'],
        'fecha' => ['required', 'date'],
        'tipo_gasto' => ['required', 'int', 'exists:tipo_gastos,id'],
        'importe' => ['required', 'int'],
        'tipo_moneda' => ['required', 'int'],
        'descripcion' => ['required', 'string', 'max:255'],
    ]);

    try {
        $registro_gastos = Gastos::create([
            'documento' => $request->documento,
            'fecha' => $request->fecha,
            'tipo_gasto' => $request->tipo_gasto,
            'importe' => $request->importe,
            'tipo_moneda' => $request->tipo_moneda,
            'descripcion' => $request->descripcion,
            'currentuser' => $id_currentuser, // Usuario autenticado
        ]); 

        event(new Registered($registro_gastos));
        return redirect()->back()->with('success', 'Se registró el gasto exitosamente');

    } catch (\Exception $e) {
        //return redirect()->back()->with('error', 'Error: ' . $e->getMessage());

        dd($e->getMessage());
    }        
}



}
