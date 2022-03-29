<div class="row">
    @if (auth()->user()->profile == 'Administrador')
    <div class="col-sm-12 mb-3">
        <h6><b>Datos Generales</b></h6><hr>
        <div class="row">
            <div class="col-sm-6">
                <h6><b>Total Ventas: </b></h6>
                <h6><b>Neto: </b></h6>
                <h6><b>Total Costo: </b></h6><hr>
                <h6><b>Utilidad: </b></h6>
            </div>
            <div class="col-sm-6">
                <h6>${{number_format($sumTotalGlobal,4)}}</h6>
                <h6>${{number_format($sumTotalGlobal / 1.13,4)}}</h6>
                <h6 class="text-danger">${{number_format($sumCostoGlobal,4)}} (-)</h6><hr>
                <h6 class="text-success"><b>${{number_format(($sumTotalGlobal / 1.13) - $sumCostoGlobal,4)}}</b></h6>
            </div>
        </div>
    </div>
    @endif
    <div class="col-sm-12"><hr>
        <h6><b>Filtros</b></h6>
    </div>
    <div class="col-sm-12">
        <h6>Selecciona Usuario</h6>
        <div class="form-group">
            <select wire:model="userId" class="form-control">
                <option value="0">Todos</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <h6>Fecha desde</h6>
        <div class="form-group">
            <input type="date" wire:model="dateFrom" class="form-control flatpickr"
            placeholder="Click para seleccionar">
        </div>
    </div>
    <div class="col-sm-12">
        <h6>Fecha hasta</h6>
        <div class="form-group">
            <input type="date" wire:model="dateTo" class="form-control flatpickr"
            placeholder="Click para seleccionar">
        </div>
    </div>
    <div class="col-sm-12">
        <a class="btn fondoNegro text-white btn-block {{count($data) < 1 ? 'disabled' : '' }}"
            href="{{ url('reporte-ventas/pdf' . '/' . $userId  . '/' . $dateFrom . '/' . $dateTo) }}"
        target="_blank"><i class="fa-solid fa-file-pdf"></i> Generar PDF</a>
    </div>
</div>