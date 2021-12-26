<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'name',
        'chemical_component',
        'barCode',
        'Numero_registro',
        'laboratory',
        'token',
        'cost',
        'iva_cost',
        'iva_cost',
        'final_cost',
        'porcentaje_ganancia',
        'price',
        'iva_price',
        'final_price',
        'sub_category_id',
        'existencia',
        'estado', 
    ];

     public function subCategory(){
        return $this->belongsTo(SubCategory::class); 
    }
}