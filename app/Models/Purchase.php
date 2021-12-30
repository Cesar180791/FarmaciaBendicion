<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable =[
        'fecha_compra',
        'total',
        'item',
        'lote',
        'descripcion_lote',
        'factura',
        'politicas_garantias_id',
        'vencimiento',
        'users_id',
        'proveedores_id'
    ];
}
