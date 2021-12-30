<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoliticasGarantias;

class GarantiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       PoliticasGarantias::create([
            'meses'=>0,
            'concepto' => 'No devolutiva'
        ]);
       PoliticasGarantias::create([
            'meses'=>1,
            'concepto' => '1 mes de garantia sobre vencimiento de lote'
        ]);
       PoliticasGarantias::create([
            'meses'=>2,
            'concepto' => '2 mes de garantia sobre vencimiento de lote'
        ]);
       PoliticasGarantias::create([
            'meses'=>3,
            'concepto' => '3 mes de garantia sobre vencimiento de lote'
        ]);
       PoliticasGarantias::create([
            'meses'=>4,
            'concepto' => '4 mes de garantia sobre vencimiento de lote'
        ]);
       PoliticasGarantias::create([
            'meses'=>5,
            'concepto' => '5 mes de garantia sobre vencimiento de lote'
        ]);
       PoliticasGarantias::create([
            'meses'=>6,
            'concepto' => '6 mes de garantia sobre vencimiento de lote'
        ]);
    }
}
