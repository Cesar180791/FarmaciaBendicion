<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lotes;
use App\Models\Product;
use Livewire\withPagination;
use Carbon\Carbon;

class ReporteLotes extends Component 
{
    use withPagination; 

    public $componentName, $search, $dateFrom, $dateTo, $costoTotal,$totalIva,$totalCostoIVA;
    private $pagination = 8;
    
    
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
            ->select('lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','p.precio_caja','p.precio_mayoreo','p.precio_unidad','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
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
            ->select('lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','p.precio_caja','p.precio_mayoreo','p.precio_unidad','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')
            ->paginate($this->pagination);
        }

        if($this->dateFrom != null && $this->dateTo != null){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d');
            $to = Carbon::parse($this->dateTo)->format('Y-m-d');

            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','p.precio_caja','p.precio_mayoreo','p.precio_unidad','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
            ->whereBetween('lotes.caducidad_lote',[$from,$to])
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')
            ->paginate($this->pagination);

            $this->resetPage();
        }

        $data2 = Product::all();

        /*$this->costoTotal = $data2->sum('cost') * $data2->sum('existencia_caja');
        $this->totalIva = $data2->sum('iva_cost') * $data2->sum('existencia_caja');
        $this->totalCostoIVA = $data2->sum('final_cost') * $data2->sum('existencia_caja');*/
        $costo = $data2->sum(function($item){
            return $item->cost * $item->existencia_caja;
        });

        $iva = $data2->sum(function($item2){
            return $item2->iva_cost * $item2->existencia_caja;
        });

        $totalCostoInventario = $data2->sum(function($item3){
            return $item3->final_cost * $item3->existencia_caja;
        });

        $this->costoTotal = $costo;
        $this->totalIva = $iva;
        $this->totalCostoIVA = $totalCostoInventario;


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
