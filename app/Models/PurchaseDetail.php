<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'purchases_id',
        'lotes_id',
        'costo',
        'costo_iva',
        'costo_mas_iva',
        'precio_venta',
        'precio_venta_mayoreo',
        'precio_venta_unidad',
        'quantity',
        'politicas_garantias_id',
        'costo_ref',
        'costo_iva_ref',
        'costo_mas_iva_ref',
        'precio_venta_ref',
        'precio_venta_mayoreo_ref',
        'precio_venta_unidad_ref'
    ];
}
