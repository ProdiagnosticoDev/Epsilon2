<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    
    public function create(): View
    {
        //return view('auth.register');

        $tipoDocumento = DB::select("SELECT * FROM tipo_documento");
        $grupoEmpleado = DB::select("SELECT id, descripcion FROM grupo_empleado");
        $listaUsuarios = DB::select("SELECT id, name FROM users where id_grupo_empleado = 1");
        return view('paginas.crear_usuarios',[
                'tipoDocumento' => $tipoDocumento,
                'grupoEmpleado' => $grupoEmpleado,
                'listaUsuarios' => $listaUsuarios,
            ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request);
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
            'jefe_directo' => ['required', 'int'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        try {
            $user = User::create([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,            
                'fecha_ingreso' => $request->fecha_ingreso,
                'grupo_empleado' => $request->grupo_empleado,
                'salario' => $request->salario,
                'aux_transporte' => $request->aux_transporte,            
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            

       
            event(new Registered($user));

            //return redirect('/crear_usuarios')->with('success', 'Usuario registrado correctamente.');
             return redirect()->route('usuarios.store') // or wherever
                     ->with('success', 'Usuario registrado correctamente.');

        } catch (\Exception $e) {
            //return redirect()->back()->withInput()->with('error', 'Hubo un error al registrar el usuario.');
            return back()->with('error', 'Ocurrió un error al registrar el usuario.');
        }

/*
        $user = User::create([
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,            
            'fecha_ingreso' => $request->fecha_ingreso,
            'grupo_empleado' => $request->grupo_empleado,
            'salario' => $request->salario,
            'aux_transporte' => $request->aux_transporte,            
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect(route('/crear_usuarios', absolute: false));*/
    }
}
