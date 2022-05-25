<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\kardexProductos;
use Livewire\withPagination;
use Carbon\Carbon;

class KardexProductosController extends Component
{
    use withPagination;

    public $search, $idProducto, $nombreProducto, $dateFrom, $dateTo;
    private $pagination = 5, $pagination2 = 8;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){

    }


    public function render()
    {
        $product = Product::find($this->idProducto);

        if ($product != null) {
           $this->nombreProducto = $product->name;
        }

        if (strlen($this->search) > 0)
            $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                            ->select('products.*','c.name as sub_category')
                            ->where('products.name','like', '%' . $this->search . '%')
                            ->orWhere('products.chemical_component','like', '%' . $this->search . '%')
                            ->orWhere('products.laboratory','like', '%' . $this->search . '%')
                            ->orWhere('products.Numero_registro','like', '%' . $this->search . '%')
                            ->orWhere('products.barCode','like', '%' . $this->search . '%')
                            ->orWhere('c.name','like', '%' . $this->search . '%')
                            ->orderBy('products.name','asc')
                            ->paginate($this->pagination);
        else
             $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                            ->select('products.*','c.name as sub_category')
                            ->orderBy('products.name','asc')
                            ->paginate($this->pagination); 


        //bucar hsitorial por medio del id
        if($this->dateFrom != null){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';


            $kardex = kardexProductos::join('products as p','p.id','kardex_productos.products_id')
            ->select('p.name','kardex_productos.*')
            ->whereBetween('kardex_productos.created_at',[$from,$to])
            ->where('kardex_productos.products_id', $this->idProducto)->paginate($this->pagination2, ['*'], 'kardex-page');


        }else{

            $kardex = kardexProductos::join('products as p','p.id','kardex_productos.products_id')
            ->select('p.name','kardex_productos.*')
            ->where('kardex_productos.products_id', $this->idProducto)->paginate($this->pagination2, ['*'], 'kardex-page');
        }

        //dd($kardex);


        return view('livewire.kardex-productos.kardex-productos',[
            'products' =>  $products,
            'kardex' =>  $kardex
        ])->extends('layouts.theme.app')->section('content');;
    }

    public function verKardex($idProducto){
        $this->idProducto = $idProducto;
        $this->dateFrom = '';
        $this->dateTo = '';

        $this->emit('ver-kardex');
    }

    /*public function verMovimiento($id_transaccion, $tipo_movimiento){
        if($tipo_movimiento == 'Venta'){

        }
        if($tipo_movimiento == 'Compra'){

        }
        if($tipo_movimiento == 'Carga'){

        }
        if($tipo_movimiento == 'Descarga'){

        }
        if($tipo_movimiento == 'Inicio'){

        }
    }*/
    public function updatingSearch(){
        $this->resetPage();
    } 

    public function updatingSearch2()
    {
        $this->resetPage('kardex-page');
    }
}
