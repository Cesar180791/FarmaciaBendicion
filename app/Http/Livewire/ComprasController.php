<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Proveedores;
use App\Models\PurchaseDetail;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class ComprasController extends Component
{
    use withPagination;

    public $proveedores_id, $search, $fecha_compra, $factura, $descripcion_carga, $total, $itemsQuantity, $pageTitle2, $pageTitle3;

    private $pagination = 5;

    public function mount(){
        $this->proveedores_id = "Seleccionar";
        $this->pageTitle = 'Datos Generales';
        $this->pageTitle2 = 'Detalle de compra';
        $this->pageTitle3 = 'Selecciona el producto';
        $this->componentName = 'Compras';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        if (strlen($this->search) > 0)
        $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->where('products.name','like', '%' . $this->search . '%')
                        ->orWhere('products.chemical_component','like', '%' . $this->search . '%')
                        ->orWhere('products.laboratory','like', '%' . $this->search . '%')
                        ->orWhere('products.Numero_registro','like', '%' . $this->search . '%')
                        ->orWhere('products.barCode','like', '%' . $this->search . '%')
                        ->orWhere('c.name','like', '%' . $this->search . '%')
                        ->orderBy('products.id','desc')
                        ->paginate($this->pagination);
        else
         $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->orderBy('products.id','desc')
                        ->paginate($this->pagination);


        return view('livewire.compras.compras',[
            'products'      =>  $products,
            'cart'          =>  Cart::getContent()->sortBy('id'),
            'proveedores'   =>  Proveedores::orderBy('nombre_proveedor', 'asc')->where('estado_proveedor', 'ACTIVO')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    public function validacionCampos(){
        $rules =[
            'descripcion_carga' =>  'required|min:5',
            'factura'           =>  'required|min:3|unique:purchases,factura',
            'fecha_compra'      =>  'required',
            'proveedores_id'    =>  'required|not_in:Seleccionar'
        ];

        $messages=[
            'descripcion_carga.required'    =>  'La descripcion de la compra es requerida',
            'descripcion_carga.min'         =>  'La descripcion de la compra debe tener al menos 5 caracteres',
            'factura.required'              =>  'El numero de factura es requerido',
            'factura.min'                   =>  'El numero de factura debe tener al menos 3 caracteres',
            'factura.unique'                =>  'El numero de factura ya esta asociado a otra compra',
            'fecha_compra.required'         =>  'La fecha de compra es requerida',
            'proveedores_id.not_in'         =>  'Seleccione el Proveedor',
        ];
         $this->validate($rules, $messages);

         $this->emit('validacion-ok','validacion realizada con exito');
    }

    

}
