<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;

class ViewBranchController extends Component
{
    public $idBranch;

    public function mount($idBranch){
        $this->idBranch = $idBranch;
    }

    public function render()
    {
        $sucursal = Shop::where('id', $this->idBranch)->first();
        
        return view('livewire.branch.view-branch.view-branch',[
            'sucursal' => $sucursal
        ])->extends('layouts.theme.app')
        ->section('content');
    }
}
