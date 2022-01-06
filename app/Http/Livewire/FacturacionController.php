<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TiposTransacciones;
use App\Models\Product;
use App\Models\Lotes;
use App\Models\Sale; 
use App\Models\SaleDetails;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class FacturacionController extends Component
{
    use withPagination;

    public $transaccionId, $search, $idProduct, $tipoPrecio, $lotes;

    private $pagination = 5;

    public function mount(){
        //Cart::clear();
        $this->pageTitle4 = 'Seleccionar Lote';
        $this->pageTitle = 'Productos';
        $this->componentName = 'Facturación';
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
         $this->lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','lotes.*')
                        ->where('lotes.products_id',$this->idProduct)
                        ->orderBy('pro.id','desc')
                        ->get();


        if (strlen($this->search) > 0)
        $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->where([
                                ['products.name','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orWhere([
                                ['products.chemical_component','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orWhere([
                                ['products.laboratory','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orWhere([
                                ['products.Numero_registro','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orWhere([
                                ['products.barCode','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orWhere([
                                ['c.name','like', '%' . $this->search . '%'],
                                ['estado','ACTIVO']
                            ])
                        ->orderBy('products.id','desc')
                        ->paginate($this->pagination);
        else
         $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->orderBy('products.id','desc')
                        ->where('estado','ACTIVO')
                        ->paginate($this->pagination);

        return view('livewire.facturacion.facturacion',[
            'products'      =>  $products,
            'transacciones'=>TiposTransacciones::orderBy('id', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    //con esta funcion se le asiganara el id de transaccion a la variable $transaccionId
    public function validarTipoTransaccion(TiposTransacciones $transaccionId){
        $this->transaccionId = $transaccionId->id;
        if($this->transaccionId === 1){
            $this->emit('consumidor-final');
            //dd('Emitir evento para abrir interfaces de facturacion consumidor final');
        }
        if($this->transaccionId === 2){
            $this->emit('credito-fiscal');
            //dd('Emitir evento para abrir interfaces de facturacion credito fiscal');
        }
        else{
            //dd('Tipo de facturacion en desarrollo o no registrado');
        }
    }

    //funcion para asignar el precio de venta y el id del producto para buscar el lote
    public function verLotes($idProduct, $tipoPrecio){
        $this->idProduct = $idProduct;
        $this->tipoPrecio = $tipoPrecio;
        $this->emit('ver-lotes','Ver lotes del producto seleccionado');

        //dd('Tipo de precio: ' . $this->tipoPrecio . ' id: ' . $this->idProduct = $idProduct);
    }
}
