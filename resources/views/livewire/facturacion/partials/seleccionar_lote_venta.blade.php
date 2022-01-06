<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h4 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle4}}</b>
        </h4>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar2" class="tabmenu btn btn-danger text-white mt-1"><b><i class="fas fa-arrow-left"></i></b></a>
            </li>
        </ul> 
    </div>

    <div class="widget-content">
        @if(count($lotes)==0)
        <div class="alert alert-danger">No hay lotes registrados a este producto</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="table-th text-white text-center">Numero de lote</th>
                        <th width="50%" class="table-th text-white">Producto</th>
                        <th class="table-th text-white text-center">Existencia</th>
                        <th class="table-th text-white text-center">Existencia U</th>
                        <th class="table-th text-white text-center">Caducidad</th>
                        <th class="table-th"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lotes as $lote)
                    <tr>
                        <td class="text-center">
                           {{$lote->numero_lote}}
                        </td>
                        <td>
                           {{$lote->nombreProducto}}
                        </td>
                        <td class="text-center">
                           {{$lote->existencia_lote}}
                        </td>
                        <td>
                            @if ($lote->existencia_lote_unidad === null)
                            <p>No se vende por unidad</p>

                            @else
                            <p>{{$lote->existencia_lote_unidad}}</p>
                            @endif
                        </td>
                        <td class="text-center">
                           {{$lote->caducidad_lote}}
                        </td>
                        <td class="text-center">
                            <ul class="table-controls">
                                <li style="list-style: none;">
                                    <a href="javascript:void(0);"
                                        wire:click.prevent="addItem({{$lote->products_id}},{{$lote->id}})"
                                        data-toggle="tooltip" data-placement="top" title="Agregar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-circle text-primary">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
