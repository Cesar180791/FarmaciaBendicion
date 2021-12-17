<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargas extends Model
{
    use HasFactory;

    protected $fillable =[
        'fecha_carga',
        'total_carga',
        'total_item_carga',
        'lote_carga',
        'descripcion_lote_carga',
        'vencimiento_lote_carga',
        'users_id'
    ];
}
