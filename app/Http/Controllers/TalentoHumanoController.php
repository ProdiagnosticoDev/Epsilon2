<?php

namespace App\Http\Controllers;

use App\Models\GrupoEmpleado;
use App\Models\TiposDocumento;
use App\Models\User;
use App\Models\Usuarios;
use App\TraitInsertUser as AppTraitInsertUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class TalentoHumanoController extends Controller
{    

    /*
    if (Auth::check()) {
        $user   = Auth::user();   // App\Models\User
        $id     = $user->id;
        $email  = $user->email;
        $nombre = $user->name;

        // Cualquier otro campo de tu tabla users:
        $doc    = $user->documento;
        $grupo  = $user->id_grupo_empleado;
    } 
    */
    
    public function create(): View
    {
        
        $tipoDocumento = DB::select("SELECT * FROM tipo_documento");
        $grupoEmpleado = DB::select("SELECT id, descripcion FROM grupo_empleado");
        $listaUsuarios = DB::select("SELECT id, name FROM users where id_grupo_empleado = 1 and estado = 1");
        $usuarios =  DB::select("SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.email, ge.descripcion as cargo, u.estado
                                        FROM users u
                                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
                                        INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado");  // OBsoleta si se queire usar Yajra

        //$usuarios = Usuarios::all();

        return view("paginas.TalentoHumano.crear_usuarios", [
                'tipoDocumento' => $tipoDocumento,
                'grupoEmpleado' => $grupoEmpleado,
                'listaUsuarios' => $listaUsuarios,
                'usuarios' => $usuarios, // obsoleta si se quiere usar Yajra  
            ]);
        

    }

    public function store(Request $request) : RedirectResponse
    {
        //dd($request);
        $request->validate([
            'tipo_documento' => ['required', 'int'],
            'documento' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'fecha_ingreso' => ['required', 'date'],
            'grupo_empleado' => ['required', 'int'],
            'salario' => ['required', 'numeric'],
            'aux_transporte' => ['required', 'numeric'],
            'jefe_directo' => ['nullable', 'int'],            
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        try {

            $user = User::create([
                'id_tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'name' => $request->nombre,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'fecha_ingreso' => $request->fecha_ingreso,
                'id_grupo_empleado' => $request->grupo_empleado,
                'salario' => $request->salario,
                'auxilio_transporte' => $request->aux_transporte,
                'id_jefedirecto' => $request->jefe_directo,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);         
            
            event(new Registered($user));
            return redirect()->back()->with('success', 'Usuario registrado exitosamente');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong!');
        }

            
    }

    public function show($id)
    {
        $usuario = Usuarios::findOrFail($id);        
        return response()->json($usuario); // Retorna JSON para ajax
    }

    public function update(Request $request, User $usuario)
    {

        dd($request);
            $validated = $request->validate([
                    'nombre_m'   => ['required','string','max:255'],
                    'email_m'    => [
                        'required','email','max:255',
                        // Ignora el registro actual para que no choque consigo mismo
                        //Rule::unique('users','email')->ignore($usuario->id)
                        Rule::unique('users','email')->ignore($usuario->id)  // or ->ignore($id)
                            // si tu tabla users tiene soft deletes:
                            // ->whereNull('deleted_at')
                    ],
                    
                    'password' => ['nullable','confirmed', Password::min(8)],

                    'tipo_documento_m'  => ['required','integer','exists:tipo_documento,id'],
                    'documento_m'       => ['required','string','max:50'],
                    'direccion_m'       => ['nullable','string','max:255'],
                    'telefono_m'        => ['nullable','string','max:50'],
                    'fecha_nacimiento_m'=> ['nullable','date'],
                    'fecha_ingreso_m'   => ['nullable','date'],
                    'grupo_empleado_m'  => ['required','integer','exists:grupo_empleado,id'],
                    'salario_m'         => ['nullable','numeric'],
                    'aux_transporte_m'  => ['nullable','numeric'],
                    'jefe_directo_m'    => ['nullable','integer','exists:users,id'],
                ]);

                $data = [
                    'name'   => $validated['nombre_m'],
                    'email'  => $validated['email_m'],

                    'id_tipo_documento' => $validated['tipo_documento_m'],
                    'documento'         => $validated['documento_m'],
                    'direccion'         => $validated['direccion_m'] ?? null,
                    'telefono'          => $validated['telefono_m'] ?? null,
                    'fecha_nacimiento'  => $validated['fecha_nacimiento_m'] ?? null,
                    'fecha_ingreso'     => $validated['fecha_ingreso_m'] ?? null,
                    'id_grupo_empleado' => $validated['grupo_empleado_m'],
                    'salario'           => $validated['salario_m'] ?? 0,
                    'auxilio_transporte'   => $validated['aux_transporte_m'] ?? 0,
                    'id_jefedirecto'   => $validated['jefe_directo_m'] ?? null,
                ];

                


                if (!empty($validated['password'])) {
                    $data['password'] = Hash::make($validated['password']);
                }

                $usuario->update($data);
                
              //  return back()->with('status', 'Usuario actualizado correctamente.');
                return redirect()->back()->with('success', 'Usuario actualizado exitosamente !'  );
    }

    public function update_state(Request $request, User $usuario){


        $validated = $request->validate([
                'estado' => ['required','integer','in:1,2'], // reject 2
            ]);

            $usuario->estado = (int) $validated['estado'];  // update existing instance
            $usuario->save();

            return response()->json([
                'message' => 'Actualizamos exitosamente el estado del usuario !!!!',
                'estado'  => $usuario->estado,
            ]);
 

    }

    public function obtenerUsuariosDatatable(){

        $sql = "SELECT u.id, td.descripcion As TipoDocumento, u.documento,  u.name, u.email, ge.descripcion as cargo, u.estado
                        FROM users u
                        INNER JOIN  tipo_documento td ON td.id = u.id_tipo_documento
                        INNER JOIN  grupo_empleado ge ON ge.id = u.id_grupo_empleado";

        $q = DB::table(DB::raw("({$sql}) as sub"));
       // return DataTables::of($q)->toJson();

        return DataTables::of($q)
        ->addColumn('actions', fn ($u) =>
            view('paginas.partials.actions_th', ['u' => $u])->render()
        )
        ->rawColumns(['actions'])   // permite HTML en la columna
        ->toJson();

    }


        


}
