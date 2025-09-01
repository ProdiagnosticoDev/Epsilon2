<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;

class GestionUsuariosController extends Controller
{
    public function create(): View
    {     

        return view('paginas.Sistemas.gestion_roles'); // solo listado

    }

    public function obtenerUsuariosParaGestionDePermisos(){

        $sql = "SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.email, ge.descripcion as cargo, u.estado
                        FROM users u
                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
                        INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado";

        $q = DB::table(DB::raw("({$sql}) as sub"));
       // return DataTables::of($q)->toJson();

        return DataTables::of($q)
        ->addColumn('actions', fn ($u) =>
            view('paginas.partials.actions_gu', ['u' => $u])->render()
        )
        ->rawColumns(['actions'])   // permite HTML en la columna
        ->toJson();

    }

    public function show($id)
    {
        //this methode shows the data in a modal window
        /*
        $usuario = DB::selectOne("SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.email, ge.descripcion as cargo, u.estado
                        FROM users u
                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
						INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado
                        WHERE u.id = ?", [$id]);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado !'], 404);
        }


        return response()->json($usuario); // Retorna JSON para ajax
        */

        // 1) Tu SELECT “extendido” para el usuario
            $usuario = DB::selectOne("
                SELECT u.id, td.descripcion AS TipoDocumento, u.documento, u.name, u.email,
                    ge.descripcion AS cargo, u.estado
                FROM users u
                INNER JOIN tipo_documento td ON td.id = u.id_tipo_documento
                INNER JOIN grupo_empleado ge ON ge.id = u.id_grupo_empleado
                WHERE u.id = ?
            ", [$id]);

            if (!$usuario) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }

            // 2) Todos los roles (Spatie)
            $allRoles = Role::where('guard_name','web')->orderBy('name')->get(['id','name']);

            // 3) Nombres de roles actuales del usuario (consultando el pivot)
            $userRoleNames = DB::table('model_has_roles')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->where('model_has_roles.model_type', User::class)
                ->where('model_has_roles.model_id', $id)
                ->pluck('roles.name')
                ->toArray();

            // 4) Respuesta JSON para el modal (OJO con la clave: user vs usuario)
            return response()->json([
                'user' => [ // si tu JS usa data.user, deja 'user' aquí
                    'id'          => $usuario->id,
                    'name'        => $usuario->name,
                    'email'       => $usuario->email,
                    'documento'   => $usuario->documento,
                    'TipoDocumento'=> $usuario->TipoDocumento,
                    'cargo'       => $usuario->cargo,
                    'estado'      => $usuario->estado,
                ],
                'roles' => $allRoles->map(fn($r) => [
                    'id'   => $r->id,
                    'name' => $r->name,
                    'has'  => in_array($r->name, $userRoleNames),
                ])->values(),
            ]);
    }

    public function edit(User $usuario): View
    {
        $roles = Role::orderBy('name')->get(); // usa Eloquent de Spatie, no DB::select
        /*return view('paginas.Sistemas.gestion_roles', [
            'usuario' => $usuario,
            'roles'   => $roles,
        ]);*/
         return view('paginas.Sistemas.gestion_roles'); // solo listado
        
    }

    public function update(Request $request, User $usuario)
    {

        try {
            $data = $request->validate([
                'roles'   => ['array'],
                'roles.*' => ['string','exists:roles,name'],
            ]);

            $usuario->syncRoles($data['roles'] ?? []); // reemplaza por lo marcado
            //return back()->with('success', 'Roles actualizados');
            return redirect()->back()->with('success', 'Roles actualizados exitosamente !');

        }catch(\Exception $e){

            return redirect()->back()->with('error', 'Something went wrong!');
            
        }
    }

    
}
