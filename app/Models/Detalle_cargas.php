<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_cargas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargas_id',
        'lotes_id',
        'detalle_cargas_costo',
        'detalle_cargas_costo_iva',
        'detalle_cargas_costo_mas_iva',
        'detalle_cargas_precio_caja',
        'detalle_cargas_precio_mayoreo',
        'detalle_cargas_precio_unidad',
        'detalle_cargas_quantity',
    ];
}
