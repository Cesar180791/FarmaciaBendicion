<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_descarga',
        'total_item_descarga',
        'descripcion_descarga',
        'users_id'
    ];
}
