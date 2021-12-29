<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Proveedores;
use App\Models\PurchaseDetail;
use App\Models\Lotes;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class ComprasController extends Component
{
    use withPagination;

    public $proveedores_id, $search, $fecha_compra, $factura, $descripcion_carga, $total, $itemsQuantity, $pageTitle2, $pageTitle3, $idBuscarProducto, $idProducto;

    private $pagination = 5;

    public function mount(){
        $this->proveedores_id = "Seleccionar";
        $this->pageTitle = 'Datos Generales';
        $this->pageTitle2 = 'Detalle de compra';
        $this->pageTitle3 = 'Selecciona el producto';
        $this->pageTitle4 = 'Selecciona el lote a cargar la compra';
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
        //id de lote se almacena en $idBuscarProducto y cambia mediante la funcion asignarIdBusquedaProducto()
        $this->lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where('lotes.products_id',$this->idBuscarProducto)
                        ->orderBy('pro.id','desc')
                        ->get();

                       // dd($this->lotes);
                        //en esta parte se asigna el id a la variable idProducto
                        //y se le asigna al boton nuevo lote o crear lote
                       $this->idProducto = $this->idBuscarProducto;




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

    protected $listeners = [ 
        'removeItem',
        'lote-registrado' => '$refresh'
    ]; 

    public function asignarIdBusquedaProducto($idProduct){
        $this->idBuscarProducto = $idProduct;
        $this->emit('ver-lotes','Ver lotes del producto seleccionado');
    }

    public function addItem($id, $id_lote, $cant = 1){

        $product = Product::where('id', $id)->first();
        $buscar_lote = Lotes::where('id', $id_lote)->first();

        if($product == null){
            $this->emit('producto-no-encontrado','El producto no esta registrado');
        } else {
            if ($this->InCart($buscar_lote->id)) {
                $this->emit('add-ok','El Producto ha sido agregado');
                return;
            }
            Cart::add(
                $buscar_lote->id,
                $product->name,
                0,
                $cant,
                array(
                    0,
                    0, 
                    0, 
                    $product->porcentaje_ganancia,
                    $product->price, 
                    $product->iva_price,
                    $product->final_price,
                    $buscar_lote->numero_lote,
                    $buscar_lote->caducidad_lote,
                    $product->id,
                ));
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('add-ok','El Producto ha sido agregado');
        }
    }

    public function InCart($productId){
        $exist = Cart::get($productId);
        if ($exist) 
            return true;
        else 
            return false;
    }

    public function updateCost($productId, $cost){
        $exist = Cart::get($productId);

        if($cost > 0) {
            $iva_cost = $cost * 0.13;
            $final_cost = $cost + $iva_cost;

            //actualizar el precio
            $porcentaje = (100 - $exist->attributes[3]) / 100;
            $price = $cost /  $porcentaje;
            $iva_price = $price * 0.13;
            $final_price = $price +  $iva_price;

        Cart::update($exist->id, array( 
            array(
                $exist->price = $cost,
                $exist->attributes[0] = $cost,
                $exist->attributes[1] = $iva_cost,
                $exist->attributes[2] = $final_cost,

                $exist->attributes[4] = $price,
                $exist->attributes[5] = $iva_price,
                $exist->attributes[6] = $final_price
            )));
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            //$this->emit('add-ok', $title);
        }
    }

    public function removeItem($productId){
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
       // $this->emit('add-ok','Producto eliminado');
    }


    public function updateCant($productId, $cant = 1){
        $exist = Cart::get($productId);
        
        $this->removeItem($productId);
        if ($cant > 0) {
           Cart::add(
               $exist->id,
               $exist->name,
               $exist->price,
               $cant,
               array(
                   $exist->attributes[0],
                   $exist->attributes[1],
                   $exist->attributes[2],
                   $exist->attributes[3],
                   $exist->attributes[4],
                   $exist->attributes[5],
                   $exist->attributes[6],
                   $exist->attributes[7],
                   $exist->attributes[8],
                   $exist->attributes[9]
                ));
           $this->total = Cart::getTotal();
           $this->itemsQuantity = Cart::getTotalQuantity();
           //$this->emit('add-ok', $title);
       }
    }

    public function updatePrice($productId, $porcentaje){
        $exist = Cart::get($productId);

        $this->removeItem($productId);

       if($porcentaje > 0) {
           $calculoPorcentaje = (100 - $porcentaje) / 100;
           $price = $exist->attributes[0] /  $calculoPorcentaje;
           $iva_price = $price * 0.13;
           $final_price = $price +  $iva_price;

            Cart::add(
                $exist->id,
                $exist->name,
                $exist->price,
                $exist->quantity,
                array(
                    $exist->attributes[0],
                    $exist->attributes[1],
                    $exist->attributes[2],
                    $porcentaje,
                    $price,
                    $iva_price,
                    $final_price,
                    $exist->attributes[7],
                    $exist->attributes[8],
                    $exist->attributes[9]
                ));

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                //$this->emit('add-ok', $title);
            }
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
