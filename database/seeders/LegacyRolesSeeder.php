<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class LegacyRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $legacyRoles = DB::connection('legacy') // ->connection('mysql') if same DB
            ->table('modulo')           // 🔧 e.g. 'roles', 'roles_legacy'
            ->select('idmodulo','descmodulo')             //  columns that identify a role
            ->get();

        foreach ($legacyRoles as $r) {
            Role::firstOrCreate(
                ['name' => $r->name, 'guard_name' => 'web'], // Spatie uses 'name' as slug
                []
            );
        }
    }
}
