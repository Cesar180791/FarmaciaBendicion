<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TiposTransacciones;
use App\Models\Product;
use App\Models\Lotes;
use App\Models\Clientes;
use App\Models\Sale; 
use App\Models\SaleDetails;
use App\Models\Denomination;
use App\Models\kardexProductos;
use App\Models\n_facturas;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Carbon\Carbon;
use DB;

class FacturacionController extends Component
{
    use withPagination;

    public $pageTitle2, $transaccionId, $search, $search2, $idProduct, 
            $tipoPrecio, $lotes, $efectivo, $change, $itemsQuantity, 
            $numero_factura, $clientes_id, $selected_id, $nombre_cliente , 
            $telefono ,$NIT_cliente, $NRC_cliente, $gran_con_cliente, 
            $cliente_consumidor_final, $direccion_consumidor_final, 
            $dui_consumidor_final, $lote, $producto, $precio, 
            $id_lote,$descuento, $count = 0, $limitar_cant_producto=0, 
            $data, $details,$countDetails,$sumDetails, $imprimirfacturaModal, $buscar_lote, $id_factura, $numero_factura_inicial,
            $serie_factura;

    private $pagination = 5, $pagination2 = 5;

    public function mount(){
        Cart::clear();
        $this->data = [];
        $this->details = [];
        $this->buscar_lote = [];
        $this->countDetails=0;
        $this->sumDetails=0;
        $this->pageTitle5 = 'Clientes';
        $this->pageTitle4 = 'Seleccionar Lote';
        $this->pageTitle = 'Productos';       
        $this->componentName = 'Facturación';
        $this->gran_con_cliente =   'Seleccionar';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }


    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingSearch2()
    {
        $this->resetPage('clientes-page');
    }


    public function render()
    {
        if ($this->efectivo == null) {
            $this->efectivo=0;
        }

       if ($this->efectivo > 0) {
             $this->change = ($this->efectivo - $this->total);
        }
        $this->itemsQuantity = Cart::getTotalQuantity();

        /**inicio mostrar ventas del dia para reimpresion de facturas */
        $this->SalesDay();





        /**fin mostrar ventas del dia para reimpresion de facturas */        


        if(strlen($this->search2) > 0)
            $data = Clientes::where('nombre_cliente', 'like', '%'.$this->search2.'%')
            ->orWhere('NIT_cliente', 'like', '%'.$this->search2.'%')
            ->orWhere('NRC_cliente', 'like', '%'.$this->search2.'%')
            ->paginate($this->pagination2, ['*'], 'clientes-page');
        else
            $data = Clientes::orderBy('id','desc')->paginate($this->pagination2, ['*'], 'clientes-page');


         $this->lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','lotes.*')
                        ->where([
                            ['lotes.products_id', $this->idProduct], 
                            ['lotes.estado_lote', 'ACTIVO']
                            ]) 
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
                        ->orderBy('products.name','asc')
                        ->paginate($this->pagination);
        else
         $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->orderBy('products.name','asc')
                        ->where('estado','ACTIVO')
                        ->paginate($this->pagination);


        $facturas  = n_facturas::where('user_id', auth()->user()->id)->first();
       //dd($facturas);

        return view('livewire.facturacion.facturacion',[
            'facturas'      =>  $facturas,
            'products'      =>  $products,
            'Clientes'      =>  $data,
            'transacciones' =>  TiposTransacciones::orderBy('id', 'asc')->get(),
            'cart'          =>  Cart::getContent()->sortBy('id'),
            'denominations' =>  Denomination::orderBy('type','asc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [ 
        'removeItem',
        'saveSale',
        'clearCart',
        'scanCode'
    ];

    public function StoreFactura(){
        $rules = [
            'serie_factura'             => 'required',
            'numero_factura_inicial'    =>  'required|int',
        ];

        $messages = [
            'serie_factura' => 'El numero de serie es requerido',
            'numero_factura_inicial.required'   => 'El N° de factura es requerido',
            'numero_factura_inicial.int'   => 'El N° de factura debe ser un numero entero',
        ];

        $this->validate($rules, $messages);

        n_facturas::create([
            'user_id'    =>  auth()->user()->id,
            'serie_factura' => $this->serie_factura,
            'numero_factura_inicial' =>  $this->numero_factura_inicial,
            'numero_factura_correlativo' =>  $this->numero_factura_inicial,
        ]);

        //$this->resetUI();
        $this->emit('factura-add');


    }


    public function changeFactura(n_facturas $factura){
        $this->id_factura = $factura->id;
        $this->serie_factura = $factura->serie_factura;
        $this->numero_factura_inicial = $factura->numero_factura_inicial;

        $this->emit("show-factura");
    }

    public function UpdateFactura(){
        $rules = [
            'serie_factura'             => 'required',
            'numero_factura_inicial'    =>  'required|int',
        ];

        $messages = [
            'serie_factura' => 'El numero de serie es requerido',
            'numero_factura_inicial.required'   => 'El N° de factura es requerido',
            'numero_factura_inicial.int'   => 'El N° de factura debe ser un numero entero',
        ];
        $this->validate($rules, $messages);

        $factura = n_facturas::find($this->id_factura);
        $factura->update([
            'serie_factura' => $this->serie_factura,
            'numero_factura_inicial' =>  $this->numero_factura_inicial,
            'numero_factura_correlativo' =>  $this->numero_factura_inicial,
        ]);

        $this->numero_factura_inicial = '';
        $this->emit('factura-update');
    }


    public function scanCode($barcode, $cant = 1){
        
        $producto = Product::where('barCode', $barcode)->first();
        
        if($producto == null){
            $this->emit('scan-not-found','El producto no esta registrado');
        } else{

            $buscar_lote = Lotes::where([
                ['products_id', $producto->id],
                ['estado_lote', 'ACTIVO']
                ])
            ->orderBy('caducidad_lote', 'asc')->take(1)
            ->first();

            if($buscar_lote == null){
                $this->emit('scan-not-found','La existencia total de lotes esta en el detalle de la factura o ya no hay en existencias');
                return;
            }

            if($this->InCart($buscar_lote->id)){

                $exist = Cart::get($buscar_lote->id);

                if($this->tipoPrecio === "UNIDAD"){
					 
                    if($exist->quantity >= $buscar_lote->existencia_lote_unidad){
                            $buscar_lote->update([
                                'estado_lote' => 'DESHABILITADO'
                            ]);
                    }
                }
                if($this->tipoPrecio === "NORMAL" || $this->tipoPrecio === "MAYOREO"){
                    if($exist->quantity == $buscar_lote->existencia_lote){
                        $buscar_lote->update([
                            'estado_lote' => 'DESHABILITADO'
                        ]);
                    } else{
                        $buscar_lote->update([
                            'estado_lote' => 'ACTIVO'
                        ]);
                    }
                }
             
                $this->increaseQty($producto->id, $buscar_lote->id);
                return;

            } else{

                if($producto->unidades_presentacion > 1){
                    $this->tipoPrecio  = 'UNIDAD';
                }else{
                    $this->tipoPrecio  = 'NORMAL';
                }


                if($this->tipoPrecio === 'NORMAL'){
                    $precioVenta = $producto->precio_caja;
                    $cost =  $producto->cost;
                    $iva_cost =  $producto->iva_cost;
                    $final_cost =  $producto->final_cost;
    
                    if ($buscar_lote->existencia_lote <1 ) {
                        $this->emit('no-stock', 'Existencias Insuficientes para: ' .$producto->name. ' lote N°: '. $buscar_lote->numero_lote);
                        return;
                    }
                }

                if($this->tipoPrecio === 'UNIDAD'){
                    $precioVenta = $producto->precio_unidad;
                    $cost =  $producto->cost / $producto->unidades_presentacion;
                    $iva_cost =  $producto->iva_cost / $producto->unidades_presentacion;
                    $final_cost =  $producto->final_cost / $producto->unidades_presentacion;
    
                    if ($buscar_lote->existencia_lote_unidad <1 ) {
                        if($buscar_lote->existencia_lote < 1){
                            $this->emit('no-stock', 'Stock insuficiente');
                            return;
                        }
                    }
                }

                Cart::add(
                    $buscar_lote->id,
                    $producto->name,
                    $precioVenta,
                    $cant,
                    array(
                        $cost,
                        $iva_cost, 
                        $final_cost, 
                        $buscar_lote->numero_lote,
                        $buscar_lote->caducidad_lote,
                        $producto->id,
                        $this->tipoPrecio,
                        $descuento=0
                    ));
                    $this->total = Cart::getTotal();
                    $this->itemsQuantity = Cart::getTotalQuantity();
                    $this->emit('add-ok');
                    $this->limitar_cant_producto++;
            }

        }
    } 

    //con esta funcion se le asiganara el id de transaccion a la variable $transaccionId
    public function validarTipoTransaccion(TiposTransacciones $transaccionId){
        $this->transaccionId = $transaccionId->id;
        if($this->transaccionId === 1){
            $this->pageTitle2 = 'Detalle de venta Consumidor Final';
            $this->emit('facturacion');
            //dd($this->transaccionId);
            //dd('Emitir evento para abrir interfaces de facturacion consumidor final');
        }
        if($this->transaccionId === 2){
            $this->pageTitle2 = 'Detalle de venta Credito Fiscal';
            $this->emit('credito-fiscal');
            //dd($this->transaccionId);
        }
        else{
            //dd('Tipo de facturacion en desarrollo o no registrado');
        }
    }

    //funcion para asignar el precio de venta y el id del producto para buscar el lote
    public function verLotes($idProduct, $tipoPrecio){
        $this->idProduct = $idProduct;
        $this->tipoPrecio = $tipoPrecio;
        $this->emit('ver-lotes');

        //dd('Tipo de precio: ' . $this->tipoPrecio . ' id: ' . $this->idProduct = $idProduct);
    }

    public function addItem($id, $id_lote, $cant = 1){
        
        $product = Product::where('id', $id)->first();
        $buscar_lote = Lotes::where('id', $id_lote)->first();

        if($product == null){
            $this->emit('producto-no-encontrado','El producto no esta registrado');
        } else {
            if( $this->limitar_cant_producto == 6){
                $this->emit('maximo-producto-factura','El maximo de producto por factura es de 6, por favor imprima la factura');
                return;
            }
            
            if($this->InCart($buscar_lote->id)) {
                $this->increaseQty($product->id,$buscar_lote->id);
                return;
            }
            
            if($this->tipoPrecio === 'NORMAL'){
                $precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if ($buscar_lote->existencia_lote <1 ) {
                    $this->emit('no-stock', 'Existencias Insuficientes para: ' .$product->name. ' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($this->tipoPrecio === 'MAYOREO'){
               $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if ($buscar_lote->existencia_lote <1 ) {
                    $this->emit('no-stock', 'Existencias Insuficientes para: '.$product->name.' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($this->tipoPrecio === 'UNIDAD'){
                $precioVenta = $product->precio_unidad;
                $cost =  $product->cost / $product->unidades_presentacion;
                $iva_cost =  $product->iva_cost / $product->unidades_presentacion;
                $final_cost =  $product->final_cost / $product->unidades_presentacion;

                if ($buscar_lote->existencia_lote_unidad <1 ) {
                    if($buscar_lote->existencia_lote < 1){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                }
            }

            Cart::add(
                $buscar_lote->id,
                $product->name,
                $precioVenta,
                $cant,
                array(
                    $cost,
                    $iva_cost, 
                    $final_cost, 
                    $buscar_lote->numero_lote,
                    $buscar_lote->caducidad_lote,
                    $product->id,
                    $this->tipoPrecio,
                    $descuento=0
                ));
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('add-ok');
                $this->limitar_cant_producto++;
        }
        $this->search = '';
    }


    public function InCart($loteId){
        $exist = Cart::get($loteId);

        if ($exist) {
            $this->tipoPrecio = $exist->attributes[6];
            return true;
        }else{ 
            return false;
        }
    }

    public function increaseQty($productId, $id_lote, $cant = 1){
     
        $title ='';
        $product = Product::find($productId);
        $buscar_lote = Lotes::find($id_lote);
        $exist = Cart::get($id_lote);
        if ($exist)
           $title = 'Cantidad Actualizada';
        else
            $title = 'producto Agregado'; 


        if($exist){
            if($this->tipoPrecio === 'NORMAL'){
               // $precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($buscar_lote->existencia_lote <($cant + $exist->quantity)){
                    $this->emit('no-stock', 'Existencias Insuficientes para: ' .$product->name. ' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($this->tipoPrecio === 'MAYOREO'){
               // $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($buscar_lote->existencia_lote <($cant + $exist->quantity)){
                    $this->emit('no-stock', 'Existencias Insuficientes para: ' .$product->name. ' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($this->tipoPrecio === 'UNIDAD'){
               // $precioVenta = $product->precio_unidad;
                $cost =  $product->cost / $product->unidades_presentacion;
                $iva_cost =  $product->iva_cost / $product->unidades_presentacion;
                $final_cost =  $product->final_cost / $product->unidades_presentacion;

                if($buscar_lote->existencia_lote_unidad <($cant + $exist->quantity)){
                    if($buscar_lote->existencia_lote < 0){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                    if(($product->unidades_presentacion * $buscar_lote->existencia_lote + $buscar_lote->existencia_lote_unidad) < ($cant + $exist->quantity)){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                }
            }
        }

        Cart::add(
            $buscar_lote->id,
            $product->name,
            $exist->price,
            $cant,
            array(
                $cost,
                $iva_cost, 
                $final_cost, 
                $buscar_lote->numero_lote,
                $buscar_lote->caducidad_lote,
                $product->id,
                $exist->attributes[6],
                $exist->attributes[7]
            ));

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    //por el momento no se usa
    public function decreaseQty($loteId){
        $item = Cart::get($loteId);

        $buscar_lote = Lotes::find($loteId);

        $buscar_lote->update([
            'estado_lote' => 'ACTIVO'
        ]);
       

        if($item->quantity > 1){
           Cart::remove($loteId);
            $newQty = ($item->quantity)-1;

            if($newQty > 0)
                Cart::add(
                $item->id,
                $item->name,
                $item->price,
                $newQty,
                array(
                    $item->attributes[0],
                    $item->attributes[1], 
                    $item->attributes[2], 
                    $item->attributes[3],
                    $item->attributes[4],
                    $item->attributes[5],
                    $item->attributes[6],
                    $item->attributes[7]
                ));
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        //$this->emit('add-ok','Cantidad Actualiada');
    }


    public function updateCant($loteId, $cant, $productId){

        $product = Product::find($productId);
        $buscar_lote = Lotes::find($loteId);
        $exist = Cart::get($loteId);

        if($cant == 0 || $cant == null){
            $cant = 1;
        }
        
        if($exist){
            if($exist->attributes[6] === 'NORMAL'){
                //$precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($buscar_lote->existencia_lote < $cant){
                    $this->emit('no-stock',  'Existencias Insuficientes para: ' .$product->name. ' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($exist->attributes[6] === 'MAYOREO'){
               // $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($buscar_lote->existencia_lote < $cant){
                    $this->emit('no-stock',  'Existencias Insuficientes para: ' .$product->name. ' lote N°: '. $buscar_lote->numero_lote);
                    return;
                }
            }
            if($exist->attributes[6] === 'UNIDAD'){
               // $precioVenta = $product->precio_unidad;
                $cost =  $product->cost / $product->unidades_presentacion;
                $iva_cost =  $product->iva_cost / $product->unidades_presentacion;
                $final_cost =  $product->final_cost / $product->unidades_presentacion;

                if($buscar_lote->existencia_lote_unidad < $cant){
                    if($buscar_lote->existencia_lote < 0){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                    if(($product->unidades_presentacion * $buscar_lote->existencia_lote + $buscar_lote->existencia_lote_unidad) < $cant){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }

                }
            }
        }
        
        $this->removeItem($loteId);
        $this->limitar_cant_producto++;

        if ($cant > 0) {
           Cart::add(
                $buscar_lote->id,
                $product->name,
                $exist->price,
                $cant,
               array(
                $cost,
                $iva_cost, 
                $final_cost, 
                $buscar_lote->numero_lote,
                $buscar_lote->caducidad_lote,
                $product->id,
                $exist->attributes[6],
                $exist->attributes[7]
                ));
           $this->total = Cart::getTotal();
           $this->itemsQuantity = Cart::getTotalQuantity();
           //$this->emit('add-ok', $title);
       }
    }

    public function removeItem($productId){
        Cart::remove($productId);

        $buscar_lote = Lotes::find($productId);

        $buscar_lote->update([
            'estado_lote' => 'ACTIVO'
        ]);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->limitar_cant_producto-=1;
       // $this->emit('add-ok','Producto eliminado');
    }

    public function Acash($value){
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    public function clearCart(){

        $items = Cart::getContent();
        foreach($items as $item){
            $buscar_lote = Lotes::find($item->id);
            $buscar_lote->update([
                'estado_lote' => 'ACTIVO'
            ]);
        }

        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('add-ok','Carrito Vacio');

    }


      //Crear Cliente
      public function Store(){
        $rules = [
            'nombre_cliente'    =>  'required|unique:clientes|min:3',
            'telefono'          =>  'required|min:8',
            'NIT_cliente'       =>  'required|min:10|unique:clientes,NIT_cliente',
            'NRC_cliente'       =>  'required|min:10|unique:clientes,NRC_cliente',
            'gran_con_cliente'  =>  'required|not_in:Seleccionar'
        ];

        $messages = [
            'nombre_cliente.required'   => 'Nombre de el cliente es requerido',
            'nombre_cliente.unique'     => 'El cliente ya existe',
            'nombre_cliente.min'        => 'El cliente debe tener al menos 3 caracteres',
            'telefono.required'         => 'telefono de el cliente es requerido',
            'telefono.min'              => 'El telefono debe tener al menos 8 caracteres',
            'NIT_cliente.required'      => 'El NIT del cliente es requerido',
            'NIT_cliente.min'           => 'El NIT del cliente debe tener al menos 10 caracteres',
            'NIT_cliente.unique'        => 'El NIT ingresado ya esta asociado a otro cliente',
            'NRC_cliente.required'      => 'El NRC del cliente es requerido',
            'NRC_cliente.min'           => 'El NRC del cliente debe tener al menos 10 caracteres',
            'NRC_cliente.unique'        => 'El NRC ingresado ya esta asociado a otro cliente',
            'gran_con_cliente.not_in'   => 'Selecciona si es gran contribuyente'
        ];

        $this->validate($rules, $messages);
        
        Clientes::create([
            'nombre_cliente'    =>  $this->nombre_cliente,
            'telefono'          =>  $this->telefono,
            'NIT_cliente'       =>  $this->NIT_cliente,
            'NRC_cliente'       =>  $this->NRC_cliente,
            'gran_con_cliente'  =>  $this->gran_con_cliente
        ]);

        //$this->resetUI();
        $this->emit('cliente-added','Cliente registrado');
    }

    ///asignar id del cliente
    public function ClienteCreditoFiscal($idCliente){
        $this->selected_id = $idCliente;
        $this->emit('facturacion');
    }

    public function DescuentoProduct($loteId){
        $exist = Cart::get($loteId);

        $this->id_lote = $exist->id;
        $this->lote = $exist->attributes[3];
        $this->producto = $exist->name;
        $this->precio = $exist->price;
        $this->descuento = $exist->attributes[7];
        
        $this->emit('abrir-interfaz-descuento'); 
    }

    public function aplicarDescuento($id_lote, $descuento){
        $exist = Cart::get($id_lote);

        if($descuento > $exist->price){
            $this->emit('exceder-descuento','El descuento es mayor al precio de venta');
            return;
        }

        if($descuento == 0 || $descuento == null){
            $this->restablecerPrecioVenta($exist->id);
            return;
        }

        $nuevoPrecio = $exist->price - $descuento;

        Cart::update($exist->id, array( array(
            $exist->price = $nuevoPrecio,
            $exist->attributes[7] = $descuento,
        )));

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('descuento-aplicado');

    }

    public function restablecerPrecioVenta($IdLote){
        $exist = Cart::get($IdLote);
        $producto = Product::where('id', $exist->attributes[5])->first();

        if($exist->attributes[6] === 'NORMAL'){
           $restablecerPrecio = $producto->precio_caja; 
        }
        if($exist->attributes[6] === 'MAYOREO'){
            $restablecerPrecio = $producto->precio_mayoreo; 
         }
         if($exist->attributes[6] === 'UNIDAD'){
            $restablecerPrecio = $producto->precio_unidad; 
         }

        Cart::update($exist->id, array( array(
            $exist->price = $restablecerPrecio,
            $exist->attributes[7] = 0
        )));

        $this->emit('descuento-aplicado');
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }


    public function cambiarTipoPrecio($IdLote){
        $exist = Cart::get($IdLote);
        $lotes = Lotes::where('id',$IdLote)->first();
        $producto = Product::where('id', $exist->attributes[5])->first();

        if($this->count == 0){
            if($lotes->existencia_lote < 1){
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
            $this->removeItem($IdLote);
            $this->limitar_cant_producto++;

            $precio = $producto->precio_caja;
            $costo  = $producto->cost;
            $iva    = $producto->iva_cost;
            $final_cost  = $producto->final_cost;

            $this->tipoPrecio = 'NORMAL';

            Cart::add(
                $exist->id,
                $exist->name,
                $precio,
                1,
                array(
                    $costo,
                    $iva, 
                    $final_cost, 
                    $exist->attributes[3],
                    $exist->attributes[4],
                    $exist->attributes[5],
                    $this->tipoPrecio,
                    0
                ));
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->total = Cart::getTotal();

            $this->count++;
            return;
        }

        if($this->count == 1){
            if($lotes->existencia_lote < 1){
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }

            $this->removeItem($IdLote);
            $this->limitar_cant_producto++;
            $precio = $producto->precio_mayoreo;
            $costo  = $producto->cost;
            $iva    = $producto->iva_cost;
            $final_cost  = $producto->final_cost;
            $this->tipoPrecio = 'MAYOREO';

             Cart::add(
                $exist->id,
                $exist->name,
                $precio,
                1,
                array(
                    $costo,
                    $iva, 
                    $final_cost, 
                    $exist->attributes[3],
                    $exist->attributes[4],
                    $exist->attributes[5],
                    $this->tipoPrecio,
                    0
                ));
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->total = Cart::getTotal();
            
            if($producto->precio_unidad != null){
                $this->count++;
            }else{
                $this->count=0;
            }
            return;
        }
        if($this->count == 2){

            $this->removeItem($IdLote);
            $this->limitar_cant_producto++;

             $precio = $producto->precio_unidad;
             $costo  = $producto->cost / $producto->unidades_presentacion;
             $iva    = $producto->iva_cost / $producto->unidades_presentacion;
             $final_cost  = $producto->final_cost / $producto->unidades_presentacion;
             $this->tipoPrecio = 'UNIDAD';
             $this->count = 0;

             Cart::add(
                $exist->id,
                $exist->name,
                $precio,
                1,
                array(
                    $costo,
                    $iva, 
                    $final_cost, 
                    $exist->attributes[3],
                    $exist->attributes[4],
                    $exist->attributes[5],
                    $this->tipoPrecio,
                    0
                ));

            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->total = Cart::getTotal();
            
            return;
        }        
    }

     public function saveSale(){
        if($this->total <=0){
            $this->emit('sale-error','Agrega productos al detalle');
            return;
        }
         if($this->efectivo <=0){
            $this->emit('sale-error','Ingrese el efectivo');
            return;
        }
         if($this->total > $this->efectivo){
            $this->emit('sale-error','El efectivo debe ser mayor o igual al total');
            return;
        }

        DB::beginTransaction();

        try {
            if ($this->transaccionId === 1) {
                if($this->total > 100){
                    $rules = [
                        //'cliente_consumidor_final'    =>  'required|min:3|max:150',
                        //'direccion_consumidor_final'    =>  'required|min:3|max:150',
                        'dui_consumidor_final'    =>  'required|min:10|max:10',
                        //'numero_factura'    =>  'required|min:3',
                    ];
            
                    $messages = [
                        //'cliente_consumidor_final.required'     => 'Nombre cliente es requerido',    
                        //'cliente_consumidor_final.min'          => 'Nombre cliente debe tener al menos 3 caracteres',  
                        //'cliente_consumidor_final.max'          => 'Nombre cliente debe tener al max 150 caracteres',
                        //'direccion_consumidor_final.required'   => 'Dirección cliente es requerido',    
                        //'direccion_consumidor_final.min'        => 'Dirección cliente debe tener al menos 3 caracteres',  
                        //'direccion_consumidor_final.max'        => 'Dirección cliente debe tener al max 150 caracteres',   
                        'dui_consumidor_final.required'         => 'Compra mayor a $100 Dui es requerido',    
                        'dui_consumidor_final.min'              => 'DUI cliente debe tener al menos 10 caracteres',  
                        'dui_consumidor_final.max'              => 'DUI cliente debe tener al max 10 caracteres',
                        //'numero_factura.required'   => 'Numero de factura es requerido',    
                        //'numero_factura.min'        => 'El numero de factura debe tener al menos 3 caracteres',           
                    ];
                    $this->validate($rules, $messages);
                } /*else{

                    $rules = [
                        'numero_factura'    =>  'required|min:3',
                    ];
            
                    $messages = [
                        'numero_factura.required'   => 'Numero de factura es requerido',    
                        'numero_factura.min'        => 'El numero de factura debe tener al menos 3 caracteres',           
                    ];
                    $this->validate($rules, $messages);
                }*/
                
                $facturas  = n_facturas::where('user_id', auth()->user()->id)->first();

                if($this->cliente_consumidor_final == null){
                    $this->cliente_consumidor_final = 'Clientes Varios';
                }

                if($this->direccion_consumidor_final == null){
                    $this->direccion_consumidor_final = 'San Miguel';
                }
                $sale = Sale::create([
                    'cliente_consumidor_final'      =>  $this->cliente_consumidor_final,
                    'direccion_consumidor_final'    =>  $this->direccion_consumidor_final,
                    'dui_consumidor_final'          =>  $this->dui_consumidor_final,
                    'total'                         =>  $this->total,
                    'items'                         =>  $this->itemsQuantity,
                    'cash'                          =>  $this->efectivo,
                    'change'                        =>  $this->change,
                    'numero_factura'                =>  $facturas->serie_factura . " " . $facturas->numero_factura_correlativo,
                    'tipos_transacciones_id'        =>  $this->transaccionId,
                    'user_id'                       =>  auth()->user()->id
                ]);

                $newCorrelativo = $facturas->numero_factura_correlativo + 1;
                
                $facturas ->update([
                    'numero_factura_correlativo' => $newCorrelativo
                ]);

            }
            if ($this->transaccionId === 2) {

                $rules = [
                    'numero_factura'    =>  'required|min:3',
                ];
        
                $messages = [
                    'numero_factura.required'   => 'Numero de factura es requerido',    
                    'numero_factura.min'        => 'El numero de factura debe tener al menos 3 caracteres',                  
                ];
        
                $this->validate($rules, $messages);

                $sale = Sale::create([
                'total'                  => $this->total,
                'items'                  => $this->itemsQuantity,
                'cash'                   => $this->efectivo,
                'change'                 => $this->change,
                'numero_factura'         => $this->numero_factura,
                'clientes_id'            => $this->selected_id,           
                'tipos_transacciones_id' => $this->transaccionId,
                'user_id'                => auth()->user()->id
                ]);
            }
            if ($sale) {

                ///se crea el registro en la tabla ventas se busca en el carrito el detalle 
                $items = Cart::getContent();
                
                ///se recorre el detalle para guardar en la tabla detalle de ventas 
                foreach($items as $item){

                    $product = Product::find($item->attributes[5]);
                    $actualizarLote = Lotes::find($item->id);

                    if($product->unidades_presentacion == 1){
                        $costo_unitario = 0; 
                    }else{
                        $costo_unitario = $product->cost / $product->unidades_presentacion;
                    }

                    $kardex = kardexProductos::where('products_id', $item->attributes[5])->get();

                    if (count($kardex) == 0) {
                        
                        kardexProductos::create([
                            'products_id' => $item->attributes[5],
                            'concepto' => "Inicio de KARDEX",
                            'cantidad_existencias_ppal' => $product->existencia_caja,
                            'cantidad_existencias_unitarias' => $product->existencia_unidad,
                            'costo_unit_existencias_ppal' => $product->cost,
                            'costo_unit_existencias_unitarias' => $costo_unitario,
                            'costo_total_existencias' => ($product->cost * $product->existencia_caja) + (($product->cost / $product->unidades_presentacion) * $product->existencia_unidad),
                            'id_transaccion' => 0,
                            'tipo_movimiento' => 'Inicio'

                        ]);
                    }

                    $precio_venta = $item->price / 1.13;
                    $iva_precio_venta = $item->price - $precio_venta;
                    
                    $detalle = SaleDetails::create([
                        'lotes_id' => $item->id,
                        'sale_id' => $sale->id,
                        'tipo_venta' => $item->attributes[6],
                        'costo' =>  $item->attributes[0],
                        'costo_iva' =>  $item->attributes[1],
                        'costo_mas_iva' => $item->attributes[2],
                        'precio_venta' => $precio_venta,
                        'iva_precio_venta' => $iva_precio_venta,
                        'precio_venta_mas_iva' => $item->price,
                        'quantity' => $item->quantity,   
                    ]);

                    //inicio actualizar el stock

                    //$product = Product::find($item->attributes[5]);
                    //$actualizarLote = Lotes::find($item->id);

                    if($item->attributes[6] === 'NORMAL' || $item->attributes[6] === 'MAYOREO'){
                        $product->existencia_caja -= $item->quantity;
                        $product->save();

                        $actualizarLote->existencia_lote -= $item->quantity;
                        $actualizarLote->save();

                        if($actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === 0 || $actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === null){
                            $actualizarLote->estado_lote = 'DESHABILITADO';
                            $actualizarLote->save();
                        }
                    }

                    if($item->attributes[6] === 'UNIDAD'){
                        if($actualizarLote->existencia_lote_unidad >= $item->quantity){
                            $product->existencia_unidad -= $item->quantity;
                            $product->save();
                            $actualizarLote->existencia_lote_unidad -= $item->quantity;

                            if($actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === 0){
                                $actualizarLote->estado_lote = 'DESHABILITADO';
                            }

                            $actualizarLote->save();

                        }else{
                            //restar caja y añadir unidades a stock unidades producto
                            $product->existencia_caja -= 1;
                            $product->existencia_unidad += $product->unidades_presentacion;

                            //luego hacer el debido descago de el inventario
                            $product->existencia_unidad -= $item->quantity;
                            $product->save();

                            //hacer lo mismo con el inventario por lotes
                            $actualizarLote->existencia_lote -= 1;
                            $actualizarLote->existencia_lote_unidad += $product->unidades_presentacion;

                            $actualizarLote->existencia_lote_unidad -= $item->quantity;

                            $actualizarLote->save();

                            if($actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === 0){
                                $actualizarLote->estado_lote = 'DESHABILITADO';
                                $actualizarLote->save();
                            }
                        }
                    }

                    if ($this->transaccionId === 1 ) {
                        $tipoVenta = "Consumidor Final";
                        $factura = $facturas->numero_factura_correlativo ;
                    }
                    if ($this->transaccionId === 2) {
                       $tipoVenta = "Credito Fiscal";
                       $factura = $this->numero_factura ;
                    }

                    if($product->unidades_presentacion == 1){
                        $costo_unitario = 0; 
                    }else{
                        $costo_unitario = $product->cost / $product->unidades_presentacion;
                    }

                    kardexProductos::create([
                            'products_id' => $item->attributes[5],
                            'concepto' => "Venta " . $tipoVenta . ' Factura N° : ' . $factura . ' Tipo de venta ' . $item->attributes[6] . ' ID: ' . $sale->id,
                            'cantidad_salida' => $item->quantity,
                            'costo_unit_salida' => $item->attributes[0],
                            'costo_total_salida' => $item->attributes[0] * $item->quantity,
                            'cantidad_existencias_ppal' => $product->existencia_caja,
                            'cantidad_existencias_unitarias' => $product->existencia_unidad,
                            'costo_unit_existencias_ppal' => $product->cost,
                            'costo_unit_existencias_unitarias' => $costo_unitario,
                            'costo_total_existencias' => ($product->cost * $product->existencia_caja) + (($product->cost / $product->unidades_presentacion) * $product->existencia_unidad),
                            'id_transaccion' => $sale->id,
                            'tipo_movimiento' => 'Venta',
                            'sale_details_id' =>  $detalle->id

                        ]);

                     //Fin  actualizar la cantidad de producto
                }
            }

            DB::commit();
           
            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->resetUI();

            $this->emit('sale-ok','Venta Registrada');

            if($sale->tipos_transacciones_id == 1){
                $this->emit('print-factura-consumidor-final',$sale->id);
            }

            if($sale->tipos_transacciones_id == 2){
                $this->emit('print-factura-credito-fiscal',$sale->id);
            }
            $this->limitar_cant_producto = 0;
        } catch (Exception $e) {
            DB::rollback();
             $this->emit('sale-error',$e->getMessage());
        }
    }
    
    public function resetUI(){
        $this->cliente_consumidor_final     =   '';
        $this->direccion_consumidor_final   =   '';
        $this->dui_consumidor_final         =   '';
        $this->numero_factura               =   '';
        $this->nombre_cliente               =   ''; 
        $this->telefono                     =   ''; 
        $this->NIT_cliente                  =   '';
        $this->NRC_cliente                  =   '';
        $this->gran_con_cliente             =   'Seleccionar';
        $this->selected_id                  =   0;
        $this->search                       =   '';
        $this->resetPage();
        $this->resetValidation();
    }

    public function SalesDay(){
        $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';

        $this->data = Sale::join('tipos_transacciones as tt','tt.id','sales.tipos_transacciones_id')
        ->select('sales.*','tt.tipo_transaccion')
        ->whereBetween('sales.created_at',[$from,$to])
        ->where('user_id',auth()->user()->id)
        ->orderBy('sales.id','desc')
        ->get();

    }

    public function verDetalle($idVenta){
        $this->details = SaleDetails::join('lotes as l','l.id','sale_details.lotes_id')
                                ->join('products as p', 'p.id','l.products_id')
                                ->select('l.products_id','sale_details.id' ,'sale_details.precio_venta_mas_iva','sale_details.quantity as cantidad','p.name')
                                ->where('sale_details.sale_id',$idVenta)
                                ->get();

                                $this->countDetails = $this->details->sum('cantidad');

                                $suma = $this->details->sum(function($item){
                                    return $item->cantidad * $item->precio_venta_mas_iva;
                                });
                                $this->sumDetails = $suma;

                                $this->imprimirfacturaModal = $idVenta;
                                $this->emit('show-modal-detalle');
    }
}
