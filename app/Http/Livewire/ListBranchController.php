<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;
use Livewire\withPagination;

class ListBranchController extends Component
{
    use withPagination;
    public $search;
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
          $data = Shop::where('nameShop', 'like', '%'.$this->search.'%')->paginate($this->pagination);
      else
          $data = Shop::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.branch.list-branch.list-branch',[
          'sucursales'=>$data
        ])->extends('layouts.theme.app')
        ->section('content');
    }
}
