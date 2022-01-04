<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TiposTransacciones;

class TipoTransacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TiposTransacciones::create([
            'tipo_transaccion'=>'CONSUMIDOR FINAL'
        ]);
        TiposTransacciones::create([
            'tipo_transaccion'=>'CREDITO FISCAL'
        ]);
    }
}
