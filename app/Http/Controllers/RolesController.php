<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\PermissionRegistrar;

class RolesController extends Controller
{

    public function index(): View
    {
        return view("paginas.Sistemas.crear_roles");      

    }

    public function list(){

        $sql = "SELECT r.id, r.name,r.guard_name, r.created_at, r.updated_at from roles r";

        $q = DB::table(DB::raw("({$sql}) as sub"));
        
        return DataTables::of($q)
        ->addColumn('actions', function ($role) {
            // 👇 pasas la variable con el nombre que espera la parcial
            return view('paginas.partials.actions_roles', ['role' => $role])->render();
        })
        ->rawColumns(['actions']) // importante para HTML
        ->toJson();

    } // paginas.partials.actions_gu



    public function store(Request $request)
    {/*
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name'],
        ]);

        Role::create([
            'name'       => $data['name'],
            'guard_name' => 'web',        // IMPORTANTE: que coincida con tu guard
        ]);

        // refresca cache de permisos si es necesario
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return back()->with('success', 'Rol creado correctamente');*/

         //dd($request);   
         $data = $request->validate([
        'name_m' => ['required','string','max:255','unique:roles,name'],
        ]);

        Role::create([
            'name'       => $data['name_m'],
            'guard_name' => 'web',   // IMPORTANT: match your guard
        ]);

    // refresh Spatie’s cache so the UI sees it immediately
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return $request->wantsJson()
            ? response()->json(['message' => 'Rol creado exitosameante !'])
            : back()->with('success', 'Rol creado exitosameante !');
    }

   
    public function find($id){

        $rol = Role::findOrFail($id);        
        return response()->json($rol); // Retorna JSON para ajax
    }


       // Renombrar rol (opcional)
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name,'.$role->id],
        ]);

        $role->update(['name' => $data['name']]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return back()->with('success', 'Rol actualizado');
    }




    
}
