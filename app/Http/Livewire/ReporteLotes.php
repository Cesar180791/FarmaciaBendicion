<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lotes;
use Livewire\withPagination;
use Carbon\Carbon;

class ReporteLotes extends Component 
{
    use withPagination; 

    public $componentName, $search, $dateFrom, $dateTo;
    private $pagination = 10;
    
    
    public function mount(){
        $this->componentName    =   'Reporte de Lotes según fecha de vencimiento';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        
        

        if(strlen($this->search) > 0){
            $this->dateFrom ='';
            $this->dateTo = '';
            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.numero_lote','lotes.caducidad_lote','lotes.existencia_lote','lotes.existencia_lote_unidad','p.name','p.chemical_component','p.barCode','p.Numero_registro','p.laboratory')
            ->where([
                ['p.name','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['p.chemical_component','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['p.barCode','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['p.Numero_registro','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['p.laboratory','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['lotes.numero_lote','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orWhere([
                ['lotes.caducidad_lote','like','%'. $this->search . '%'],
                ['lotes.estado_lote','ACTIVO']
            ])
            ->orderBy('lotes.caducidad_lote','asc')
            ->paginate($this->pagination);
        }else{
            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.numero_lote','lotes.caducidad_lote','lotes.existencia_lote','lotes.existencia_lote_unidad','p.name')
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')
            ->paginate($this->pagination);
        }

        if($this->dateFrom != null && $this->dateTo != null){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d');
            $to = Carbon::parse($this->dateTo)->format('Y-m-d');

            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.numero_lote','lotes.caducidad_lote','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.created_at','p.name')
            ->whereBetween('lotes.caducidad_lote',[$from,$to])
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')
            ->paginate($this->pagination);

            $this->resetPage();
        }
        return view('livewire.reporteLotes.reporteLotes',[
            'data' => $data,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetFiltros(){
        $this->resetPage();
        $this->dateFrom ='';
        $this->dateTo = '';
        $this->search = '';

    }
}
