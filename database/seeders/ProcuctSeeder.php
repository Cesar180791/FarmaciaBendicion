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
            'name'=>'ACETAMINOFEN MK 120MG/5ML JARABE NIÑOS 60ML',
            'chemical_component'=>'Acetaminofen',
            'laboratory'=>'Laboratorios MK',
            'barCode' =>'1457851225',
            'Numero_registro'=>'2547474747',
            'sub_category_id'=>1
        ]);
        Product::create([
            'name'=>'ACETAMINOFEN FORTE X 16 TABLETAS 500MG',
            'chemical_component'=>'Acetaminofen',
            'laboratory'=>'Laboratorios MK',
            'barCode' =>'1457851225',
            'Numero_registro'=>'4545455454',
            'sub_category_id'=>1
        ]);
        Product::create([
            'name'=>'ACETOSIL INFANTIL JARABE FRASCO 60ML(Acetaminofen)',
            'chemical_component'=>'Acetaminofen',
            'laboratory'=>'Laboratorios Suizos',
            'barCode' =>'1457851225',
            'Numero_registro'=>'454545474',
            'sub_category_id'=>1
        ]);
        Product::create([
            'name'=>'PANADOL EXTRA FUERTE 500MGX50 SOBRES X 2 TABLETAS',
            'chemical_component'=>'Acetaminofen',
            'laboratory'=>'GSK',
            'barCode' =>'1457851225',
            'Numero_registro'=>'4545545454',
            'sub_category_id'=>1
        ]);
        Product::create([
            'name'=>'CIPROFLOXACINA ECOMED 500MG X 1 TABLETA',
            'chemical_component'=>'Ciprofloxacina',
            'laboratory'=>'Ecomed',
            'barCode' =>'147877474747',
            'Numero_registro'=>'4587478747',
            'sub_category_id'=>4
        ]);
        Product::create([
            'name'=>'CIPROFLOXACINA MK 500MG X 30 TABLETAS',
            'chemical_component'=>'Ciprofloxacina',
            'laboratory'=>'Laboratorios MK',
            'barCode' =>'147877474747',
            'Numero_registro'=>'4587478747',
            'sub_category_id'=>4
        ]);
        Product::create([
            'name'=>'DICLOFENAC MEDIKEN 50MG X 50 TABLETAS',
            'chemical_component'=>'Diclofenaco Sodico',
            'laboratory'=>'Mediken',
            'barCode' =>'5454785485487',
            'Numero_registro'=>'545757474',
            'sub_category_id'=>4
        ]);
    }
}
