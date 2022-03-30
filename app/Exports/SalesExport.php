<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;          //para trabajar con colecciones y obtener la data
use Maatwebsite\Excel\Concerns\WithHeadings;            //para definir los titulos de encabezado              
use Maatwebsite\Excel\Concerns\WithCustomStartCell;    //para definir la celda donde inicia el reporte
use Maatwebsite\Excel\Concerns\WithTitle;               //para colocar nombre a las hojas del libro
use Maatwebsite\Excel\Concerns\WithStyles;             //para dar formato a la celda
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as WorksheetWorksheet; //Para interactuar con el libro
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SalesExport implements 
WithColumnFormatting, 
WithEvents,
FromCollection,
WithHeadings, 
WithCustomStartCell, 
WithTitle, 
WithStyles, 
ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $userId, $dateFrom, $dateTo, $total,$costos;

    function __construct($userId, $f1, $f2)
    {
        $this->userId = $userId;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
        $data =[];

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
            ->select('sales.id as folio','tt.tipo_transaccion','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','u.name as usuario','sales.created_at')
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
            ->select('sales.id as folio','tt.tipo_transaccion','sales.items','sales.total','sales.cash','sales.change','sales.numero_factura','u.name as usuario','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id', $this->userId)
            ->orderBy('sales.created_at','desc')->get();

          /* $data2 = Sale::select('sales.items','sales.total','sales.created_at')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id', $userId)
            ->orderBy('sales.created_at','desc')->get();*/

            $data2 = Sale::join('sale_details as sd','sd.sale_id','sales.id')
            ->select('sd.costo','sd.quantity')
            ->whereBetween('sales.created_at',[$from,$to])->where('user_id', $this->userId)->get();
        }

        ///sacar total
        $this->total = $data->sum('total');


        //sacar costos
        $this->costos = $data2->sum(function($item){
            return $item->quantity * $item->costo;
        });

         //contar numero de registros retornados
        $this->countFilas = count($data) +2;

         //calcular numero de celda donde se imprimiran los totales
        $this->celdaTotal = $this->countFilas + 1;

         return $data;



    }

    //cabeceras del reporte
    public function headings(): array
    {
        return ["FOLIO","TRANSACCIÓN","N° PRODUCTOS","TOTAL","RECIBIDO","CAMBIO","N° FACTURA","USUARIO","FECHA"];
    }

    //definiendo celda para empezar a exportar
    public function startCell(): string
    {
        return 'A2';
    }

   public function styles(WorksheetWorksheet $sheet)
    {
        if (auth()->user()->profile == 'Administrador') {
            $sheet->setCellValue('K2','Total:');
            $sheet->setCellValue('K3','Neto:');
            $sheet->setCellValue('K4','Costos:');
            $sheet->setCellValue('K5','Utilidad:');
            $sheet->setCellValue('L2',$this->total);
            $sheet->setCellValue('L3',($this->total/1.13));
            $sheet->setCellValue('L4',$this->costos);
            $sheet->setCellValue('L5',($this->total/1.13) - $this->costos);
            
        }
       
        return [
           // 2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A3:A".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "B3:B".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "C3:C".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "D3:D".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "E3:E".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "F3:F".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "G3:G".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "H3:H".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "I3:I".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "K2" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'left']],
            "K3" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'left']],
            "K4" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'left']],
            "K5" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'left']],
            /*"E3:A".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            //"E3:E15000" => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "F3:F".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            "G3:G".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "I3:I".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "J3:J".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "K3:K".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "L3:L".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "M3:M".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],*/
        ];
        
    }






    public function title(): string
    {
    return 'Reporte de Ventas';
    }

     public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){ 
                $event->sheet->getStyle('A2:I2')->applyFromArray([
                    'font' =>[
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            }
        ];
    }



    public function columnFormats(): array
    {   //se modifico el archivo number format directorio vendor/phpoficce/src/PhpSpreadsheet/style/NumberFormat/NumberFormat.php 
        //linea numero 49 se cambio de:'_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)' a: '_("$"* #,##0.0000_);_("$"* \(#,##0.0000\);_("$"* "-"??_);_(@_)'
        //para que muestre numeros decimales de 4 cifras
        return [
            //'A' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'F' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'G' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'H' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'I' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'D' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'E' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'F' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'I' => NumberFormat::FORMAT_DATE_DATETIME,
            'L' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'N' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'O' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'P' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'Q' => NumberFormat::FORMAT_ACCOUNTING_USD,
        ];
    }



}
