<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;

use Livewire\Component;

class ReporteVentas extends Component
{
    use WithPagination; 
    public $conponenName, $dateFrom, $dateTo, $userId, $saleId, $details, $countDetails, $sumDetails;
    private $pagination = 5;

    public function mount(){
        $this->componentName = 'Reporte de Ventas';
        $this->details = [];
        $this->userId=0;
        $this->saleId=0;
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        //armar fecha para filtrar las ventas
        if($this->dateFrom == null && $this->dateTo == null || $this->dateFrom == '' && $this->dateTo == ''){
             $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
             $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($this->userId == 0) {
            $data = Sale::join('tipos_transacciones as tt','tt.id','sales.tipos_transacciones_id')
            ->join('users as u', 'u.id', 'sales.user_id')
            ->select('tt.tipo_transaccion','sales.id as folio','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','sales.created_at','u.name as usuario')
            ->whereBetween('sales.created_at',[$from,$to])
            ->orderBy('sales.created_at','desc')->paginate($this->pagination);

        } else {
            $data = Sale::join('tipos_transacciones as tt','tt.id','sales.tipos_transacciones_id')
            ->join('users as u', 'u.id', 'sales.user_id')
            ->select('tt.tipo_transaccion','sales.id as folio','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','u.name as usuario')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id', $this->userId)
            ->orderBy('sales.created_at','desc')->paginate($this->pagination);
        }

        //dd($data);
        return view('livewire.reporte-ventas.reporte-ventas',[
            'data' => $data
        ])
        ->extends('layouts.theme.app')->section('content');
    }

    public function getDetails($SaleId){
        $this->details = SaleDetails::join('lotes as l','l.id','sale_details.lotes_id')
        ->join('products as p', 'p.id','l.products_id')
        ->select('l.products_id','l.numero_lote','sale_details.id', 'sale_details.tipo_venta', 'sale_details.costo', 'sale_details.costo_iva', 'sale_details.costo_mas_iva','sale_details.precio_venta_mas_iva','sale_details.quantity as cantidad','p.name')
        ->where('sale_details.sale_id',$SaleId)
        ->get();

        $this->countDetails = $this->details->sum('cantidad');
        $suma = $this->details->sum(function($item){
            return $item->cantidad * $item->precio_venta_mas_iva;
        });
        $this->sumDetails = $suma;

        $this->emit('show-modal');
    }
}
