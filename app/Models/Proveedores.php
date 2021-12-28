<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_proveedor',
        'nombre_vendedor',
        'telefono',
        'NIT',
        'NRC',
        'gran_con',
        'estado_proveedor'
    ];
}
