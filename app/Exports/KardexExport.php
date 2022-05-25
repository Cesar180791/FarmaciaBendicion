<?php

namespace App\Exports;

use App\Models\KardexProductos;
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
Use PhpOffice\PhpSpreadsheet\Shared\Date;

class KardexExport implements 
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

    protected $id, $productoName, $dateFrom, $dateTo, $countFilas;

    function __construct($id, $productoName, $dateFrom, $dateTo){
        $this->id = $id;
        $this->productoName = $productoName;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function collection()
    {
        $data = [];

        if($this->dateFrom != null){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';


            $data = kardexProductos::join('products as p','p.id','kardex_productos.products_id')
            ->select('kardex_productos.id','kardex_productos.concepto','kardex_productos.cantidad_entrada','kardex_productos.costo_unit_entrada','kardex_productos.costo_total_entrada','kardex_productos.cantidad_salida','kardex_productos.costo_unit_salida','kardex_productos.costo_total_salida','kardex_productos.cantidad_existencias_ppal','kardex_productos.cantidad_existencias_unitarias','kardex_productos.costo_unit_existencias_ppal','kardex_productos.costo_unit_existencias_unitarias','kardex_productos.costo_total_existencias','kardex_productos.created_at')
            ->whereBetween('kardex_productos.created_at',[$from,$to])
            ->where('kardex_productos.products_id', $this->id)->get();


        }else{

            $data = kardexProductos::join('products as p','p.id','kardex_productos.products_id')
            ->select('kardex_productos.id','kardex_productos.concepto','kardex_productos.cantidad_entrada','kardex_productos.costo_unit_entrada','kardex_productos.costo_total_entrada','kardex_productos.cantidad_salida','kardex_productos.costo_unit_salida','kardex_productos.costo_total_salida','kardex_productos.cantidad_existencias_ppal','kardex_productos.cantidad_existencias_unitarias','kardex_productos.costo_unit_existencias_ppal','kardex_productos.costo_unit_existencias_unitarias','kardex_productos.costo_total_existencias','kardex_productos.created_at')
            ->where('kardex_productos.products_id', $this->id)->get();
        }

        $this->countFilas = count($data);

        return $data;

        //return KardexProductos::all();
    }

    //cabeceras del reporte
    public function headings(): array
    {
        return ["ID","CONCEPTO","CANT","COSTO U.","TOTAL","CANT","COSTO U.","TOTAL","CANT PPAL.","CANT U.","COSTO PPAL","COSTO U","TOTAL INVENTARIO","FECHA MOVIMIENTO"];
    }

    //definiendo celda para empezar a exportar
    public function startCell(): string
    {
        return 'A9';
    }

    public function styles(WorksheetWorksheet $sheet)
    {
        $sheet->mergeCells('A2:N2');
        $sheet->setCellValue('A2','FARMACIA LA BENDICIÓN');

        $sheet->mergeCells('A3:N3');
        $sheet->setCellValue('A3','REGISTRO DE CONTROL DE INVENTARIO');

        //$sheet->mergeCells('A4:B4');
        $sheet->setCellValue('A4','NOMBRE DEL CONTRIBUYENTE:');
        $sheet->setCellValue('B4','LUIS ENRIQUE SORTO ARGUETA');

       // $sheet->mergeCells('A5:B5');
        $sheet->setCellValue('A5','PRODUCTO:');
        $sheet->setCellValue('B5', $this->productoName);

        //$sheet->mergeCells('A6:B6');
        $sheet->setCellValue('A6','METODO DE VALUACIÓN:');
        $sheet->setCellValue('B6','COSTO PROMEDIO');

        //$sheet->mergeCells('A7:B7');
        $sheet->setCellValue('A7','PERIODO:');

        $sheet->mergeCells('C8:E8');
        $sheet->setCellValue('C8','ENTRADA');

        $sheet->mergeCells('F8:H8');
        $sheet->setCellValue('F8','SALIDA');

        $sheet->mergeCells('I8:N8');
        $sheet->setCellValue('I8','EXISTENCIAS');

         if($this->dateFrom != null && $this->dateTo != null){
            $sheet->setCellValue('B7', 'Del ' . $this->dateFrom . ' al ' . $this->dateTo);
        }else{
            $sheet->setCellValue('B7', 'Del ' . $this->dateFrom . ' al ' . date('Y-m-d'));   
        }

        if($this->dateFrom == null && $this->dateTo == null){
             $sheet->setCellValue('B7', 'TODOS LOS MOVIMIENTOS A LA FECHA'); 
        }

         return [
            "A2:N2" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A3:N3" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A4" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'justify']],
            "A5" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'justify']],
            "A6" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'justify']],
            "A7" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'justify']],
            "C8" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "F8" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "I8" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A9:N9" => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            "A10:A".$this->countFilas + 10 => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'center']],
            "B10:B".$this->countFilas + 10 => ['font' => ['bold' => false], 'alignment' => ['horizontal' => 'justify']],

        ];
    }


    public function title(): string
    {
        return $this->productoName;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){ 
                $event->sheet->getStyle('A8:N8')->applyFromArray([
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
            'D' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'E' => NumberFormat::FORMAT_ACCOUNTING_USD,
            //'F' => NumberFormat::FORMAT_DATE_DATETIME,
            'G' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'H' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'K' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'L' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'M' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'N' => NumberFormat::FORMAT_DATE_XLSX22
        ];
    }

}
