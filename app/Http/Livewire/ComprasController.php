<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Proveedores;
use App\Models\PurchaseDetail;
use Livewire\withPagination;

class ComprasController extends Component
{
    public $proveedores_id, $fecha_compra, $factura;

    public function mount(){
        $this->proveedores_id = "Seleccionar";
        $this->pageTitle = 'Datos Generales';
        $this->componentName = 'Compras';
    }

    public function render()
    {
        return view('livewire.compras.compras',[
            'proveedores'=>Proveedores::orderBy('nombre_proveedor', 'asc')->where('estado_proveedor', 'ACTIVO')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }
}
