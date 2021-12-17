<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'purchases_id',
        'stocks_id',
        'costo',
        'costo_iva',
        'costo_mas_iva',
        'precio_venta',
        'precio_iva',
        'precio_mas_iva',
        'quantity',
    ];
}
