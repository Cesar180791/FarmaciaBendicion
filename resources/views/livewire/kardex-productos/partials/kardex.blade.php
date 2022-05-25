<div class="row sales">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h6 class="card-title text-center text-uppercase"><b>Farmacia la Bendición</b></h6>
                <h6 class="card-title text-center text-uppercase"><b>Registro de Control de Inventario</b></h6>
                <h6 class="card-title text-left text-uppercase"><b>Nombre del contribuyente:</b>  Luis Enrique Sorto Argueta</h6>
                <h6 class="card-title text-left text-uppercase"><b>Producto: </b> {{$nombreProducto}}</h6>
                <h6 class="card-title text-left text-uppercase"><b>METODO DE VALUACIÓN:</b> COSTO PROMEDIO</h6>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <h6><b>Fecha desde:</b></h6>
                        <div class="form-group">
                            <input type="date" wire:model="dateFrom" class="form-control flatpickr"
                            placeholder="Click para seleccionar">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <h6><b>Fecha hasta:</b></h6>
                        <div class="form-group">
                            <input type="date" wire:model="dateTo" class="form-control flatpickr"
                            placeholder="Click para seleccionar">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <h6><b>Exportar:</b></h6>
                        <div class="form-group">
                            <a class="btn fondoNegro text-white btn-block {{count($kardex) < 1 ? 'disabled' : '' }}"
                            href="{{ url('control-de-inventario/excel' . '/' . $idProducto  . '/' . $nombreProducto . '/' . $dateFrom . '/' . $dateTo) }}"
                            target="_blank"><i class="fa-solid fa-file-pdf"></i> Excel</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <h6><b>Regresar:</b></h6>
                        <div class="form-group">
                            <a class="btn fondoNegro text-white btn-block" id="regresar"><i class="fa-solid fa-arrow-left"></i> </a> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white fondoNegro">
                                    <tr>
                                        <th class="table-th text-white text-center" colspan="2"></th>
                                        <th class="table-th text-white text-center" colspan="3">Entradas</th>
                                        <th class="table-th text-white text-center" colspan="3">Salidas</th>
                                        <th class="table-th text-white text-center" colspan="6">Existencias</th>
                                    </tr>
                                    <tr>
                                        <th class="table-th text-white text-center">ID</th>
                                        <th class="table-th text-white" width="20%">Concepto</th>
                                        <th class="table-th text-white text-center">Cant</th>
                                        <th class="table-th text-white text-center">Costo U.</th>
                                        <th class="table-th text-white text-center">Total</th>
                                        <th class="table-th text-white text-center">Cant</th>
                                        <th class="table-th text-white text-center">Costo U.</th>
                                        <th class="table-th text-white text-center">Total</th>
                                        <th class="table-th text-white text-center">Cant ppal</th>
                                        <th class="table-th text-white text-center">Cant U.</th>
                                        <th class="table-th text-white text-center">Costo ppal.</th>
                                        <th class="table-th text-white text-center">Costo U.</th>
                                        <th class="table-th text-white text-center">Total</th>
                                        <th class="table-th text-white text-center">fecha de Mov.</th>
                                        <!--<th class="table-th text-white text-center">Ver M.</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kardex as $movimiento)
                                    <tr>
                                        <td class="text-center">{{$movimiento->id}}</td>
                                        <td class="texte-justify">{{$movimiento->concepto}}</td>
                                        @if($movimiento->cantidad_entrada != null)
                                        <td class="text-center">{{$movimiento->cantidad_entrada}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        @if($movimiento->costo_unit_entrada != null)
                                        <td class="text-center">${{number_format($movimiento->costo_unit_entrada,4)}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        @if($movimiento->costo_total_entrada != null)
                                        <td class="text-center">${{number_format($movimiento->costo_total_entrada,4)}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        @if($movimiento->cantidad_salida != null)
                                        <td class="text-center">{{$movimiento->cantidad_salida}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        @if($movimiento->costo_unit_salida != null)
                                        <td class="text-center">${{number_format($movimiento->costo_unit_salida,4)}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        @if($movimiento->costo_total_salida != null)
                                        <td class="text-center">${{number_format($movimiento->costo_total_salida,4)}}</td>
                                        @else
                                        <td class="text-center">--</td>
                                        @endif
                                        <td class="text-center">{{$movimiento->cantidad_existencias_ppal}}</td>
                                        <td class="text-center">{{$movimiento->cantidad_existencias_unitarias}}</td>
                                        <td class="text-center">${{number_format($movimiento->costo_unit_existencias_ppal,4)}}</td>
                                        <td class="text-center">${{number_format($movimiento->costo_unit_existencias_unitarias,4)}}</td>
                                        <td class="text-center">${{number_format($movimiento->costo_total_existencias,4)}}</td>
                                        <td class="text-center">
                                            <p>{{\Carbon\Carbon::parse($movimiento->created_at)->format('M d, Y h:i A')}}</p>
                                        </td>
                                        <!--<td class="text-center">
                                            <a href="javascript:void(0)" class="btn fondoNegro" wire:click.prevent="verMovimiento({{$movimiento->id_transaccion}}, {{$movimiento->tipo_movimiento}})" title="Ver Movimiento">
                                                <i class="fa-solid fa-list text-white"></i>
                                            </a>
                                        </td>-->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$kardex->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>