<?php

namespace App\Http\Controllers;

use App\Exports\LotesExport;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Lotes;
use App\Models\Sale;
use App\Models\User;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ExportController extends Controller
{
    public function reporteLotesExcel($search, $dateFrom = null, $dateTo = null){
        if($search === 'sinNombre'){
            $search == 'cofal';
            $reportName = 'Reporte-Lotes-'.uniqid() . '.xlsx';
            return Excel::download(new LotesExport($search, $dateFrom, $dateTo),$reportName);
        }else{
            $reportName = 'Reporte-Lotes-'.uniqid() . '.xlsx';
            return Excel::download(new LotesExport($search, $dateFrom, $dateTo),$reportName);
        }
    }

    public function reporteVentasPdf($userId,$dateFrom=null,$dateTo=null){
        $data =[];
        $data2 = [];
        $data3 = [];

        if($dateFrom == null && $dateTo == null || $dateFrom == '' && $dateTo == ''){
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($userId == 0) {
            $data = Sale::join('tipos_transacciones as tt','tt.id','sales.tipos_transacciones_id')
            ->join('users as u', 'u.id', 'sales.user_id')
            ->select('tt.tipo_transaccion','sales.id as folio','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','sales.created_at','u.name as usuario')
            ->whereBetween('sales.created_at',[$from,$to])
            ->orderBy('sales.created_at','desc')->get();

            /*$data2 = Sale::select('sales.items','sales.total','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->orderBy('sales.created_at','desc')->get();*/

            $data2 = Sale::join('sale_details as sd','sd.sale_id','sales.id')
            ->select('sd.costo','sd.quantity')
            ->whereBetween('sales.created_at',[$from,$to])->get();

        } else{
            $data = Sale::join('tipos_transacciones as tt','tt.id','sales.tipos_transacciones_id')
            ->join('users as u', 'u.id', 'sales.user_id')
            ->select('tt.tipo_transaccion','sales.id as folio','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','sales.created_at','u.name as usuario')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id', $userId)
            ->orderBy('sales.created_at','desc')->get();

          /* $data2 = Sale::select('sales.items','sales.total','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id', $userId)
            ->orderBy('sales.created_at','desc')->get();*/

            $data2 = Sale::join('sale_details as sd','sd.sale_id','sales.id')
            ->select('sd.costo','sd.quantity')
            ->whereBetween('sales.created_at',[$from,$to])->where('user_id', $userId)->get();
        }

        /*$sumTotalGlobal = $data2->sum('total');*/
      

        $sumCostoGlobal = $data2->sum(function($item){
            return $item->quantity * $item->costo;
        });

        //buscar usuario
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;

        $pdf = PDF::loadView('pdf.reporte-ventas', compact('data','sumCostoGlobal','user','dateFrom','dateTo'));

        return $pdf->stream('reporte-ventas.pdf');
        return $pdf->download('reporte-ventas.pdf');

    }

    public function reporteVentasExcel($userId,$dateFrom=null,$dateTo=null){
        $reportName = 'Reporte-Ventas-'.uniqid() . '.xlsx';
         return Excel::download(new SalesExport($userId, $dateFrom, $dateTo),$reportName);
    }
}
