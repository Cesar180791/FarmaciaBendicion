<div wire:ignore.self class="modal fade" id="theModalDetalle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header fondoNegro">
                <h5 class="modal-title text-white">
                <b>{{$componentName}}</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>Por Favor Espere</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white text-center">FOLIO</th>
                                <th class="table-th text-white text-center">Cant</th>
                                <th class="table-th text-white">Producto</th>
                                <th class="table-th text-white">Lote</th>
                                @if (auth()->user()->profile == 'Administrador')
                                <th class="table-th text-white text-center">Costo</th>
                                @endif
                                <th width="12%" class="table-th text-white text-center">Precio Venta</th>
                                @if (auth()->user()->profile == 'Administrador')
                                <th class="table-th text-white text-center">Ganancia</th>
                                <th class="table-th text-white text-center">Total Costo</th>
                                @endif
                                <th width="12%" class="table-th text-white text-center">Total Venta</th>
                                @if (auth()->user()->profile == 'Administrador')
                                <th class="table-th text-white text-center">Ganancia Total</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $detalle)
                            <tr>
                                <td class="text-center">
                                    <p>{{$detalle->id}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$detalle->cantidad}}</p>
                                </td>
                                <td class="">
                                    <p>{{$detalle->name}} - {{$detalle->tipo_venta}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$detalle->numero_lote}}</p>
                                </td>
                                @if (auth()->user()->profile == 'Administrador')
                                <td class="text-center">
                                    <p>${{number_format($detalle->costo,4)}}</p>
                                </td>
                                @endif
                                <td class="">
                                    <p><b>PV:</b> ${{number_format($detalle->precio_venta,4)}}<br> <b>IVA:</b> ${{number_format($detalle->iva_precio_venta,4)}}<br> <b>PF:</b> ${{number_format($detalle->precio_venta_mas_iva,4)}}</p>
                                </td>
                                @if (auth()->user()->profile == 'Administrador')
                                <td class="text-center">
                                    <p class="text-success">${{number_format(($detalle->precio_venta) - $detalle->costo,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($detalle->costo * $detalle->cantidad,4)}}</p>
                                </td>
                                @endif
                                <td class="">
                                    <p><b>PV:</b>${{number_format($detalle->precio_venta * $detalle->cantidad,4)}}<br> <b>IVA:</b> ${{number_format($detalle->iva_precio_venta * $detalle->cantidad,4)}}<br> <b>PF:</b> ${{number_format($detalle->precio_venta_mas_iva * $detalle->cantidad,4)}}</p>
                                </td>
                                @if (auth()->user()->profile == 'Administrador')
                                <td class="text-center">
                                    <p class="text-success">${{number_format(($detalle->precio_venta * $detalle->cantidad) - ($detalle->costo * $detalle->cantidad),4)}}</p>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="">
                                <p class="text-center font-weight-bold"><b>Total</b></p>
                            </td>
                            <td>
                                <p class="text-center"><b>{{$countDetails}}</b></p>
                            </td>
                            @if (auth()->user()->profile == 'Administrador')
                            <td colspan="5">
                                
                            </td>
                            @else
                            <td colspan="3">
                                
                            </td>
                            @endif
                            @if (auth()->user()->profile == 'Administrador')
                            <td>
                                <p class="text-center"><b>${{number_format($sumCosto,4)}}</b></p>
                            </td>
                            @endif
                            <td>
                                <p class="text-center">${{number_format($sumDetails,4)}}<br><b>Neto: ${{number_format($sumDetails / 1.13,4)}} </b></p>
                            </td>
                            @if (auth()->user()->profile == 'Administrador')
                            <td>
                                <p class="text-center text-success"><b> ${{number_format($sumGanancia,4)}}</b></p>
                            </td>
                            @endif
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn fondoNegro close-btn text-white"
                data-dismiss="modal"><b>Cerrar</b></button>
            </div>
        </div>
    </div>
</div>