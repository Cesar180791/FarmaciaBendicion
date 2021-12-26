<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProcuctSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'=>'Viro-Grip Jarabe 50 ML DIA',
            'chemical_component'=>'Acetaminofen',
            'laboratory'=>'Vijosa',
            'barCode' =>'1457851225',
            'Numero_registro'=>'2547474747',
            'sub_category_id'=>1
        ]);
        Product::create([
            'name'=>'Vitamina C',
            'chemical_component'=>'Vitamina C',
            'laboratory'=>'Vijosa',
            'barCode' =>'1457851225',
            'Numero_registro'=>'4545455454',
            'sub_category_id'=>3
        ]);
        Product::create([
            'name'=>'Vermagest',
            'chemical_component'=>'Anti Pija',
            'laboratory'=>'Vijosa',
            'barCode' =>'1457851225',
            'Numero_registro'=>'454545474',
            'sub_category_id'=>2
        ]);
        Product::create([
            'name'=>'CLABULIN',
            'chemical_component'=>'Amoxicilina',
            'laboratory'=>'Vijosa',
            'barCode' =>'1457851225',
            'Numero_registro'=>'4545545454',
            'sub_category_id'=>4
        ]);
    }
}
