<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clientes;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::create([
            'nombre_cliente'=>'Cesar Fabricio Morales Rivera',
            'telefono'=>'7520-8200',
            'NIT_cliente' =>'1217-180791-105-2',
            'NRC_cliente'=>'1234567995',
            'gran_con_cliente'=>'SI'
        ]);
    }
}
