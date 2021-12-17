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
        'price',
        'iva_price',
        'final_price',
        'estado',
        'sub_category_id'
    ];

     public function subCategory(){
        return $this->belongsTo(SubCategory::class); 
    }
}