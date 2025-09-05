<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // como ua existe un usuario lo quitamos , ya que entra en conflico
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->call([ // para probar comando  global . Se pueden agregar mas clases abajo , separadas por coma 
            // TipoDocumentoTable::class, 
            // GrupoEmpleadoTable::class, 
            // TipoCargoTable::class,
            // CrearEstadosSolicitud::class,
            // SatisfaccionSeeder::class,
            // TipoPrioridad::class,
            // EstadoSolicitudTable::class
            // CrearTipoSolicitudTable::class
            // CrearTablaServicio::class
            // CargarListaEquiposBiomedicos::class
            // CargarCategoriasDanioEquipos::class
            // CategoriaSolicitudes::class
            // SubcategoriaDetallesTable::class,
            CargarSolicitudesDesdeXLSSeeder::class
        ]);
    }
}
