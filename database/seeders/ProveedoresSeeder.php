<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedores;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedores::create([
            'nombre_proveedor'=>'Laboratorios Suizos SA de CV',
            'nombre_vendedor'=>'Cesar Rivera',
            'telefono'=>'7520-8200',
            'NIT' =>'1217-180791-105-2',
            'NRC'=>'1234567995',
            'gran_con'=>'SI'
        ]);
    }
}
