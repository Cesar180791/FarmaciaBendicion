<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product; 
use App\Models\Cargas; 
use App\Models\Detalle_cargas; 
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class CargaInventarioController extends Component
{
    use withPagination;
    public $search, $itemsQuantity, $total, $descripcion_carga;
    private $pagination = 5;

    public function mount(){
        //Cart::clear();
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->proveedor='Seleccionar';
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


        return view('livewire.carga-inventario.carga-inventario',[
            'products'      =>  $products,
            'cart'          =>  Cart::getContent()->sortBy('id')
        ])
        ->extends('layouts.theme.app')
        ->section('content');;
    }

    protected $listeners = [ 
        'addItem',
        'removeItem'
    ]; 


    public function addItem($id, $cant = 1){

        $product = Product::where('id', $id)->first();

        if($product == null){
            $this->emit('producto-no-encontrado','El producto no esta registrado');
        } else {
            if ($this->InCart($product->id)) {
                return;
            }
            Cart::add(
                $product->id,
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
                    "",
                    date('Y-m-d')
                ));
                $this->total = Cart::getTotal();
               // $this->itemsQuantity = Cart::getTotalQuantity();
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
                   $exist->attributes[8]
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
                ));

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                //$this->emit('add-ok', $title);
            }
    }
    
    public function updateProductList($id, $product){
        $exist = Cart::get($id);
        Cart::update($exist->id, array( array(
            $exist->attributes[7] = $product,
        )));
    }
    
    public function updateVencimiento($id, $vencimiento){
        $exist = Cart::get($id);
        Cart::update($exist->id, array( array(
            $exist->attributes[8] = $vencimiento,
        )));
    }
    
    public function validarCampos(){
        $items = Cart::getContent();
        foreach($items as $item){
            if ($item->attributes[0] == 0 || $item->attributes[3] == 0 || $item->attributes[7] === '') {
                return $this->emit('empty-cost',$item->name.' Revisa los siguientes valores introducidos: costo, porcentaje de ganancia o numero de lote ya que pueden estar en cero o vacios');
            }
        }
        $this->EjecutarCarga();
    }
        
    public function EjecutarCarga(){
        DB::beginTransaction();
        try {
            $rules =[
                'descripcion_carga' =>  "required|min:3",
            ];
    
            $messages=[
                'descripcion_carga.required' =>  'La descripción de la carga es requerida',
                'descripcion_carga.min' =>  'La descripción de la carga debe tener al menos 3 caracteres',
            ];
    
             $this->validate($rules, $messages);



            $carga = Cargas::create([
                'total_carga'       => $this->total,
                'total_item_carga'  => $this->itemsQuantity,
                'descripcion_carga' => $this->descripcion_carga,
                'users_id'          => auth()->user()->id,
            ]);
            if ($carga) {
                ///se crea el registro en la tabla ventas se busca en el carrito el detalle 
                $items = Cart::getContent();
                ///se recorre el detalle para guardar en la tabla detalle de ventas 
                foreach($items as $item){
                    $detalle = Detalle_cargas::create([
                        'cargas_id'                     =>  $carga->id,
                        'products_id'                   =>  $item->id,
                        'detalle_cargas_lote'           =>  $item->attributes[7],
                        'vencimiento_lote'              =>  $item->attributes[8],
                        'detalle_cargas_costo'          =>  $item->attributes[0],
                        'detalle_cargas_costo_iva'      =>  $item->attributes[1],
                        'detalle_cargas_costo_mas_iva'  =>  $item->attributes[2],
                        'detalle_cargas_precio_venta'   =>  $item->attributes[4],
                        'detalle_cargas_precio_iva'     =>  $item->attributes[5],
                        'detalle_cargas_precio_mas_iva' =>  $item->attributes[6],
                        'detalle_cargas_quantity'       =>  $item->quantity,
                    ]);
                    ///A PETICION DEL CLIENTE SI EL PRODUCTO TIENE MAS DE 60 DIAS ENTRE LA ULTIMA ACTUALIZACION
                    //Y EL REGISTRO DE CARGA RECIEN CREADO Y SU EXISTENCIA ES CERO LOS COSTOS SE SOBREESCRIBIRAN Y NO SE APLICARA
                    //COSTO PROMEDIO.
                    //PARA ESTO SE BUSCA EL REGISTRO A MODIFICAR POR LA CARGA
                    $actualizarExistencia = Product::find($item->id);

                    //Y LUEGO CON LA FUNCION DIFFINDAYS DE CARBON SE CALCULA LA DIFERENCIA DE DIAS ENTRE
                    //LA ULTIMA ACTUALIZACION DEL PRODUCTO EN SU COLUMNA UPDATED_AT
                    //Y LA FECHA DE CREACION DE EL REGISTRO DE DETALLE DE CARGA RECIEN CREADO
                

                    //LUEGO SI LA EXISTENCIA DEL PRODUCTO ES CERO SE SOBREESCRIBE LA CANTIDAD Y LOS COSTOS
                    if($actualizarExistencia->existencia == 0){ 
                        $diasDiferencia = $detalle->created_at->diffInDays($actualizarExistencia->updated_at);
                        if($diasDiferencia > 60){
                            $actualizarExistencia->cost = $item->attributes[0];
                            $actualizarExistencia->iva_cost = $item->attributes[1];
                            $actualizarExistencia->final_cost = $item->attributes[2];
                        }else{
                            if($actualizarExistencia->cost == 0){
                                $actualizarExistencia->cost = $item->attributes[0];
                                $actualizarExistencia->iva_cost = $item->attributes[1];
                                $actualizarExistencia->final_cost = $item->attributes[2];
                            } else{                        
                                //aplicando costo promedio
                                ///paso 1 multiplicar costo actual del producto por su existencia actual
                                $actualizarExistencia->cost = (($actualizarExistencia->cost * $actualizarExistencia->existencia)+($item->attributes[0] * $item->quantity)) / (($actualizarExistencia->existencia + $item->quantity));
                                $actualizarExistencia->iva_cost = $actualizarExistencia->cost * 0.13;
                                $actualizarExistencia->final_cost = $actualizarExistencia->iva_cost + $actualizarExistencia->cost;
                            }
                        }
                        $actualizarExistencia->existencia = $item->quantity;
                    } else{
                       
                        if($actualizarExistencia->cost == 0){
                            $actualizarExistencia->cost = $item->attributes[0];
                            $actualizarExistencia->iva_cost = $item->attributes[1];
                            $actualizarExistencia->final_cost = $item->attributes[2];
                        } else{
                            //aplicando costo promedio
                            ///paso 1 multiplicar costo actual del producto por su existencia actual
                            $actualizarExistencia->cost = (($actualizarExistencia->cost * $actualizarExistencia->existencia)+($item->attributes[0] * $item->quantity)) / (($actualizarExistencia->existencia + $item->quantity));
                            $actualizarExistencia->iva_cost = $actualizarExistencia->cost * 0.13;
                            $actualizarExistencia->final_cost = $actualizarExistencia->iva_cost + $actualizarExistencia->cost;
                        }
                        $actualizarExistencia->existencia += $item->quantity;
                    }

                    $actualizarExistencia->porcentaje_ganancia = $item->attributes[3];
                    $actualizarExistencia->price = $item->attributes[4];
                    $actualizarExistencia->iva_price = $item->attributes[5];
                    $actualizarExistencia->final_price = $item->attributes[6];
                    $actualizarExistencia->save();
                }
            }
            $this->emit('carga-ok','Carga Registrada con exito');
            //$this->emit('print-ticket',$sale->id);
            DB::commit();
            Cart::clear();
            $this->total = Cart::getTotal();
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error',$e->getMessage());
        }
    }
}
