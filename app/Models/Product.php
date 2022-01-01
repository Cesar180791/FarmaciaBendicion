<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'chemical_component',
        'barCode',
        'Numero_registro',
        'laboratory',
        'cost',
        'iva_cost',
        'final_cost',
        'unidades_presentacion',
        'precio_caja',
        'precio_mayoreo',
        'precio_unidad',
        'sub_category_id',
        'existencia_caja',
        'existencia_unidad',
        'estado', 
    ];

     public function subCategory(){
        return $this->belongsTo(SubCategory::class); 
    }
}