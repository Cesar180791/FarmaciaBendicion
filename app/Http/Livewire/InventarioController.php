<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InventarioController extends Component
{
    public function render()
    {
        return view('livewire.inventario.inventario') 
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
