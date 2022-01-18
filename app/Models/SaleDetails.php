<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $fillable =[
        'lotes_id',
        'sale_id',
        'tipo_venta',
        'costo',
        'costo_iva',
        'costo_mas_iva',
        'precio_venta',
        'iva_precio_venta',
        'precio_venta_mas_iva',
        'quantity'
    ]; 
}
