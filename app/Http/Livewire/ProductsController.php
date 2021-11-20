<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Presentation;
use App\Models\Product;
use Livewire\withPagination; //trait paginacion

class ProductsController extends Component
{
    use withPagination;

    public $name,$barCode,$cost,$price,$search,$selected_id,$pageTitle,$componentName,$subCategoryId,$presentationId;
    private $pagination = 5;

      public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->subCategoryId = 'Seleccionar';
        $this->presentationId = 'Seleccionar';
    }

     public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $products = Product::join('sub_categories as c','c.id','products.sub_category_id')->join('presentations as b','b.id','products.presentation_id')
                            ->select('products.*','c.name as sub_category','b.name as presentation')
                            ->where('products.name','like', '%' . $this->search . '%')
                            ->orWhere('c.name','like', '%' . $this->search . '%')
                            ->orWhere('b.name','like', '%' . $this->search . '%')
                            ->orderBy('products.id','desc')
                            ->paginate($this->pagination);
        else
             $products = Product::join('sub_categories as c','c.id','products.sub_category_id')->join('presentations as b','b.id','products.presentation_id')
                            ->select('products.*','c.name as sub_category','b.name as presentation')
                            ->orderBy('products.id','desc')
                            ->paginate($this->pagination);



        return view('livewire.product.products',[
            'products'=>$products,
            'sub_categories'=>SubCategory::orderBy('name','asc')->get(),
            'presentations'=>Presentation::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


     public function Store(){
        $rules =[
            'name'=>'required|min:3',
            'barCode'=>'|required',
            'cost'=>'|required',
            'price'=>'|required',
            'presentationId'=>'required|not_in:Seleccionar',
            'subCategoryId'=>'required|not_in:Seleccionar'
        ];

        $messages=[
            'name.required'=>'Nombre del producto es Requerido',
            'name.min'=>'El nombre del producto debe tener al menos 3 caracteres',
            'barCode.required'=>'Código de barra es Requerido',
            'cost.required'=>'Costo es Requerido',
            'price.required'=>'Precio es Requerido',
            'presentationId.not_in'=>'Elige una presentación diferente de "Seleccionar"',
            'subCategoryId.not_in'=>'Elige una SubCategoría diferente de "Seleccionar"'
        ];
         $this->validate($rules, $messages);

         $product = Product::create([
            'name' => $this->name,
            'barCode' => $this->barCode,
            'cost' => $this->cost,
            'price' => $this->price,
            'presentation_id' => $this->presentationId,
            'sub_category_id' => $this->subCategoryId
         ]);

         $this->resetUI();
         $this->emit('product-added','Producto registrado');
    }


    public function resetUI(){

    }

}
