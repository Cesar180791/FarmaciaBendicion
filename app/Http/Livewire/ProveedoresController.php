<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proveedores;
use Livewire\withPagination;

class ProveedoresController extends Component
{
    use withPagination; 
    public $search, $selected_id, $pageTitle, $componentName, $nombre_proveedor , $telefono ,$NIT, $NRC;
    private $pagination = 5;

      public function mount(){
        $this->pageTitle        =   'Listado';
        $this->componentName    =   'Proveedores';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch(){
        $this->resetPage();
    }



    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Proveedores::where('nombre_proveedor', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        else
            $data = Proveedores::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.proveedores.proveedores',[
            'Proveedores' => $data
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'nombre_proveedor'  =>  'required|unique:proveedores|min:3',
            'telefono'          =>  'required|min:8',
            'NIT'               =>  'required|min:10|unique:proveedores,NIT',
            'NRC'               =>  'required|min:10|unique:proveedores,NRC',
        ];

        $messages = [
            'nombre_proveedor.required' => 'Nombre de el proveedor es requerido',
            'nombre_proveedor.unique'   => 'El proveedor ya existe',
            'nombre_proveedor.min'      => 'El proveedor debe tener al menos 3 caracteres',
            'telefono.required'         => 'telefono de el proveedor es requerido',
            'telefono.min'              => 'El telefono debe tener al menos 8 caracteres',
            'NIT.required'              => 'El NIT del proveedor es requerido',
            'NIT.min'                   => 'El NIT del proveedor debe tener al menos 10 caracteres',
            'NIT.unique'                => 'El NIT ingresado ya esta asociado a otro proveedor',
            'NRC.required'              => 'El NRC del proveedor es requerido',
            'NRC.min'                   => 'El NRC del proveedor debe tener al menos 10 caracteres',
            'NRC.unique'                => 'El NRC ingresado ya esta asociado a otro proveedor',
            
        ];

        $this->validate($rules, $messages);

        $proveedor = Proveedores::create([
            'nombre_proveedor'  =>  $this->nombre_proveedor,
            'telefono'          =>  $this->telefono,
            'NIT'               =>  $this->NIT,
            'NRC'               =>  $this->NRC
        ]);

        $this->resetUI();
        $this->emit('proveedor-added','Proveedor registrado');
    }


     public function Edit(Proveedores $proveedor){ 
        $this->nombre_proveedor = $proveedor->nombre_proveedor;
        $this->telefono = $proveedor->telefono;
        $this->NIT = $proveedor->NIT;
        $this->NRC = $proveedor->NRC;
        $this->selected_id = $proveedor->id;

        $this->emit('show-modal', 'show modal!'); 
    }

       public function Update(){
        $rules=[
            'nombre_proveedor'  =>  "required|unique:proveedores,nombre_proveedor,{$this->selected_id}|min:3",
            'telefono'          =>  'required|min:8',
            'NIT'               =>  "required|min:10|unique:proveedores,NIT,{$this->selected_id}",
            'NRC'               =>  "required|min:10|unique:proveedores,NRC,{$this->selected_id}",
        ];

        $messages =[
            'nombre_proveedor.required' => 'Nombre de el proveedor es requerido',
            'nombre_proveedor.unique'   => 'El proveedor ya existe',
            'nombre_proveedor.min'      => 'El proveedor debe tener al menos 3 caracteres',
            'telefono.required'         => 'telefono de el proveedor es requerido',
            'telefono.min'              => 'El telefono debe tener al menos 8 caracteres',
            'NIT.required'              => 'El NIT del proveedor es requerido',
            'NIT.min'                   => 'El NIT del proveedor debe tener al menos 10 caracteres',
            'NIT.unique'                => 'El NIT ingresado ya esta asociado a otro proveedor',
            'NRC.required'              => 'El NRC del proveedor es requerido',
            'NRC.min'                   => 'El NRC del proveedor debe tener al menos 10 caracteres',
            'NRC.unique'                => 'El NRC ingresado ya esta asociado a otro proveedor',
        ];
         $this->validate($rules, $messages);

         $proveedor = Proveedores::find($this->selected_id);
         $proveedor->update([
            'nombre_proveedor'  =>  $this->nombre_proveedor,
            'telefono'          =>  $this->telefono,
            'NIT'               =>  $this->NIT,
            'NRC'               =>  $this->NRC,
         ]);

         $this->resetUI();
         $this->emit('proveedor-update','Categoria Actualizada');
    }

    protected $listeners=[
        'DeshabilitarProveedor'
    ];


    public function DeshabilitarProveedor(Proveedores $proveedor){
        $proveedor->update([
            'estado_proveedor' => 'DESHABILITADO',
         ]);
    }

    public function Active(Proveedores $proveedor){
        $proveedor->update([
            'estado_proveedor' => 'ACTIVO',
         ]);

    }

     /*
     public function Destroy(Proveedores $proveedor){
        $proveedor->delete();
         $this->resetUI();
         $this->emit('category-delete','Proveedor Eliminado');
    }*/

    public function resetUI(){
         $this->nombre_proveedor    =   ''; 
         $this->telefono            =   ''; 
         $this->NIT                 =   '';
         $this->NRC                 =   '';
         $this->resetPage();
         $this->resetValidation();
    }
}
