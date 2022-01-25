<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use Livewire\withPagination;

class ClientesController extends Component
{
    use withPagination; 
    public $search, $selected_id, $pageTitle, $componentName, $nombre_cliente , $telefono ,$NIT_cliente, $NRC_cliente, $gran_con_cliente;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle        =   'Listado';
        $this->componentName    =   'Clientes';
        $this->gran_con_cliente =   'Seleccionar';
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
            $data = Clientes::where('nombre_cliente', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        else
            $data = Clientes::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.clientes.clientes',[ 'Clientes' => $data])->extends('layouts.theme.app')
        ->section('content'); ;
    }

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

        $this->resetUI();
        $this->emit('cliente-added','Cliente registrado');
    }
    
    public function Edit(Clientes $cliente){ 
        $this->nombre_cliente   = $cliente->nombre_cliente;
        $this->telefono         = $cliente->telefono;
        $this->NIT_cliente      = $cliente->NIT_cliente;
        $this->NRC_cliente      = $cliente->NRC_cliente;
        $this->gran_con_cliente = $cliente->gran_con_cliente;
        $this->selected_id      = $cliente->id;

        $this->emit('show-modal', 'show modal!'); 
    }

    public function Update(){
        $rules=[
            'nombre_cliente'    =>  "required|unique:clientes,nombre_cliente,{$this->selected_id}|min:3",
            'telefono'          =>  'required|min:8',
            'NIT_cliente'       =>  "required|min:10|unique:clientes,NIT_cliente,{$this->selected_id}",
            'NRC_cliente'       =>  "required|min:10|unique:clientes,NRC_cliente,{$this->selected_id}",
            'gran_con_cliente'  =>  'required|not_in:Seleccionar'
        ];

        $messages =[
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

         $cliente = Clientes::find($this->selected_id);
         $cliente->update([
            'nombre_cliente'    =>  $this->nombre_cliente,
            'telefono'          =>  $this->telefono,
            'NIT_cliente'       =>  $this->NIT_cliente,
            'NRC_cliente'       =>  $this->NRC_cliente,
            'gran_con_cliente'  =>  $this->gran_con_cliente
         ]);

         $this->resetUI();
         $this->emit('cliente-update','Cliente Actualizado');
    }

    protected $listeners=[
        'DeshabilitarCliente'
    ];


    public function DeshabilitarCliente(Clientes $cliente){
        $cliente->update([
            'estado_cliente' => 'DESHABILITADO',
         ]);
    }

    public function Active(Clientes $cliente){ 
        $cliente->update([
            'estado_cliente' => 'ACTIVO',
         ]);

    }


    public function resetUI(){
        $this->nombre_cliente   =   ''; 
        $this->telefono         =   ''; 
        $this->NIT_cliente      =   '';
        $this->NRC_cliente      =   '';
        $this->gran_con_cliente =   'Seleccionar';
        $this->resetPage();
        $this->resetValidation();
   }
}
