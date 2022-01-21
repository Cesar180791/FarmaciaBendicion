<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=>'Clientes_Index',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Categorias_Index',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Proveedores_Index',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Productos_Index',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Facturacion_Index',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Usuarios',
            'guard_name'=>'web',
        ]);
        Permission::create([
            'name'=>'Permisos',
            'guard_name'=>'web',
        ]);
    }
}
