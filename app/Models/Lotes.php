<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotes extends Model
{
    use HasFactory;
    protected $fillable = [
        'products_id',
        'users_id',
        'numero_lote',
        'existencia_lote',
        'existencia_lote_unidad',   
        'caducidad_lote',
        'estado_lote' 
    ];
}
