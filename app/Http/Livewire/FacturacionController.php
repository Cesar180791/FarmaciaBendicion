<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TiposTransacciones;
use App\Models\Product;
use App\Models\Lotes;
use App\Models\Sale; 
use App\Models\SaleDetails;
use App\Models\Denomination;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class FacturacionController extends Component
{
    use withPagination;

    public $transaccionId, $search, $idProduct, $tipoPrecio, $lotes, $efectivo, $change, $itemsQuantity;

    private $pagination = 5;

    public function mount(){
       // Cart::clear();
        $this->pageTitle4 = 'Seleccionar Lote';
        $this->pageTitle = 'Productos';
        $this->pageTitle2 = 'Detalle de venta';
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
        if ($this->efectivo == null) {
            $this->efectivo=0;
        }

       if ($this->efectivo > 0) {
             $this->change = ($this->efectivo - $this->total);
        }
        $this->itemsQuantity = Cart::getTotalQuantity();

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
        'clearCart'
    ];

    //con esta funcion se le asiganara el id de transaccion a la variable $transaccionId
    public function validarTipoTransaccion(TiposTransacciones $transaccionId){
        $this->transaccionId = $transaccionId->id;
        if($this->transaccionId === 1){
            $this->emit('consumidor-final');
            //dd($this->transaccionId);
            //dd('Emitir evento para abrir interfaces de facturacion consumidor final');
        }
        if($this->transaccionId === 2){
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
            if ($this->InCart($buscar_lote->id)) {
                $this->increaseQty($product->id,$buscar_lote->id);
                return;
            }

            if($this->tipoPrecio === 'NORMAL'){
                $precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if ($buscar_lote->existencia_lote <1 ) {
                    $this->emit('no-stock', 'Existencias Insuficientes');
                    return;
                }
            }
            if($this->tipoPrecio === 'MAYOREO'){
                $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if ($buscar_lote->existencia_lote <1 ) {
                    $this->emit('no-stock', 'Existencias Insuficientes');
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
                    $this->tipoPrecio
                ));
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('add-ok');
        }
    }

    public function InCart($loteId){
        $exist = Cart::get($loteId);
        if ($exist) 
            return true;
        else 
            return false;
    }

    public function increaseQty($productId, $id_lote, $cant = 1){
     
        $title ='';
        $product = Product::find($productId);
        $lote = Lotes::find($id_lote);
        $exist = Cart::get($id_lote);
        if ($exist)
           $title = 'Cantidad Actualizada';
       else
            $title = 'producto Agregado'; 


        if($exist){
            if($this->tipoPrecio === 'NORMAL'){
                $precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($lote->existencia_lote <($cant + $exist->quantity)){
                    $this->emit('no-stock', 'Stock insuficiente');
                    return;
                }
            }
            if($this->tipoPrecio === 'MAYOREO'){
                $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($lote->existencia_lote <($cant + $exist->quantity)){
                    $this->emit('no-stock', 'Stock insuficiente');
                    return;
                }
            }
            if($this->tipoPrecio === 'UNIDAD'){
                $precioVenta = $product->precio_unidad;
                $cost =  $product->cost / $product->unidades_presentacion;
                $iva_cost =  $product->iva_cost / $product->unidades_presentacion;
                $final_cost =  $product->final_cost / $product->unidades_presentacion;

                if($lote->existencia_lote_unidad <($cant + $exist->quantity)){
                    if($lote->existencia_lote < 0){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                    if(($product->unidades_presentacion * $lote->existencia_lote + $lote->existencia_lote_unidad) < ($cant + $exist->quantity)){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }

                }
            }
        }

        Cart::add(
            $lote->id,
            $product->name,
            $precioVenta,
            $cant,
            array(
                $cost,
                $iva_cost, 
                $final_cost, 
                $lote->numero_lote,
                $lote->caducidad_lote,
                $product->id,
                $this->tipoPrecio
            ));

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function decreaseQty($loteId){
        $item = Cart::get($loteId);
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
                $item->attributes[6]
            ));

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        //$this->emit('add-ok','Cantidad Actualiada');
    }


    public function updateCant($loteId, $cant = 1, $productId){

        $product = Product::find($productId);
        $lote = Lotes::find($loteId);
        $exist = Cart::get($loteId);
        
        if($exist){
            if($this->tipoPrecio === 'NORMAL'){
                $precioVenta = $product->precio_caja;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($lote->existencia_lote < $cant){
                    $this->emit('no-stock', 'Stock insuficiente');
                    return;
                }
            }
            if($this->tipoPrecio === 'MAYOREO'){
                $precioVenta = $product->precio_mayoreo;
                $cost =  $product->cost;
                $iva_cost =  $product->iva_cost;
                $final_cost =  $product->final_cost;

                if($lote->existencia_lote < $cant){
                    $this->emit('no-stock', 'Stock insuficiente');
                    return;
                }
            }
            if($this->tipoPrecio === 'UNIDAD'){
                $precioVenta = $product->precio_unidad;
                $cost =  $product->cost / $product->unidades_presentacion;
                $iva_cost =  $product->iva_cost / $product->unidades_presentacion;
                $final_cost =  $product->final_cost / $product->unidades_presentacion;

                if($lote->existencia_lote_unidad < $cant){
                    if($lote->existencia_lote < 0){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }
                    if(($product->unidades_presentacion * $lote->existencia_lote + $lote->existencia_lote_unidad) < $cant){
                        $this->emit('no-stock', 'Stock insuficiente');
                        return;
                    }

                }
            }
        }
        
        $this->removeItem($loteId);

        if ($cant > 0) {
           Cart::add(
                $lote->id,
                $product->name,
                $precioVenta,
               $cant,
               array(
                $cost,
                $iva_cost, 
                $final_cost, 
                $lote->numero_lote,
                $lote->caducidad_lote,
                $product->id,
                $this->tipoPrecio
                ));
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

    public function Acash($value){
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    public function clearCart(){
        Cart::clear();

        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('add-ok','Carrito Vacio');

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
                $sale = Sale::create([
                'total'                  => $this->total,
                'items'                  => $this->itemsQuantity,
                'cash'                   => $this->efectivo,
                'change'                 => $this->change,
                'tipos_transacciones_id' => $this->transaccionId,
                'user_id'                => auth()->user()->id
                ]);
            }
            if ($this->transaccionId === 2) {
                $sale = Sale::create([
                'total'                  => $this->total,
                'items'                  => $this->itemsQuantity,
                'cash'                   => $this->efectivo,
                'change'                 => $this->change,
                'numero_factura'         => '001',
                'clientes_id'            => 1,           
                'tipos_transacciones_id' => $this->transaccionId,
                'user_id'                => auth()->user()->id
                ]);
            }
            if ($sale) {

                ///se crea el registro en la tabla ventas se busca en el carrito el detalle 
                $items = Cart::getContent();
                
                ///se recorre el detalle para guardar en la tabla detalle de ventas 
                foreach($items as $item){
                    $precio_venta = $item->price / 1.13;
                    $iva_precio_venta = $item->price - $precio_venta;
                    
                    SaleDetails::create([
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

                    $product = Product::find($item->attributes[5]);
                    $actualizarLote = Lotes::find($item->id);

                    if($item->attributes[6] === 'NORMAL' || $item->attributes[6] === 'MAYOREO'){
                        $product->existencia_caja -= $item->quantity;
                        $product->save();

                       
                        $actualizarLote->existencia_lote -= $item->quantity;
                        $actualizarLote->save();
                    }

                    if($item->attributes[6] === 'UNIDAD'){
                        if($actualizarLote->existencia_lote_unidad >= $item->quantity){
                            $product->existencia_unidad -= $item->quantity;
                            $product->save();
                            $actualizarLote->existencia_lote_unidad -= $item->quantity;
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
                        }
                    }
                     //Fin  actualizar la cantidad de producto
                }

            }
            $this->emit('sale-ok','Venta Registrada');
            //$this->emit('print-ticket',$sale->id);
            DB::commit();
           
            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            //$user = User::find(auth()->user()->id)->name;
           // $pdf = PDF::loadView('pdf.ticket', compact('sale','items','user'))->output();

        
/*
            if ($this->efectivo == 0) {
            $this->emit('refrescar','Carrito Vacio');
            return response()->streamDownload(
                fn () =>
                    print($pdf),
                        "filename.pdf"
                    ); 
           
            }*/
        } catch (Exception $e) {
            DB::rollback();
             $this->emit('sale-error',$e->getMessage());
        }


    }
}
