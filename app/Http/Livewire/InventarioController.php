<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Product;
use Livewire\withPagination;
use App\Models\Lotes;

class InventarioController extends Component
{
    use withPagination;

    public $search, $search2, $ID;

    private $pagination = 5, $pagination2 = 5;

    public function mount(){
        $this->pageTitle2 = 'Lotes';
        $this->pageTitle = 'Productos';
        $this->componentName = 'Inventario';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch(){ 
        $this->resetPage();
    }

    public function updatingSearch2()
    {
        $this->resetPage('lotes-page');
    }

    public function render()
    {
        if (strlen($this->search2) > 0)
        $lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where([
                            ['lotes.products_id',$this->ID],
                            ['lotes.numero_lote','like', '%' . $this->search2 . '%'],
                            ['lotes.estado_lote','ACTIVO']
                            ])
                        ->orderBy('pro.id','desc')
                        ->paginate($this->pagination2, ['*'],' lotes-page');
        
        else
        $lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where([
                            ['lotes.products_id',$this->ID],
                            ['lotes.estado_lote','ACTIVO']
                            ])
                        ->orderBy('pro.id','desc')
                        ->paginate($this->pagination2, ['*'], 'lotes-page');



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


        return view('livewire.inventario.inventario',[
            'products'          =>  $products,
            'lotes'             =>  $lotes,
        ]) 
        ->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [ 
        'updatingSearch2',
    ];

    //asignar id para filtrar en el render
    public function FiltrarID($ID){
        $this->ID = $ID;
        $this->emit('ver-lotes');
    }
}
