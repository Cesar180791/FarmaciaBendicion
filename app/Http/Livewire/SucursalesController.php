<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;
use Livewire\withPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\withFileUploads;

class SucursalesController extends Component
{
    use withPagination;
    use withFileUploads;

    public $search, $idBranch, $nameShop, $phoneShop, $addressShop, $image, $imagenSucursal,
            $telefonoSucursal, $codigoSucursal, $direccionSucursal, $nombreSucursal, $selected_id;
    private $pagination = 5;

    public function mount(){
        $this->ComponentName = 'Sucursales';
        $this->PageTitle='Lista';
      }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
  

    public function render()
    {
        if(strlen($this->search) > 0)
        $data = Shop::where('nameShop', 'like', '%'.$this->search.'%')
        ->orWhere('codeShop', 'like', '%'.$this->search.'%')
        ->paginate($this->pagination);
        else
        $data = Shop::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.branch.sucursales',[
            'sucursales'=>$data
        ])->extends('layouts.theme.app')
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

      public function viewSucursal(Shop $sucursal){
          $this->imagenSucursal = $sucursal->image;
          $this->telefonoSucursal = $sucursal->phoneShop;
          $this->codigoSucursal = $sucursal->codeShop;
          $this->direccionSucursal = $sucursal->addressShop;
          $this->nombreSucursal = $sucursal->nameShop;

          $this->emit('mostrar-sucursal','Mostrar sucursal!');
      }

      public function editSucursal(Shop $sucursal1){
        $this->selected_id = $sucursal1->id;
        $this->nameShop = $sucursal1->nameShop;
        $this->phoneShop = $sucursal1->phoneShop;
        $this->addressShop = $sucursal1->addressShop;

        $this->emit('edit-sucursal','editar sucursal!');
      }


      public function update(){
        $rules=[
            'nameShop'=>"required|min:3|unique:shops,nameShop,{$this->selected_id}",
            'phoneShop'=>"required|min:|unique:shops,phoneShop,{$this->selected_id}",
            'addressShop'=>'required|min:10',
        ];

        $messages =[
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

        $actualizar = Shop::find($this->selected_id);
     
         $actualizar->update([
            'nameShop' => $this->nameShop,
            'phoneShop' => $this->phoneShop,
            'addressShop' => $this->addressShop,
         ]);

         if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/sucursales/', $customFileName);
            $imageName = $actualizar->image;

            $actualizar->image = $customFileName;
            $actualizar->save();

            if ($imageName !=null) {
                if (file_exists('storage/sucursales/'.$imageName)) {
                    unlink('storage/sucursales/'. $imageName);
                }
            }
         }
         $this->resetUI();
         $this->emit('Sucursal-actualizada','Sucursal Actualizada con Exito');
   
 }

      
      
      
      
      
      public function resetUI(){
        $this->idBranch='';
        $this->nameShop='';
        $this->phoneShop='';
        $this->addressShop='';
        $this->image='';
         $this->selected_id = 0;
      }
}
