<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'telefono',
        'NIT_cliente',
        'NRC_cliente',
        'gran_con_cliente',
        'estado_cliente'
    ];
}
