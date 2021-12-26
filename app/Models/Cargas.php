<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargas extends Model
{
    use HasFactory;

    protected $fillable =[
        'total_carga',
        'total_item_carga',
        'descripcion_carga',
        'users_id',
    ];
}
