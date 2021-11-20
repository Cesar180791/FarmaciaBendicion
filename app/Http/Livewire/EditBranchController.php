<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage; //facade para manipular imagenes en laravel
use Livewire\withFileUploads; // trait para subir imagenes

class EditBranchController extends Component
{
    use withFileUploads;
    public $idBranch, $nameShop, $phoneShop,$addressShop,$image,$sucursal, $nameNew, $phoneNew, $addressNew;

    public function mount($idBranch){
        $this->idBranch = $idBranch;
    } 

    public function render() 
    {
        $this->sucursal = Shop::where('id', $this->idBranch)->first();

        $this->nameShop = $this->sucursal->nameShop;
        $this->phoneShop = $this->sucursal->phoneShop;
        $this->addressShop = $this->sucursal->addressShop;        
        return view('livewire.branch.edit-branch.edit-branch')->extends('layouts.theme.app')
        ->section('content');
    }


        public function update(){
            if ($this->nameNew !='' && $this->phoneNew !=''&& $this->addressNew !='') {
        $rules=[
            'nameShop'=>"required|min:3|unique:shops,nameShop,{$this->idBranch}",
            'phoneShop'=>"required|min:|unique:shops,phoneShop,{$this->idBranch}",
            'addressShop'=>'required|min:10',
        ];

        $messages =[
            'name.required' => 'Nombre de la categoría es requerido',
            'name.min'=> 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name.unique'=> 'Ya existe el nombre de la categoría',
            'description.required' => 'La descripción de la categoria es requerida',
            'description.min' => 'La descripción de la categoría debe tener al menos 10 caracteres'
        ];
         $this->validate($rules, $messages);


         $this->sucursal->update([
            'nameShop' => $this->nameNew,
            'phoneShop' => $this->phoneNew,
            'addressShop' => $this->addressNew,
         ]);

         if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/sucursales/', $customFileName);
            $imageName = $this->sucursal->image;

            $this->sucursal->image = $customFileName;
            $this->sucursal->save();

            if ($imageName !=null) {
                if (file_exists('storage/sucursales/'.$imageName)) {
                    unlink('storage/sucursales/'. $imageName);
                }
            }
         }
         $this->emit('Sucursal-actualizada','Sucursal Actualizada con Exito');
     }
     else{
        $this->emit('No-Selected','Complemente los datos requeridos');
     }
 }
}
