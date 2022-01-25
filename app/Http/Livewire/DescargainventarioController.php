<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Lotes;
use App\Models\Descarga; 
use App\Models\Detalle_descargas; 
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class DescargainventarioController extends Component
{
    use withPagination;
    public $search, $search2, $itemsQuantity, $total, $descripcion_descarga, $idBuscarProducto, $idProducto;
    private $pagination = 5, $pagination2 = 5;

    public function mount(){
        //Cart::clear();
        $this->pageTitle = 'Productos';
        $this->componentName = 'Descargas de Inventario';
        $this->pageTitle2 = 'Detalle';
        $this->componentName2 = 'Descargas de Inventario';
        $this->pageTitle4 = 'Selecciona lote para descargar producto';
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
        $this->resetPage('pages-lotes');
    }

    public function render()
    {
        //id de lote se almacena en $idBuscarProducto y cambia mediante la funcion asignarIdBusquedaProducto()
        if (strlen($this->search2) > 0)
        $lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where([
                            ['lotes.products_id',$this->idBuscarProducto],
                            ['lotes.numero_lote','like', '%' . $this->search2 . '%']
                            ])
                        ->orderBy('pro.id','desc')
                        ->paginate($this->pagination2, ['*'], 'pages-lotes');
        
        else
        $lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where('lotes.products_id',$this->idBuscarProducto)
                        ->orderBy('pro.id','desc')
                        ->paginate($this->pagination2, ['*'], 'pages-lotes');
 
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

        return view('livewire.descargainventario.descargainventario',[
            'products'      =>  $products,
            'cart'          =>  Cart::getContent()->sortBy('id'),
            'lotes'         =>  $lotes
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [ 
        'addItem',
        'removeItem'
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
            if ($this->InCart($product->id)) {
                return;
            }
            if ($buscar_lote->existencia_lote <1 ) {
                $this->emit('no-stock', 'Existencias Insuficientes');
                return;
            }

            Cart::add(
                $buscar_lote->id,
                $product->name,
                $product->final_cost,
                $cant,
                array(
                    $product->cost,
                    $product->iva_cost, 
                    $product->final_cost, 
                    $product->precio_caja,
                    $product->precio_mayoreo, 
                    $product->precio_unidad,
                    $buscar_lote->existencia_lote,
                    $buscar_lote->numero_lote,
                    $buscar_lote->caducidad_lote,
                    $product->id
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

    public function removeItem($productId){
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
       // $this->emit('add-ok','Producto eliminado');
    }

    public function updateCant($loteId, $cant = 1){
        $lote = Lotes::find($loteId);
        $exist = Cart::get($loteId);
        
        if($exist){
            if ($lote->existencia_lote < $cant ) {
            $this->emit('no-stock', 'Existencias insuficiente');
            return;
            }
        }
        
        $this->removeItem($loteId);

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
                   $exist->attributes[9],
                ));
           $this->total = Cart::getTotal();
           $this->itemsQuantity = Cart::getTotalQuantity();
           //$this->emit('add-ok', $title);
       }
    }




    public function EjecutarDescarga(){
        DB::beginTransaction();
        try {
            $rules =[
                'descripcion_descarga' =>  "required|min:3",
            ];
    
            $messages=[
                'descripcion_descarga.required' =>  'La descripción de la descarga es requerida',
                'descripcion_descarga.min' =>  'La descripción de la descarga debe tener al menos 3 caracteres',
            ];
    
             $this->validate($rules, $messages);



            $descarga = Descarga::create([
                'total_descarga'       => $this->total,
                'total_item_descarga'  => $this->itemsQuantity,
                'descripcion_descarga' => $this->descripcion_descarga,
                'users_id'             => auth()->user()->id,
            ]);
            if ($descarga) {
                ///se crea el registro en la tabla ventas se busca en el carrito el detalle 
                $items = Cart::getContent();
                ///se recorre el detalle para guardar en la tabla detalle de ventas 
                foreach($items as $item){
                    $detalle = Detalle_descargas::create([
                        'descargas_id'                          =>  $descarga->id,
                        'lotes_id'                              =>  $item->id,
                        'detalle_descargas_costo'               =>  $item->attributes[0],
                        'detalle_descargas_costo_iva'           =>  $item->attributes[1],
                        'detalle_descargas_costo_mas_iva'       =>  $item->attributes[2],
                        'detalle_descargas_precio_caja'         =>  $item->attributes[3],
                        'detalle_descargas_precio_mayoreo'      =>  $item->attributes[4],
                        'detalle_descargas_precio_unidad'       =>  $item->attributes[5],
                        'detalle_descargas_quantity'            =>  $item->quantity,
                    ]);

                    //actualizar tabla productos
                    $actualizarExistencia = Product::find($item->attributes[9]);
                    $actualizarExistencia->existencia_caja -= $item->quantity;
                    $actualizarExistencia->save();

                    //actualizar lote
                    $actualizarLote = Lotes::find($item->id); 
                    $actualizarLote->existencia_lote -= $item->quantity;
                    $actualizarLote->save();

                    if($actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === 0 || $actualizarLote->existencia_lote === 0 && $actualizarLote->existencia_lote_unidad === null){
                        $actualizarLote->estado_lote = 'DESHABILITADO';
                        $actualizarLote->save();
                    }

                }
            }
            $this->emit('carga-ok','Carga Registrada con exito');
            //$this->emit('print-ticket',$sale->id);
            DB::commit();
            Cart::clear();
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error',$e->getMessage());
        }
    }
}
