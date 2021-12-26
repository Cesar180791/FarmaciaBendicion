<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_descargas extends Model
{
    use HasFactory;

    protected $fillable = [
        'descargas_id',
        'products_id',
        'detalle_descargas_costo',
        'detalle_descargas_costo_iva',
        'detalle_descargas_costo_mas_iva',
        'detalle_descargas_precio_venta',
        'detalle_descargas_precio_iva',
        'detalle_descargas_precio_mas_iva',
        'detalle_descargas_quantity',
    ];
}
