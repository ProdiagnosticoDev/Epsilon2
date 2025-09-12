<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CrearUsuarioController;
use App\Http\Controllers\GestionUsuariosController;
use App\Http\Controllers\GrupoEmpleadoController;
use App\Http\Controllers\ModuloUsuarioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TalentoHumanoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\ProrrogasController;
use App\Http\Controllers\GastosController;
use Illuminate\Support\Facades\Route;

/*  
Route::get('/paginas.principal', function () {
    return view('paginas.principal');
})->middleware(['auth', 'verified'])->name('paginas.principal');

Route::get('/crear_usuarios', [TalentoHumanoController::class, 'create'])
    ->name('usuarios.create')
    ->middleware(['auth', 'verified'])->name('crear_usuarios');

Route::get('/crear_usuarios/{id}', [TalentoHumanoController::class, 'show'])
    ->name('usuarios.show');

// Handle form submission
Route::post('/crear_usuarios', [TalentoHumanoController::class, 'store'])
    ->name('usuarios.store');

Route::put('/crear_usuarios/{usuario}', [TalentoHumanoController::class, 'update'])
->name('usuarios.update');
*/ 

/** Rutas talento humano **/
Route::middleware(['auth','verified','estado',
 'role:Talento Humano|Administrador'])->group(function () {

    Route::put('/crear_usuarios/{usuario}', [TalentoHumanoController::class, 'update'])
        ->name('usuarios.update');

    Route::get('/crear_usuarios', [TalentoHumanoController::class, 'create'])
        ->name('usuarios.create');

    Route::get('/crear_usuarios/{id}', [TalentoHumanoController::class, 'show'])
        ->whereNumber('id') 
        ->name('usuarios.show');

    Route::post('/crear_usuarios', [TalentoHumanoController::class, 'store'])
        ->name('usuarios.store');

    Route::patch('/crear_usuarios/{usuario}/estado', [TalentoHumanoController::class, 'update_state'])
        ->name('usuarios.update_state');

    Route::get('/crear_usuarios/data', [TalentoHumanoController::class, 'obtenerUsuariosDatatable'])
        ->name('usuarios.list'); // Ruta para el nuevo datatable. Si se va a utililizar el datatable convencional de jquery debe comentar esta ruta 


    /**Ruta cartas prórroga - no prórroga **/


    Route::get('/generar_prorrogas', [ProrrogasController::class, 'create'])
    ->name('generar_prorrogas.create');

        Route::get('/generar_prorrogas/data', [ProrrogasController::class, 'obtenerUsuariosDatatable'])
        ->name('cartas.list');

        Route::get('/generate-pdf', [ProrrogasController::class, 'generatePDF'])
        ->name('pdf.generate'); 
        
        
    /**Ruta gastos **/


    Route::get('/gastos', [GastosController::class, 'inicio'])
    ->name('gastos.inicio');

        /*Route::get('/generar_prorrogas/data', [GastosController::class, 'obtenerUsuariosDatatable'])
        ->name('cartas.list');*/

        Route::get('/get-tipo-gasto/{id}', [GastosController::class, 'tipo_gasto']); 

        Route::post('/crear_gastos', [GastosController::class, 'store'])
        ->name('gastos.store'); 



});

    // Rutas sistemas
    Route::middleware(['auth','verified','estado', 
    'role:Gestion de usuarios|Administrador'])->group(function () {

    Route::get('/gestion_roles', [GestionUsuariosController::class, 'create'])
        ->name('usuarios.create');

    Route::get('/gestion_roles/data', [GestionUsuariosController::class, 'obtenerUsuariosParaGestionDePermisos'])
        ->name('gestionU.list');    

    Route::get('/gestion_roles/{id}', [GestionUsuariosController::class, 'show'])
        ->whereNumber('id') 
        ->name('roles.show');

    Route::post('/gestion_roles', [GestionUsuariosController::class, 'store'])
    ->name('usuariosRoles.store');
    
    Route::get('/gestion_role/{usuario}/roles',  [GestionUsuariosController::class,'edit'])
        ->name('users.roles.edit');

    Route::put('/gestion_role/{usuario}/roles',  [GestionUsuariosController::class,'update'])
        ->name('users.roles.update');


    // Rutas para edición de roles 
    Route::get('/crear_roles', [RolesController::class, 'index']) // ruta pra mostrar la vista
        ->name('users.roles.index');

    Route::post('/crear_roles', [RolesController::class, 'store']) //  ruta para almacenar un nuevo rol
        ->name('users.roles.store');

    Route::get('/crear_roles/data', [RolesController::class, 'list']) // ruta para mostar los roles en el datatable
        ->name('roles.list');  

    Route::get('/crear_roles/{id}', [RolesController::class, 'find']) // ruta para listar rol por id
        ->whereNumber('id') 
        ->name('roles.find');

    Route::put('/crear_roles/{role}', [RolesController::class, 'update'])
        ->name('roles.update');


    // rutas solicitudes

    Route::get('/gestion_solicitudes/data', [SolicitudController::class, 'list'])
        ->name('listar.solicitudes');

    Route::get('/gestion_solicitudes/{id}', [SolicitudController::class, 'create'])
        ->name('mostrar.solicitud');

    Route::get('/gestion_solicitudes', [SolicitudController::class, 'create'])
        ->name('gestion.solicitud');
/*
     Route::get('/crear_usuarios/data', [TalentoHumanoController::class, 'obtenerUsuariosDatatable'])
        ->name('usuarios.list');
*/

});

Route::get('/', function () {
    return view('paginas.principal');    
});

require __DIR__.'/auth.php';
