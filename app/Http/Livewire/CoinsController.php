<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Livewire\withPagination;

class CoinsController extends Component
{
    use withPagination; 

    public $ComponentName, $PageTitle, $selected_id,$search;
    private $pagination = 5;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->componentName='Dinero';
        $this->PageTitle='Lista';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Denomination::where('value', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        else
            $data = Denomination::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.coins.coins',[
            'demonimations' => $data
        ])->extends('layouts.theme.app')
        ->section('content');
    }
}
