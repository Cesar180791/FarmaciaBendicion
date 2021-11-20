<?php

namespace App\Http\Livewire;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage; //facade para manipular imagenes en laravel
use Livewire\withFileUploads; // trait para subir imagenes
use Livewire\Component;

class CreateBranchController extends Component 
{
  use withFileUploads;
  public $idBranch, $nameShop, $phoneShop,$addressShop,$image;

    public function render()
    {
        return view('livewire.branch.create-branch.create-branch')->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
      $rules =[
         'nameShop'=>'required|min:3|unique:shops',
         'phoneShop'=>'required|min:|unique:shops',
         'addressShop'=>'required|min:10',
      ];
      $messages=[
        'nameShop.required' => 'Nombre de la Sucursal es requerido',
        'nameShop.unique' => 'Ya existe el nombre de la Sucursal',
        'nameShop.min' => 'El nombre de la Sucursal debe tener al menos 3 caracteres',
        'phoneShop.required' => 'Telefono requerido',
        'phoneShop.unique' => 'El telefono ya fue registrado con otra sucursal',
        'phoneShop.min' => 'El telefono debe tener al menos 7 caracteres',
        'addressShop.required' => 'La direcion de la sucursal es requerida',
        'addressShop.min' => 'La direccion de la sucursal debe tener al menos 10 caracteres'
      ];
      $this->validate($rules, $messages);

      $shop = Shop::create([
        'nameShop' => $this->nameShop,
        'codeShop'=>'SUC'.rand(0,9).rand(0,9).rand(0,9),
        'phoneShop' => $this->phoneShop,
        'addressShop' => $this->addressShop,
      ]);

      $customFileName;
       if($this->image){
           $customFileName = uniqid().'_.'.$this->image->extension();
           $this->image->storeAs('public/sucursales', $customFileName);
           $shop->image = $customFileName;
           $shop->save();
       }

      $this->resetUI();

      $this->emit('Sucursal-creada','Te desemos muchas Bendiciones en tu nueva Sucursal');
    }

    public function resetUI(){
      $this->idBranch='';
      $this->nameShop='';
      $this->phoneShop='';
      $this->addressShop='';
      $this->image='';
    }
}
