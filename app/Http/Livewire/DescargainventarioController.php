<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Descarga;
use App\Models\Detalle_descargas;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class DescargainventarioController extends Component
{
    use withPagination;
    public $search, $itemsQuantity, $total, $descripcion_descarga;
    private $pagination = 5;

    public function mount(){
        //Cart::clear();
        $this->pageTitle = 'Productos';
        $this->componentName = 'Descargas de Inventario';
        $this->pageTitle2 = 'Detalle';
        $this->componentName2 = 'Descargas de Inventario';
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

        return view('livewire.descargainventario.descargainventario',[
            'products'      =>  $products,
            'cart'          =>  Cart::getContent()->sortBy('id')
        ])
        ->extends('layouts.theme.app')
        ->section('content');
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
            if ($product->existencia <1 ) {
                $this->emit('no-stock', 'Existencias Insuficientes');
                return;
            }

            Cart::add(
                $product->id,
                $product->name,
                $product->cost,
                $cant,
                array(
                    $product->cost,
                    $product->iva_cost, 
                    $product->final_cost, 
                    $product->porcentaje_ganancia,
                    $product->price, 
                    $product->iva_price,
                    $product->final_price,
                    $product->existencia
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

    public function updateCant($productId, $cant = 1){
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        
        if($exist){
            if ($product->existencia < $cant ) {
            $this->emit('no-stock', 'Existencias insuficiente');
            return;
            }
        }
        
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
                'users_id'          => auth()->user()->id,
            ]);
            if ($descarga) {
                ///se crea el registro en la tabla ventas se busca en el carrito el detalle 
                $items = Cart::getContent();
                ///se recorre el detalle para guardar en la tabla detalle de ventas 
                foreach($items as $item){
                    $detalle = Detalle_descargas::create([
                        'descargas_id'                      =>  $descarga->id,
                        'products_id'                       =>  $item->id,
                        'detalle_descargas_costo'           =>  $item->attributes[0],
                        'detalle_descargas_costo_iva'       =>  $item->attributes[1],
                        'detalle_descargas_costo_mas_iva'   =>  $item->attributes[2],
                        'detalle_descargas_precio_venta'    =>  $item->attributes[4],
                        'detalle_descargas_precio_iva'      =>  $item->attributes[5],
                        'detalle_descargas_precio_mas_iva'  =>  $item->attributes[6],
                        'detalle_descargas_quantity'        =>  $item->quantity,
                    ]);

                    $actualizarExistencia = Product::find($item->id);
                    $actualizarExistencia->existencia -= $item->quantity;
                    $actualizarExistencia->save();
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
