<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticasGarantias extends Model
{
    use HasFactory;
    protected $fillable = [
        'meses',
        'concepto'
    ];
}
