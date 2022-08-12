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
use App\Models\kardexProductos;
use App\Models\User;
use Livewire\withPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart; 
use Carbon\Carbon;
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
    $unidades_presentacion,$selected_id, $dateFrom, $dateTo, $userId, $detalle_compra,
    $totalQuantityDetalles, $totalCostoDetalles, $totalDetalle;


    private $pagination = 5, $paginate2 = 5, $pagination3 = 10;

    public function mount(){
        Cart::clear();
        $this->subCategoryId = 'Seleccionar';
        $this->proveedores_id = "Seleccionar";
        $this->politicas_garantias_id = 2;
        $this->pageTitle = 'Datos Generales';
        $this->pageTitle2 = 'Detalle de compra';
        $this->pageTitle3 = 'Selecciona el producto';
        $this->pageTitle4 = 'Selecciona el lote a cargar la compra';
        $this->componentName = 'Compras';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->userId=0;
        $this->detalle_compra = [];
        $this->totalQuantityDetalles = 0;
        $this->totalCostoDetalles = 0;
        $this->totalDetalle = 0;
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

    public function updatingSearch3()
    {
        $this->resetPage('compras-page');
    }

    public function render()
    {
        //Inicio armar fecha para filtrar las Compras
        if($this->dateFrom == null && $this->dateTo == null || $this->dateFrom == '' && $this->dateTo == ''){
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
       }else{
           $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
           $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
       }
       //Fin armar fecha para filtrar las Compras

        //Inicio Seteando Variables de Interes
        if ($this->cost == null) {
            $this->cost = 0;
            $this->iva_cost = 0;
            $this->final_cost = 0;
        }
        if ($this->cost > 0){
            $this->iva_cost = $this->cost * 0.13;
            $this->final_cost = $this->cost + $this->iva_cost;
        }

        if ($this->precio_caja == null) {
            $this->precio_caja=0;
        }
        if ($this->precio_mayoreo == null) {
            $this->precio_mayoreo=0;
        }

        if ($this->unidades_presentacion == null || $this->unidades_presentacion == 0) {
            $this->unidades_presentacion=1;
        }
        //Fin Seteando Variables de Interes

        //Guardando valores de referencia comentarear luego de usar
        /*$updateCompras = PurchaseDetail::orderBy('id','asc')->get();
        foreach($updateCompras as $compra){
            $searchValoresActuales = Lotes::join('products as p','p.id','lotes.products_id')
            ->where('lotes.id', $compra->lotes_id)
            ->select('lotes.id as lotes_id','lotes.numero_lote','p.id as product_id','p.name', 'p.cost','p.iva_cost','p.final_cost','p.precio_caja','p.precio_mayoreo','p.precio_unidad')
            ->first();

          //dd($searchValoresActuales->name);
           // $update = PurchaseDetail::find($compra->id);
            //dd($update);
            $compra->update([
                'costo_ref' => $searchValoresActuales->cost,
                'costo_iva_ref' => $searchValoresActuales->iva_cost,
                'costo_mas_iva_ref' => $searchValoresActuales->final_cost,
                'precio_venta_ref' => $searchValoresActuales->precio_caja,
                'precio_venta_mayoreo_ref' => $searchValoresActuales->precio_mayoreo,
                'precio_venta_unidad_ref' => $searchValoresActuales->precio_unidad,
            ]);
        }
        //Guardando valores de referencia comentarear luego de usar*/

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
                        ->orderBy('products.name','asc')
                        ->paginate($this->pagination);
        else
        $products = Product::join('sub_categories as c','c.id','products.sub_category_id')
                        ->select('products.*','c.name as sub_category')
                        ->orderBy('products.name','asc')
                        ->paginate($this->pagination);
        
        if ($this->userId == 0) {
            $data = Purchase::join('proveedores as p','p.id','purchases.proveedores_id')
            ->join('users as u', 'u.id', 'purchases.users_id')
            ->select('purchases.id as compra_id','purchases.created_at','purchases.total','purchases.item','purchases.factura','p.nombre_proveedor','u.name as usuario')
            ->whereBetween('purchases.created_at',[$from,$to])
            ->orderBy('purchases.created_at','desc')->paginate($this->pagination3, ['*'], 'compras-page');
        } else {
            $data = Purchase::join('proveedores as p','p.id','purchases.proveedores_id')
            ->join('users as u', 'u.id', 'purchases.users_id')
            ->select('purchases.id as compra_id','purchases.created_at','purchases.total','purchases.item','purchases.factura','p.nombre_proveedor','u.name as usuario','u.id')
            ->whereBetween('purchases.created_at',[$from,$to])
            ->where('u.id', $this->userId)
            ->orderBy('purchases.created_at','desc')->paginate($this->pagination3, ['*'], 'compras-page');
        }

        return view('livewire.compras.compras',[
            'data'              =>  $data,
            'products'          =>  $products,
            'lotes'             =>  $lotes,
            'sub_categories'    =>  SubCategory::orderBy('name','asc')->get(),
            'cart'              =>  Cart::getContent()->sortBy('id'),
            'proveedores'       =>  Proveedores::orderBy('nombre_proveedor', 'asc')->where('estado_proveedor', 'ACTIVO')->get(),
            'politicas'         =>  PoliticasGarantias::orderBy('id', 'asc')->get(),
            'users'             =>  User::orderBy('name','asc')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [ 
        'removeItem',
        'lote-registrado' => '$refresh',
        'deleteCompra'
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
            'cost'                  =>  $this->cost,
            'iva_cost'              =>  $this->iva_cost,
            'final_cost'            =>  $this->final_cost,
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
            'numero_lote'       =>  'required|min:3',
            'caducidad_lote'    =>  'required|date'
        ];

        $messages = [
            'numero_lote.required'      =>  'Numero de lote requerido',
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
            'numero_lote'       =>  "required|min:3",
            'caducidad_lote'    =>  'required|date'
        ];

        $messages = [
            'numero_lote.required'      =>  'Numero de lote requerido',
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

        $politica = PoliticasGarantias::where('id', $this->politicas_garantias_id)->first();
        if($politica == false){
            return $this->emit('politica-garantia','Politica de garantia por defecto no encontrada, por favor registre una politica de garantia');
        }


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
                $product->cost, 
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
                    $politica->meses,
                    $politica->id,
                    "NUEVO",
                    $product->cost,             //Para guardar valores de referencia
                    $product->iva_cost,         //Para guardar valores de referencia
                    $product->final_cost,       //Para guardar valores de referencia
                    $product->precio_caja,      //Para guardar valores de referencia
                    $product->precio_mayoreo,  //Para guardar valores de referencia
                    $product->precio_unidad,    //Para guardar valores de referencia
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

    public function updatePolitica($productId, $politicaId){
        $politica = PoliticasGarantias::where('meses', $politicaId)->first();
        if($politica){
            $exist = Cart::get($productId);
            Cart::update($exist->id, array( 
                array(
                    $exist->attributes[9] = $politica->meses,
                    $exist->attributes[10] = $politica->id,
                )));
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
           
        }else{
            return $this->emit('politica-garantia','Politica de garantia no encontrada, por favor consulte la tabla de referencia de politicas de garantia');
        }

    }

    public function updateCost($productId, $cost){
        $exist = Cart::get($productId);

        if($cost > 0) {
            $iva_cost = $cost * 0.13;
            $final_cost = $cost + $iva_cost;

        Cart::update($exist->id, array( 
            array(
                $exist->price = $cost,
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
                   $exist->attributes[9],
                   $exist->attributes[10],
                   $exist->attributes[11],
                   $exist->attributes[12],
                   $exist->attributes[13],
                   $exist->attributes[14],
                   $exist->attributes[15],
                   $exist->attributes[16],
                   $exist->attributes[17]
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
                    $exist->attributes[8],
                    $exist->attributes[9],
                    $exist->attributes[10],
                    $exist->attributes[11],
                    $exist->attributes[12],
                    $exist->attributes[13],
                    $exist->attributes[14],
                    $exist->attributes[15],
                    $exist->attributes[16],
                    $exist->attributes[17]
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
                    $exist->attributes[8],
                    $exist->attributes[9],
                    $exist->attributes[10],
                    $exist->attributes[11],
                    $exist->attributes[12],
                    $exist->attributes[13],
                    $exist->attributes[14],
                    $exist->attributes[15],
                    $exist->attributes[16],
                    $exist->attributes[17]
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
                    $exist->attributes[8],
                    $exist->attributes[9],
                    $exist->attributes[10],
                    $exist->attributes[11],
                    $exist->attributes[12],
                    $exist->attributes[13],
                    $exist->attributes[14],
                    $exist->attributes[15],
                    $exist->attributes[16],
                    $exist->attributes[17]
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
            //'descripcion_lote'          =>  'required|min:5',
            //'politicas_garantias_id'    =>  'required|not_in:Seleccionar',
            'factura'                   =>  'required|min:3',
            'fecha_compra'              =>  'required',
            'proveedores_id'            =>  'required|not_in:Seleccionar'
        ];

        $messages=[
            //'descripcion_lote.required'         =>  'La descripcion de la compra es requerida',
            //'descripcion_lote.min'              =>  'La descripcion de la compra debe tener al menos 5 caracteres',
            //'politicas_garantias_id.not_in'     =>  'Politica de garantia sobre compra requerida',
            'factura.required'                  =>  'El numero de factura es requerido',
            'factura.min'                       =>  'El numero de factura debe tener al menos 3 caracteres',
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
                //'politicas_garantias_id'    =>  $this->politicas_garantias_id,
                'users_id'                  =>  auth()->user()->id,
                'proveedores_id'            =>  $this->proveedores_id
            ]);
            if ($compra) {
                ///se crea el registro en la tabla purchases se busca en el carrito el detalle 
                $items = Cart::getContent();
                ///se recorre el detalle para guardar en la tabla purchase_detail
                foreach($items as $item){

                    $kardex = kardexProductos::where('products_id', $item->attributes[8])->get();
                    $actualizarExistencia = Product::find($item->attributes[8]);

                    if($actualizarExistencia->unidades_presentacion == 1){
                        $costo_unitario = 0; 
                    }else{
                        $costo_unitario = $actualizarExistencia->cost / $actualizarExistencia->unidades_presentacion;
                    }

                    if (count($kardex) == 0) {
                        kardexProductos::create([
                            'products_id' => $item->attributes[8],
                            'concepto' => "Inicio de KARDEX",
                            'cantidad_existencias_ppal' => $actualizarExistencia->existencia_caja,
                            'cantidad_existencias_unitarias' => $actualizarExistencia->existencia_unidad,
                            'costo_unit_existencias_ppal' => $actualizarExistencia->cost,
                            'costo_unit_existencias_unitarias' => $costo_unitario,
                            'costo_total_existencias' => ($actualizarExistencia->cost * $actualizarExistencia->existencia_caja) + (($actualizarExistencia->cost / $actualizarExistencia->unidades_presentacion) * $actualizarExistencia->existencia_unidad),
                            'id_transaccion' => 0,
                            'tipo_movimiento' => 'Inicio'
                        ]);
                    }

                    $detalle = PurchaseDetail::create([
                        'purchases_id'              =>  $compra->id,
                        'lotes_id'                  =>  $item->id,
                        'costo'                     =>  $item->attributes[0],
                        'costo_iva'                 =>  $item->attributes[1],
                        'costo_mas_iva'             =>  $item->attributes[2],
                        'precio_venta'              =>  $item->attributes[3],
                        'precio_venta_mayoreo'      =>  $item->attributes[4],
                        'precio_venta_unidad'       =>  $item->attributes[5],
                        'quantity'                  =>  $item->quantity,
                        'politicas_garantias_id'    =>  $item->attributes[10],
                        'costo_ref'                 =>  $item->attributes[12],
                        'costo_iva_ref'             =>  $item->attributes[13],
                        'costo_mas_iva_ref'         =>  $item->attributes[14],
                        'precio_venta_ref'          =>  $item->attributes[15],
                        'precio_venta_mayoreo_ref'  =>  $item->attributes[16],
                        'precio_venta_unidad_ref'   =>  $item->attributes[17],
                    ]);

                    ///ACTUALIZAR TABLA PRODUCTO
                    ///A PETICION DEL CLIENTE SI EL PRODUCTO TIENE MAS DE 60 DIAS ENTRE LA ULTIMA ACTUALIZACION
                    //Y EL REGISTRO DE CARGA RECIEN CREADO Y SU EXISTENCIA ES CERO LOS COSTOS SE SOBREESCRIBIRAN Y NO SE APLICARA
                    //COSTO PROMEDIO.
                    //PARA ESTO SE BUSCA EL REGISTRO A MODIFICAR POR LA CARGA
                    //$actualizarExistencia = Product::find($item->attributes[8]);

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

                    if($actualizarExistencia->unidades_presentacion == 1){
                        $costo_unitario = 0;
                    }else{
                        $costo_unitario = $actualizarExistencia->cost / $actualizarExistencia->unidades_presentacion;
                    }

                    kardexProductos::create([
                        'products_id' => $item->attributes[8],
                        'concepto' => "Compra factura N°: " . $compra->factura . ' ID: ' . $compra->id,
                        'cantidad_entrada' => $item->quantity,
                        'costo_unit_entrada' => $item->attributes[0],
                        'costo_total_entrada' => $item->attributes[0] * $item->quantity,
                        'cantidad_existencias_ppal' => $actualizarExistencia->existencia_caja,
                        'cantidad_existencias_unitarias' => $actualizarExistencia->existencia_unidad,
                        'costo_unit_existencias_ppal' => $actualizarExistencia->cost,
                        'costo_unit_existencias_unitarias' => $costo_unitario,
                        'costo_total_existencias' => ($actualizarExistencia->cost * $actualizarExistencia->existencia_caja) + (($actualizarExistencia->cost / $actualizarExistencia->unidades_presentacion) * $actualizarExistencia->existencia_unidad),
                        'id_transaccion' => $compra->id,
                        'tipo_movimiento' => 'Compra',
                        'purchase_details_id' => $detalle->id
                    ]);
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

    public function deleteCompra($compra_id){
        //compra
        $compra = Purchase::find($compra_id);
        //detalle de compra
        $detalles = PurchaseDetail::where('purchases_id', $compra->id)->get();


        //comprobando la existencia del lote
        foreach($detalles as $detalle){
            $comprobarExistencia = Lotes::find($detalle->lotes_id);
            
            //si la existencia del lote es mayor a la compra hara un return deteniendo el proceso
            if($detalle->quantity > $comprobarExistencia->existencia_lote){
                return $this->emit("lote-error","La existencia actual del lote es menor a la compra registrada");
            }

        }

        //actualizando existencias
        foreach($detalles as $detalle){

            //BUSCANDO LOTE PARA ACTUALIZAR
            $actualizandoExistenciaLotes = Lotes::find($detalle->lotes_id);

            //BUSCANDO PRODUCTO PARA ACTUALIZAR
            $actualizandoExistenciaProductos = Product::find($actualizandoExistenciaLotes->products_id);

             //SE ACTUALIZA LA EXISTENCIA DEL LOTE
             $actualizandoExistenciaLotes -> update([
                'existencia_lote' => $actualizandoExistenciaLotes->existencia_lote - $detalle->quantity 
             ]);
 
             //SE ACTUALIZA LA EXISTENCIA DE EL PRODUCTO EN LA TABLA PRODUCTO
             $actualizandoExistenciaProductos -> update([
                'cost'              =>  $detalle->costo_ref,     
                'iva_cost'          =>  $detalle->costo_iva_ref,
                'final_cost'        =>  $detalle->costo_mas_iva_ref,
                'precio_caja'       =>  $detalle->precio_venta_ref,
                'precio_mayoreo'    =>  $detalle->precio_venta_mayoreo_ref,
                'precio_unidad'     =>  $detalle->precio_venta_unidad_ref,
                'existencia_caja'   =>  $actualizandoExistenciaProductos->existencia_caja - $detalle->quantity
            ]);

            //SE BUSCA EL REGISTRO EN EL KARDEX
            $kardex = kardexProductos::where('purchase_details_id',$detalle->id)->first();

            //BISCANDO PRODUCTOS EN EL KARDEX QUE CON FILTRO QUE SEAN PORSTERIORES AL MOVIMIENTO DE LA COMPRA
            $movimientosKardex = kardexProductos::where([
                ['products_id', $actualizandoExistenciaProductos->id],
                ['created_at','>',$kardex->created_at]
            ])->get();

            //SOBRRESCRIBIR KARDEX
            foreach($movimientosKardex as $updateKardex){
                $updateKardex -> update([
                    'cantidad_existencias_ppal' => $updateKardex->cantidad_existencias_ppal - $detalle->quantity,
                    'costo_total_existencias' => ($actualizandoExistenciaProductos->cost * $actualizandoExistenciaProductos->existencia_caja) + (($actualizandoExistenciaProductos->cost / $actualizandoExistenciaProductos->unidades_presentacion) * $actualizandoExistenciaProductos->existencia_unidad),
                ]);
            }

            //SE BORRA EL REGISTRO DEL KARDEX
            $kardex->delete();

        }

        $detalles->each->delete();
        $compra->delete();
    }

    public function getDetails($compra_id){
        $this->detalle_compra = PurchaseDetail::join('politicas_garantias as pg','pg.id','purchase_details.politicas_garantias_id')
        ->join('lotes as l','l.id','purchase_details.lotes_id')
        ->join('products as p','p.id','l.products_id')
        ->where('purchase_details.purchases_id', $compra_id)
        ->select('purchase_details.id as id_detalle','purchase_details.quantity','purchase_details.costo',
        'purchase_details.costo_iva','purchase_details.costo_mas_iva','purchase_details.precio_venta',
        'purchase_details.precio_venta_mayoreo','purchase_details.precio_venta_unidad','pg.meses as garantia_meses',
        'l.numero_lote','l.caducidad_lote','p.name as producto')
        ->get();

        $this->totalQuantityDetalles = $this->detalle_compra->sum('quantity');
        $this->totalCostoDetalles = $this->detalle_compra->sum('costo');

        $totalCosto = $this->detalle_compra->sum(function($item){
            return $item->quantity * $item->costo;
        });

        $this->totalDetalle = $totalCosto; 

        $this->emit('show-modal');


        //dd($this->detalle_compra);
    }

    public function resetUI(){
        $this->descripcion_lote = '';
        $this->factura = '';
        //$this->politicas_garantias_id = 'Seleccionar';
        $this->fecha_compra = '';
        $this->proveedores_id = 'Seleccionar';
        $this->search = '';
        $this->descripcion_lote = ''; 
        $this->numero_lote = ''; 
        $this->caducidad_lote = '';   
        $this->loteId = '';


        $this->Numero_registro = ''; 
        $this->laboratory=''; 
        $this->cost = 0;
        $this->chemical_component=''; 
        $this->name=''; 
        $this->barCode=''; 
        $this->selected_id=0;
        $this->subCategoryId = 'Seleccionar';
        $this->precio_caja=0;
        $this->precio_mayoreo=0;
        $this->precio_unidad = null;
        $this->unidades_presentacion=1;
        $this->resetPage();
        $this->resetValidation();
    }

}
