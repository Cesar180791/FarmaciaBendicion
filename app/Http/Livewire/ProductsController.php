<?php

namespace App\Http\Livewire; 

use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Product;
use Livewire\withPagination; //trait paginacion
use Illuminate\Support\Str;

class ProductsController extends Component
{
    use withPagination;

    public $Numero_registro, $laboratory, $chemical_component, $name, $barCode, $cost, $price, $search, $selected_id, $pageTitle, 
            $componentName , $subCategoryId, $precio_caja, $precio_mayoreo, $precio_unidad, $unidades_presentacion;
    private $pagination = 5;

      public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->subCategoryId = 'Seleccionar';
    }

     public function paginationView(){
        return 'vendor.livewire.bootstrap';
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


        return view('livewire.product.products', [
            'products'          =>  $products,
            'sub_categories'    =>  SubCategory::orderBy('name','asc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners=[
        'DeshabilitarProducto'
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

          Product::create([
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
         $this->emit('product-added','Producto registrado');
    }


    public function Edit(Product $producto){
        $this->selected_id              =   $producto->id;
        $this->name                     =   $producto->name;
        $this->chemical_component       =   $producto->chemical_component;
        $this->barCode                  =   $producto->barCode;
        $this->Numero_registro          =   $producto->Numero_registro;
        $this->laboratory               =   $producto->laboratory;
        $this->unidades_presentacion    =   $producto->unidades_presentacion;
        $this->precio_caja              =   $producto->precio_caja;
        $this->precio_mayoreo           =   $producto->precio_mayoreo;
        $this->precio_unidad            =   $producto->precio_unidad;
        $this->subCategoryId            =   $producto->sub_category_id;
        $this->emit('show-modal','Editar Producto');
    }

    public function Update(){

        $rules =[
            'name'                  =>  "required|min:3|unique:products,name,{$this->selected_id}",
            'chemical_component'    =>  'required|min:3',
            'barCode'               =>  'required',
            'Numero_registro'       =>  "required|min:3|unique:products,Numero_registro,{$this->selected_id}",
            'laboratory'            =>  'required|min:3',
            'subCategoryId'         =>  'required|not_in:Seleccionar',
            'unidades_presentacion' =>  'required'
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
            'Numero_registro.unique'        =>  'El numero de registro ingresado ya esta asociado a un medicamento registrado en el sistema',
            'laboratory.required'           =>  'El nombre del laboratorio es requerido',
            'laboratory.min'                =>  'El nombre del laboratorio debe tener al menos 3 caracteres',
            'subCategoryId.not_in'          =>  'Elige una SubCategoría diferente de "Seleccionar"',
            'unidades_presentacion'         =>  'Unidades por presentacion es requerido'
        ];

         $this->validate($rules, $messages);

         if($this->precio_unidad ===''){
            $this->precio_unidad = null; 
         }

         $updateProduct = Product::find($this->selected_id);
         $updateProduct->update([
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
         $this->emit('producto-update','Producto Actualizado Correctamente');
    }

    public function DeshabilitarProducto(Product $producto){
        $producto->update([
            'estado' => 'DESHABILITADO',
         ]);
    }

    public function Active(Product $producto){
        $producto->update([
            'estado' => 'ACTIVO',
         ]);

    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetUI(){
        $this->Numero_registro = ''; 
        $this->laboratory=''; 
        $this->chemical_component=''; 
        $this->name=''; 
        $this->barCode=''; 
        $this->search=''; 
        $this->selected_id=0;
        $this->subCategoryId=0;
        $this->precio_caja=0;
        $this->precio_mayoreo=0;
        $this->unidades_presentacion=1;
        $this->resetPage();
        $this->resetValidation();
    }
}
