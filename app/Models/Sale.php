<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable =[
        'cliente_consumidor_final',
        'direccion_consumidor_final',
        'dui_consumidor_final',
        'total',
        'items',
        'cash',
        'change',
        'numero_factura',
        'status',
        'clientes_id',
        'tipos_transacciones_id',
        'user_id'
    ];
}
