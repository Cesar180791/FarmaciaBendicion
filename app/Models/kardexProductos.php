<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardexProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'concepto',
        'cantidad_entrada',
        'costo_unit_entrada',
        'costo_total_entrada',
        'cantidad_salida',
        'costo_unit_salida',
        'costo_total_salida',
        'cantidad_existencias_ppal',
        'cantidad_existencias_unitarias',
        'costo_unit_existencias_ppal',
        'costo_unit_existencias_unitarias',
        'costo_total_existencias',
        'id_transaccion',
        'tipo_movimiento'
    ];
}
