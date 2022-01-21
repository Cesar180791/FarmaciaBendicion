<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'Administrador',
            'guard_name'=>'web',
        ]); 
        Role::create([
            'name'=>'Cajero',
            'guard_name'=>'web',
        ]);
    }
}
