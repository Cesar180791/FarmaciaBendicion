<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FacturacionController extends Component
{
    public function render()
    {
        return view('livewire.facturacion.facturacion')
        ->extends('layouts.theme.app')
        ->section('content');;
    }
}
