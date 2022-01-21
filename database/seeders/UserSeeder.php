<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Mateo Leo',
            'phone'=>'75208200',
            'address'=>'San Miguel',
            'dui'=>'04484224-0',
            'email'=>'mateo@gmail.com',
            'profile'=>'Administrador',
            'status'=>'ACTIVE',
            'password'=>bcrypt('12345678')
        ])->syncRoles('Administrador');
        User::create([
            'name'=>'Fabricio Rivera',
            'phone'=>'75208741',
            'address'=>'San Miguel',
            'dui'=>'04484224-1',
            'email'=>'leo@gmail.com',
            'profile'=>'Cajero',
            'status'=>'ACTIVE',
            'password'=>bcrypt('12345678')
        ])->syncRoles('Cajero');
    }
}
