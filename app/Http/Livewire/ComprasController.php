<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Proveedores;
use App\Models\PurchaseDetail;
use App\Models\PoliticasGarantias;
use App\Models\SubCategory;
use App\Models\Lotes;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use DB;

class ComprasController extends Component
{
    use withPagination;

    public $proveedores_id, $search, $search2, $fecha_compra, $factura, 
    $descripcion_lote, $total, $itemsQuantity, $pageTitle2, $pageTitle3, 
    $idBuscarProducto, $idProducto,$producto,$loteId, $numero_lote, 
    $caducidad_lote, $politicas_garantias_id, $existencia_lote_unidad,
    $Numero_registro, $laboratory, $chemical_component, $name, $barCode,
    $cost, $price, $subCategoryId, $precio_caja, $precio_mayoreo, $precio_unidad, 
    $unidades_presentacion,$selected_id;


    private $pagination = 5, $paginate2 = 5;

    public function mount(){
        $this->subCategoryId = 'Seleccionar';
        $this->proveedores_id = "Seleccionar";
        $this->politicas_garantias_id = "Seleccionar";
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

    public function updatingSearch2()
    {
        $this->resetPage('lotes-page');
    }

    public function render()
    {
        if ($this->precio_caja == null) {
            $this->precio_caja=0;
        }
        if ($this->precio_mayoreo == null) {
            $this->precio_mayoreo=0;
        }

        if ($this->unidades_presentacion == null || $this->unidades_presentacion == 0) {
            $this->unidades_presentacion=1;
        }


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
                        ->paginate($this->paginate2, ['*'],' lotes-page');
        
        else
        $lotes = Lotes::join('products as pro','pro.id','lotes.products_id')
                        ->join('users as u','u.id','lotes.users_id')
                        ->select('pro.*','pro.name as nombreProducto','pro.id as idProducto','u.name','lotes.*')
                        ->where('lotes.products_id',$this->idBuscarProducto)
                        ->orderBy('pro.id','desc')
                        ->paginate($this->paginate2, ['*'], 'lotes-page');

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
            'lotes'         =>  $lotes,
            'sub_categories'    =>  SubCategory::orderBy('name','asc')->get(),
            'cart'          =>  Cart::getContent()->sortBy('id'),
            'proveedores'   =>  Proveedores::orderBy('nombre_proveedor', 'asc')->where('estado_proveedor', 'ACTIVO')->get(),
            'politicas'     =>  PoliticasGarantias::orderBy('id', 'asc')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [ 
        'removeItem',
        'lote-registrado' => '$refresh'
    ];

    public function Store(){

        $rules =[
            'name'                      =>  'required|min:3|unique:products,name',
            'chemical_component'        =>  'required|min:3',
            'barCode'                   =>  'required',
            'Numero_registro'           =>  'required|min:3',
            'laboratory'                =>  'required|min:3',
            'subCategoryId'             =>  'required|not_in:Seleccionar',
            'unidades_presentacion'     =>  'required'
        ];

        $messages=[
            'name.required'                 =>  'Nombre del producto es Requerido',
            'name.min'                      =>  'El nombre del producto debe tener al menos 3 caracteres',
            'name.unique'                   =>  'El nombre del producto ya existe en el sistema',
            'chemical_component.required'   =>  'El componente quimico es requerido',
            'chemical_component.min'        =>  'El componente quimico debe tener al menos 3 caracteres',
            'barCode.required'              =>  'Código de barra es Requerido',
            'Numero_registro.required'      =>  'El numero de registro del medicamento es requerido',
            'Numero_registro.min'           =>  'El numero de registro debe tener al menos 3 caracteres',
            'laboratory.required'           =>  'El nombre del laboratorio es requerido',
            'laboratory.min'                =>  'El nombre del laboratorio debe tener al menos 3 caracteres',
            'subCategoryId.not_in'          =>  'Elige una SubCategoría diferente de "Seleccionar"',
            'unidades_presentacion'         =>  'Unidades por presentacion es requerido'
        ];

         $this->validate($rules, $messages);

          $producto = Product::create([
            'name'                  =>  $this->name,
            'chemical_component'    =>  $this->chemical_component,
            'barCode'               =>  $this->barCode,
            'Numero_registro'       =>  $this->Numero_registro,
            'laboratory'            =>  $this->laboratory,
            'unidades_presentacion' =>  $this->unidades_presentacion,
            'precio_caja'           =>  $this->precio_caja,
            'precio_mayoreo'        =>  $this->precio_mayoreo,
            'precio_unidad'         =>  $this->precio_unidad,
            'sub_category_id'       =>  $this->subCategoryId
         ]);

         $this->resetUI();
         $this->asignarIdBusquedaProducto($producto->id);
         $this->emit('ver-lotes','Producto registrado');
    }

    public function asignarIdBusquedaProducto($idProduct){
        $this->idBuscarProducto = $idProduct;
        $this->emit('ver-lotes','Ver lotes del producto seleccionado');
    }


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
            'products_id'               =>  $this->idProducto,
            'users_id'                  =>  auth()->user()->id,
            'numero_lote'               =>  $this->numero_lote,
            'existencia_lote_unidad'    =>  $this->existencia_lote_unidad,
            'caducidad_lote'            =>  $this->caducidad_lote
        ]);

        $this->emit('lote-registrado','lote registrado con exito');
        $this->resetUI();
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
                    $product->cost,
                    $product->iva_cost, 
                    $product->final_cost, 
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
            if ($item->attributes[0] == 0 || $item->attributes[3] == 0 || $item->attributes[4] == 0) {
                return $this->emit('empty-cost','Producto: '.$item->name. ' lote: '. $item->attributes[6].' Revisa los siguientes valores introducidos: costo, porcentaje de ganancia o numero de lote ya que pueden estar en cero o vacios');
            }
        }
        $this->emit('validacion-detalle-ok', 'Validacion de detalle completa y con exito');
    }

    public function validacionCabecera(){
        $rules =[
            'descripcion_lote'          =>  'required|min:5',
            'politicas_garantias_id'    =>  'required|not_in:Seleccionar',
            'factura'                   =>  'required|min:3|unique:purchases,factura',
            'fecha_compra'              =>  'required',
            'proveedores_id'            =>  'required|not_in:Seleccionar'
        ];

        $messages=[
            'descripcion_lote.required'         =>  'La descripcion de la compra es requerida',
            'descripcion_lote.min'              =>  'La descripcion de la compra debe tener al menos 5 caracteres',
            'politicas_garantias_id.not_in'     =>  'Politica de garantia sobre compra requerida',
            'factura.required'                  =>  'El numero de factura es requerido',
            'factura.min'                       =>  'El numero de factura debe tener al menos 3 caracteres',
            'factura.unique'                    =>  'El numero de factura ya esta asociado a otra compra',
            'fecha_compra.required'             =>  'La fecha de compra es requerida',
            'proveedores_id.not_in'             =>  'Seleccione el Proveedor',
        ];
         $this->validate($rules, $messages);
         $this->GuardarCompra();
    }

    public function GuardarCompra(){
        try {
            $compra = Purchase::create([
                'fecha_compra'              =>  $this->fecha_compra,
                'total'                     =>  $this->total,
                'item'                      =>  $this->itemsQuantity,
                'descripcion_lote'          =>  $this->descripcion_lote,
                'factura'                   =>  $this->factura,
                'politicas_garantias_id'    =>  $this->politicas_garantias_id,
                'users_id'                  =>  auth()->user()->id,
                'proveedores_id'            =>  $this->proveedores_id
            ]);
            if ($compra) {
                ///se crea el registro en la tabla purchases se busca en el carrito el detalle 
                $items = Cart::getContent();
                ///se recorre el detalle para guardar en la tabla purchase_details
                foreach($items as $item){
                    $detalle = PurchaseDetail::create([
                        'purchases_id'          =>  $compra->id,
                        'lotes_id'              =>  $item->id,
                        'costo'                 =>  $item->attributes[0],
                        'costo_iva'             =>  $item->attributes[1],
                        'costo_mas_iva'         =>  $item->attributes[2],
                        'precio_venta'          =>  $item->attributes[3],
                        'precio_venta_mayoreo'  =>  $item->attributes[4],
                        'precio_venta_unidad'   =>  $item->attributes[5],
                        'quantity'              =>  $item->quantity,
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
                        $actualizarlote->estado_lote = 'ACTIVO';
                        $actualizarlote->save();
                        
                    } else{
                        $actualizarlote->existencia_lote = $item->quantity;
                        $actualizarlote->estado_lote = 'ACTIVO';
                        $actualizarlote->save();    
                    }
                }
            }
            $this->emit('compra-ok','Compra Registrada con exito');
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
        $this->descripcion_lote = '';
        $this->factura = '';
        $this->politicas_garantias_id = 'Seleccionar';
        $this->fecha_compra = '';
        $this->proveedores_id = 'Seleccionar';
        $this->search = '';
        $this->descripcion_lote = ''; 
        $this->numero_lote = ''; 
        $this->caducidad_lote = '';   
        $this->loteId = '';


        $this->Numero_registro = ''; 
        $this->laboratory=''; 
        $this->chemical_component=''; 
        $this->name=''; 
        $this->barCode=''; 
        $this->selected_id=0;
        $this->subCategoryId=0;
        $this->precio_caja=0;
        $this->precio_mayoreo=0;
        $this->unidades_presentacion=1;
        $this->resetPage();
        $this->resetValidation();
    }

}
