<?php

namespace App\Exports;

use App\Models\Lotes;
use Maatwebsite\Excel\Concerns\FromCollection;          //para trabajar con colecciones y obtener la data
use Maatwebsite\Excel\Concerns\WithHeadings;            //para definir los titulos de encabezado
use PhpOffice\PhpSpreadsheet\Worksheet;                 //Para interactuar con el libro
use Maatwebsite\Excel\Concerns\WithCustomStartCell;    //para definir la celda donde inicia el reporte
use Maatwebsite\Excel\Concerns\WithTitle;               //para colocar nombre a las hojas del libro
use Maatwebsite\Excel\Concerns\WithStyles;             //para dar formato a la celda
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as WorksheetWorksheet;

class LotesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search, $dateFrom, $dateTo;

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
            ->select('lotes.numero_lote','p.name','p.laboratory','p.chemical_component','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
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
            ->select('lotes.numero_lote','p.name','p.laboratory','p.chemical_component','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')->get();
        }

        if($this->dateFrom != null && $this->dateTo != null)
        {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d');
            $to =   Carbon::parse($this->dateTo)->format('Y-m-d');

            $data = Lotes::join('products as p','p.id','lotes.products_id')
            ->select('lotes.numero_lote','p.name','p.laboratory','p.chemical_component','lotes.existencia_lote','lotes.existencia_lote_unidad','lotes.caducidad_lote')
            ->whereBetween('lotes.caducidad_lote',[$from,$to])
            ->where('lotes.estado_lote','ACTIVO')
            ->orderBy('lotes.caducidad_lote','asc')->get();
        }

        return $data;
    }

    //cabeceras del reporte
    public function headings(): array
    {
        return ["N° DE LOTE","PRODUCTO","LABORATORIO","COMPONENTE","EXISTENCIA","EXISTENCIA U","CADUCIDAD"];
    }

    //definiendo celda para empezar a exportar
    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(WorksheetWorksheet $sheet)
    {
        return [
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
{
    return 'Reporte de Lotes';
}


}
