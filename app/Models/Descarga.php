<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_descarga',
        'total_item_descaga',
        'descripcion_Descarga',
        'users_id'
    ];
}
