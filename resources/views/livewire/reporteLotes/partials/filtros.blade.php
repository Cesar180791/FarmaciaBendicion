<div class="row">

    <div class="col-sm-12 mb-3">
        <h6><b>Datos Generales de Inventario</b></h6><hr>
        <h6><b>Total Costo: </b> ${{number_format($costoTotal,4)}}</h6>
        <h6><b>Total IVA: </b> ${{number_format($totalIva,4)}}</h6>
        <h6><b>Total Inventario: </b> ${{number_format($totalCostoIVA,4)}}</h6><hr>
    </div>



    <div class="col-sm-12 mb-3">
        <h6><b>Buscar</b></h6>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text fondoNegro">
                    <i class="fas fa-search text-white"></i>
                </span>
            </div>
            <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
        </div>
    </div>

    <div class="col-sm-12">
        <h6><b>Desde:</b></h6>
        <div class="form-group">
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-sm-12 mt-3">
        <h6><b>Hasta</b></h6>
        <div class="form-group">
            <input type="date" wire:model="dateTo" class="form-control">
        </div>
    </div>

    <div class="col-sm-12">
        <button wire:click="resetFiltros" class="btn fondoNegro btn-block text-white"><b><i class="fa-solid fa-filter"></i> Reset Filtros</b></button>

        @if ($search == '')
        <a class="btn btn-success btn-block {{$dateTo == '' ? 'disabled' : '' }}" href="{{ url('reporte-lotes/excel' . '/' . 'sinNombre' . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank"><b><i class="fa-solid fa-file-excel"></i> Exportar por fechas</b></a>
        @elseif($search != '')
        <a class="btn btn-success btn-block {{count($data) < 1 ? 'disabled' : '' }}" href="{{ url('reporte-lotes/excel' . '/' . $search . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank"><b><i class="fa-solid fa-file-excel"></i> Exportar por nombre</b></a>
        @endif
        @if($search == '' && $dateFrom == '' && $dateTo == '')
        <a class="btn btn-success btn-block {{count($data) < 1 ? 'disabled' : '' }}" href="{{ url('reporte-lotes/excel' . '/' . $search . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank"><b><i class="fa-solid fa-file-excel"></i> Exportar todo</b></a>
        @endif

    </div> 

</div>