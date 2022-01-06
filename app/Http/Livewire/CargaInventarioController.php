<?php

namespace App\Http\Livewire;

use Livewire\Component; 
use App\Models\Product;
use App\Models\Lotes;
use App\Models\Cargas; 
use App\Models\Detalle_cargas; 
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class CargaInventarioController extends Component
{
    use withPagination;
    public $search, $itemsQuantity, $total, $descripcion_carga, $loteId, $producto ,$numero_lote, $caducidad_lote, $idProducto, $idBuscarProducto, $existencia_lote_unidad;
    private $pagination = 5;

    public function mount(){
        //Cart::clear();
        $this->lotes=[];
        $this->pageTitle = 'Selecciona producto a cargar';
        $this->pageTitle2 = 'Detalle';
        $this->pageTitle3 = 'lote';
        $this->pageTitle4 = 'Selecciona lote para cargar producto';
        $this->componentName = 'Cargas';
        
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


        return view('livewire.carga-inventario.carga-inventario',[
            'products'      =>  $products,
            'cart'          =>  Cart::getContent()->sortBy('id'),
            'lotes'         =>  $this->lotes
        ])
        ->extends('layouts.theme.app')
        ->section('content');;
    }

    protected $listeners = [ 
        'removeItem',
        'lote-registrado' => '$refresh'
    ]; 

    public function nuevoLote(Product $idProduct){
        $this->producto = $idProduct->name;
        $this->idProducto = $idProduct->id;
        $this->emit('crear-lote','El Producto ha sido agregado');
    }

    public function crearLote(){
        $rules = [
            'numero_lote'       =>  'required|unique:lotes,numero_lote|min:3',
            'caducidad_lote'    =>  'required|date'
        ];

        $messages = [
            'numero_lote.required'      =>  'Numero de lote requerido',
            'numero_lote.unique'        =>  'Ya existe el numero de lote',
            'numero_lote.min'           =>  'El numero de lte debe tener al menos 3 caracteres',
            'caducidad_lote.required'   =>  'La fecha de vencimiento del lote es requerida',
            'caducidad_lote.date'       =>  'Ingrese una fecha valida'
        ];

        $this->validate($rules, $messages);

        $existenciaunidad = Product::find($this->idProducto);
        //$this->existencia_lote_unidad = $existenciaunidad->existencia_unidad;

        if($existenciaunidad->precio_unidad === null){
            $this->existencia_lote_unidad = null; 
         }else{
            $this->existencia_lote_unidad = 0; 
         }
        
        Lotes::create([
            'products_id'            =>     $this->idProducto,
            'users_id'               =>     auth()->user()->id,
            'numero_lote'            =>     $this->numero_lote,
            'existencia_lote_unidad' =>     $this->existencia_lote_unidad,
            'caducidad_lote'         =>     $this->caducidad_lote
        ]);

        $this->emit('lote-registrado','lote registrado con exito');
        $this->resetUI();
    }

    public function asignarIdBusquedaProducto($idProduct){
        $this->idBuscarProducto = $idProduct;
        $this->emit('ver-lotes','Ver lotes del producto seleccionado');
    }

    public function editarLote(Lotes $id){
        $this->emit('editar-lote','editar lote');
     
        $this->numero_lote = $id->numero_lote;
        $this->caducidad_lote = $id->caducidad_lote;
        $this->loteId = $id->id;
    }

    public function actualizarLote(){
        $rules = [
            'numero_lote'       =>  "required|unique:lotes,numero_lote,{$this->loteId}|min:3",
            'caducidad_lote'    =>  'required|date'
        ];

        $messages = [
            'numero_lote.required'      =>  'Numero de lote requerido',
            'numero_lote.unique'        =>  'Ya existe el numero de lote',
            'numero_lote.min'           =>  'El numero de lte debe tener al menos 3 caracteres',
            'caducidad_lote.required'   =>  'La fecha de vencimiento del lote es requerida',
            'caducidad_lote.date'       =>  'Ingrese una fecha valida'
        ];

        $this->validate($rules, $messages);

         $updateLote = Lotes::find($this->loteId);
         $updateLote->update([
            'numero_lote'       =>  $this->numero_lote,
            'caducidad_lote'    =>  $this->caducidad_lote
         ]);

         $this->resetUI();
         $this->emit('lote-actualizado','Producto Actualizado Correctamente');

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
                    $product->precio_caja, 
                    $product->precio_mayoreo,
                    $product->precio_unidad,
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

        Cart::update($exist->id, array( 
            array(
                $exist->price = $final_cost,
                $exist->attributes[0] = $cost,
                $exist->attributes[1] = $iva_cost,
                $exist->attributes[2] = $final_cost,
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
                ));
           $this->total = Cart::getTotal();
           $this->itemsQuantity = Cart::getTotalQuantity();
           //$this->emit('add-ok', $title);
       }
    }

    public function updatePrice($productId, $precio){
        $exist = Cart::get($productId);

        $this->removeItem($productId);

       if($precio > 0) {
            Cart::add(
                $exist->id,
                $exist->name,
                $exist->price,
                $exist->quantity,
                array(
                    $exist->attributes[0],
                    $exist->attributes[1],
                    $exist->attributes[2],
                    $precio,
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

    public function updateMayoreo($productId, $mayoreo){
      
        $exist = Cart::get($productId);

        $this->removeItem($productId);

       if($mayoreo > 0) {
            Cart::add(
                $exist->id,
                $exist->name,
                $exist->price,
                $exist->quantity,
                array(
                    $exist->attributes[0],
                    $exist->attributes[1],
                    $exist->attributes[2],
                    $exist->attributes[3],
                    $mayoreo,
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

    public function updateUnidad($productId, $unidad){
      
        $exist = Cart::get($productId);

        $this->removeItem($productId);

       if($unidad > 0) {
            Cart::add(
                $exist->id,
                $exist->name,
                $exist->price,
                $exist->quantity,
                array(
                    $exist->attributes[0],
                    $exist->attributes[1],
                    $exist->attributes[2],
                    $exist->attributes[3],
                    $exist->attributes[4],
                    $unidad,
                    $exist->attributes[6],
                    $exist->attributes[7],
                    $exist->attributes[8]
                ));

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                //$this->emit('add-ok', $title);
            }
    }
    
    public function validarCampos(){
        $items = Cart::getContent();
        foreach($items as $item){
            if ($item->attributes[0] == 0 || $item->attributes[3] == 0 || $item->attributes[4] === '') {
                 return $this->emit('empty-cost','Producto: '.$item->name. ' lote: '. $item->attributes[6].' Revisa los siguientes valores introducidos: costo, porcentaje de ganancia o numero de lote ya que pueden estar en cero o vacios');
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
                        'cargas_id'                         =>  $carga->id,
                        'lotes_id'                          =>  $item->id,
                        'detalle_cargas_costo'              =>  $item->attributes[0],
                        'detalle_cargas_costo_iva'          =>  $item->attributes[1],
                        'detalle_cargas_costo_mas_iva'      =>  $item->attributes[2],
                        'detalle_cargas_precio_caja'        =>  $item->attributes[3],
                        'detalle_cargas_precio_mayoreo'     =>  $item->attributes[4],
                        'detalle_cargas_precio_unidad'      =>  $item->attributes[5],
                        'detalle_cargas_quantity'           =>  $item->quantity,
                    ]);

                    ///ACTUALIZAR TABLA PRODUCTO
                    ///A PETICION DEL CLIENTE SI EL PRODUCTO TIENE MAS DE 60 DIAS ENTRE LA ULTIMA ACTUALIZACION
                    //Y EL REGISTRO DE CARGA RECIEN CREADO Y SU EXISTENCIA ES CERO LOS COSTOS SE SOBREESCRIBIRAN Y NO SE APLICARA
                    //COSTO PROMEDIO.
                    //PARA ESTO SE BUSCA EL REGISTRO A MODIFICAR POR LA CARGA
                    $actualizarExistencia = Product::find($item->attributes[8]);

                    //Y LUEGO CON LA FUNCION DIFFINDAYS DE CARBON SE CALCULA LA DIFERENCIA DE DIAS ENTRE
                    //LA ULTIMA ACTUALIZACION DEL PRODUCTO EN SU COLUMNA UPDATED_AT
                    //Y LA FECHA DE CREACION DE EL REGISTRO DE DETALLE DE CARGA RECIEN CREADO
                

                    //LUEGO SI LA EXISTENCIA DEL PRODUCTO ES CERO SE SOBREESCRIBE LA CANTIDAD Y LOS COSTOS
                    if($actualizarExistencia->existencia_caja == 0){ 
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
                                $actualizarExistencia->cost = (($actualizarExistencia->cost * $actualizarExistencia->existencia_caja)+($item->attributes[0] * $item->quantity)) / (($actualizarExistencia->existencia_caja + $item->quantity));
                                $actualizarExistencia->iva_cost = $actualizarExistencia->cost * 0.13;
                                $actualizarExistencia->final_cost = $actualizarExistencia->iva_cost + $actualizarExistencia->cost;
                            }
                        }
                        $actualizarExistencia->existencia_caja = $item->quantity;
                    } else{
                       
                        if($actualizarExistencia->cost == 0){
                            $actualizarExistencia->cost = $item->attributes[0];
                            $actualizarExistencia->iva_cost = $item->attributes[1];
                            $actualizarExistencia->final_cost = $item->attributes[2];
                        } else{
                            //aplicando costo promedio
                            ///paso 1 multiplicar costo actual del producto por su existencia actual
                            $actualizarExistencia->cost = (($actualizarExistencia->cost * $actualizarExistencia->existencia_caja)+($item->attributes[0] * $item->quantity)) / (($actualizarExistencia->existencia_caja + $item->quantity));
                            $actualizarExistencia->iva_cost = $actualizarExistencia->cost * 0.13;
                            $actualizarExistencia->final_cost = $actualizarExistencia->iva_cost + $actualizarExistencia->cost;
                        }
                        $actualizarExistencia->existencia_caja += $item->quantity;
                    }

 
                    $actualizarExistencia->precio_caja = $item->attributes[3];
                    $actualizarExistencia->precio_mayoreo = $item->attributes[4];
                    $actualizarExistencia->precio_unidad = $item->attributes[5];
                    $actualizarExistencia->save();

                    ///ACTUALIZAR LOTE
                    $actualizarlote = Lotes::find($item->id);
                    if($actualizarlote->existencia_lote > 0){
                        $actualizarlote->existencia_lote += $item->quantity;
                        $actualizarlote->save();
                    } else{
                        $actualizarlote->existencia_lote = $item->quantity;
                        $actualizarlote->save();
                    }
                }
            }
            $this->emit('carga-ok','Carga Registrada con exito');
            //$this->emit('print-ticket',$sale->id);
            DB::commit();
            Cart::clear();
            $this->total = Cart::getTotal();
            $this->resetUI();
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error',$e->getMessage());
        }
    }

    public function resetUI(){
        $this->search = '';
        $this->descripcion_carga = ''; 
        $this->numero_lote = ''; 
        $this->caducidad_lote = '';   
        $this->loteId = '';
        $this->existencia_lote_unidad = '';
        $this->resetPage();
        $this->resetValidation();
    }
}
