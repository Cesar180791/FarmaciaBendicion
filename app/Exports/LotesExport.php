<?php

namespace App\Exports;

use App\Models\Lotes;
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


class LotesExport implements
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

    protected $search, $dateFrom, $dateTo, $countFilas, $totalCosto;
    

    function __construct($search, $f1, $f2)
    {
        $this->search = $search;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
        $data = [];

        if($this->search !=''){
            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.caducidad_lote','lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','lotes.existencia_lote','lotes.existencia_lote_unidad','p.precio_caja','p.precio_mayoreo','p.precio_unidad')
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
            ->orderBy('lotes.caducidad_lote','asc')->get();
        }else{
            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.caducidad_lote','lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','lotes.existencia_lote','lotes.existencia_lote_unidad','p.precio_caja','p.precio_mayoreo','p.precio_unidad','lotes.caducidad_lote')
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')->get();
        }

        if($this->dateFrom != null && $this->dateTo != null)
        {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d');
            $to =   Carbon::parse($this->dateTo)->format('Y-m-d');

            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.caducidad_lote','lotes.numero_lote','p.Numero_registro','p.name','p.laboratory','p.chemical_component','p.cost','p.iva_cost','p.final_cost','lotes.existencia_lote','lotes.existencia_lote_unidad','p.precio_caja','p.precio_mayoreo','p.precio_unidad','lotes.caducidad_lote')
            ->whereBetween('lotes.caducidad_lote',[$from,$to])
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')->get();
        }

        //contar numero de registros retornados
        $this->countFilas = count($data) +2;

        //calcular numero de celda donde se imprimiran los totales
        $this->celdaTotal = $this->countFilas + 1;

        return $data;
    }

    //cabeceras del reporte
    public function headings(): array
    {
        return ["CADUCIDAD","N° DE LOTE","N° REGISTRO","PRODUCTO","LABORATORIO","COMPONENTE","COSTO","IVA COSTO","IVA + COSTO","EXISTENCIA","EXISTENCIA UNIDAD","PRECIO","PRECIO MAYOREO","PRECIO UNIDAD","TOTAL COSTO","TOTAL IVA","TOTAL INVENTARIO"];
    }

    //definiendo celda para empezar a exportar
    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(WorksheetWorksheet $sheet)
    {
        for($i = 3; $i <= $this->countFilas;$i++){
            $sheet->setCellValue('O'.$i,'=(G'.$i .'*J'.$i .')');
            $sheet->setCellValue('P'.$i,'=(H'.$i .'*J'.$i .')');
            $sheet->setCellValue('Q'.$i,'=(I'.$i .'*J'.$i .')');
        }

        $sheet->setCellValue('O'.$this->celdaTotal,'=SUM(O3:O'.$this->countFilas .')');
        $sheet->setCellValue('P'.$this->celdaTotal,'=SUM(P3:P'.$this->countFilas .')');
        $sheet->setCellValue('Q'.$this->celdaTotal,'=SUM(Q3:Q'.$this->countFilas .')');

        return [
           // 2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A3:A".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            "B3:B".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            "C3:C".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            "E3:A".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            //"E3:E15000" => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "F3:F".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'left']],
            "G3:G".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "I3:I".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "J3:J".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "K3:K".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "L3:L".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "M3:M".$this->celdaTotal => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
        ];
        
    }
    

    public function title(): string
    {
    return 'Reporte de Lotes';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){ 
                $event->sheet->getStyle('A2:Q2')->applyFromArray([
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
            'F' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'F' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'G' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'H' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'I' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'J' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'L' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'M' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'N' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'O' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'P' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'Q' => NumberFormat::FORMAT_ACCOUNTING_USD,
        ];
    }

}
