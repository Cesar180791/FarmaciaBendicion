<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h6 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle4}}</b>
        </h6>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar2" class="tabmenu btn btn-danger text-white mt-1"><b><i
                            class="fas fa-arrow-left"></i></b></a>
                <a href="javascript:void(0)" class="tabmenu btn fondoNegro text-white mt-1"
                    wire:click.prevent="nuevoLote({{$idProducto}})"><b>Crear lote</b></a>
            </li>
        </ul>
    </div>

    <div class="widget-content">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp fondoNegro text-white">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" wire:model="search2" placeholder="Buscar" class="form-control">
                </div>
            </div>
        </div>
        @if(count($lotes)==0) 
        <div class="alert alert-danger">No hay lotes registrados a este producto</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white fondoNegro">
                    <tr>
                        <th class="table-th text-white">Numero de lote</th>
                        <th width="30%" class="table-th text-white">Producto</th>
                        <th class="table-th text-white text-center">Existencia</th>
                        <th class="table-th text-white text-center">Existencia U</th>
                        <th class="table-th text-white text-center">Caducidad</th>
                        <th class="table-th text-white text-center">Estado</th>
                        <th class="table-th text-white text-center">Creado por</th>
                        <th class="table-th"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lotes as $lote)
                    <tr>
                        <td>
                            {{$lote->numero_lote}}
                        </td>
                        <td>
                            {{$lote->nombreProducto}}
                        </td>
                        <td>
                            {{$lote->existencia_lote}}
                        </td>
                        <td>
                            @if ($lote->existencia_lote_unidad === null)
                            <p>No se vende por unidad</p>

                            @else
                            <p>{{$lote->existencia_lote_unidad}}</p>
                            @endif
                        </td>
                        <td>
                            {{$lote->caducidad_lote}}
                        </td>
                        <td class="text-center">
                            <span
                                class="badge {{$lote->estado_lote == 'ACTIVO' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{$lote->estado_lote}}</span>
                        </td>
                        <td class="text-center">
                            {{$lote->name}}
                        </td>
                        <td class="">
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
                                    <a href="javascript:void(0);" wire:click.prevent="editarLote({{$lote->id}})"
                                        data-toggle="tooltip" data-placement="top" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit text-primary">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$lotes->links()}}
        </div>
        @endif
    </div>
</div>
