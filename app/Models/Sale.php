<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable =[
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
