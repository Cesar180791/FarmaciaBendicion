<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h6 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle2}}</b>
        </h6>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar" class="tabmenu btn btn-danger text-white mt-1"><b><i
                            class="fas fa-arrow-left"></i></b></a>
            </li>
        </ul>
    </div>

    <div class="widget-content">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp bg-dark">
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
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="table-th text-white text-center">Numero de lote</th>
                        <th width="30%" class="table-th text-white">Producto</th>
                        <th class="table-th text-white text-center">Existencia</th>
                        <th class="table-th text-white text-center">Existencia U</th>
                        <th class="table-th text-white text-center">Caducidad</th>
                        <th class="table-th text-white text-center">Creado por</th>
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
                        <td class="text-center">
                            @if ($lote->existencia_lote_unidad === null)
                            <p>N/A</p>

                            @else
                            <p>{{$lote->existencia_lote_unidad}}</p>
                            @endif
                        </td>
                        <td class="text-center">
                            {{$lote->caducidad_lote}}
                        </td>
                        <td class="text-center">
                            {{$lote->name}}
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