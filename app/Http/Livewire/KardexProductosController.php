<?php

namespace App\Http\Livewire;

use Livewire\Component;

class KardexProductosController extends Component
{
    public function render()
    {
        return view('livewire.kardex-productos.kardex-productos')->extends('layouts.theme.app')->section('content');;
    }
}
