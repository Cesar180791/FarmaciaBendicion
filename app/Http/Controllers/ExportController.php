<?php

namespace App\Http\Controllers;

use App\Exports\LotesExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Lotes;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
   public function reporteLotesExcel($search, $dateFrom = null, $dateTo = null){
       if($search === 'sinNombre'){
           $search == 'cofal';
           $reportName = 'Reporte Lotes_'.uniqid() . '.xlsx';
           return Excel::download(new LotesExport($search, $dateFrom, $dateTo),$reportName);
       }else{
        $reportName = 'Reporte Lotes_'.uniqid() . '.xlsx';
        return Excel::download(new LotesExport($search, $dateFrom, $dateTo),$reportName);

       }
       
   } 
}
