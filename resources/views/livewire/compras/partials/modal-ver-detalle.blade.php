<div wire:ignore.self class="modal fade" id="theModalDetalleCompra" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header fondoNegro">
                <h5 class="modal-title text-white">
                    <b>Detalle de Compra
                </h5>
                <h6 class="text-center text-warning" wire:loading>Por Favor Espere</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white text-center">FOLIO</th>
                                <th class="table-th text-white">Producto</th>
                                <th class="table-th text-white">Lote</th>
                                <th class="table-th text-white">Garantia</th>
                                <th class="table-th text-white">P. Venta</th>
                                <th class="table-th text-white">P. Venta M.</th>
                                <th class="table-th text-white">P. Venta U.</th>
                                <th class="table-th text-white text-center">Cant</th>
                                @if (auth()->user()->profile == 'Administrador')
                                <th class="table-th text-white text-center">Costo</th>
                                <th class="table-th text-white text-center">Total</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalle_compra as $detalle)
                                <tr>
                                    <td class="text-center">{{$detalle->id_detalle}}</td>
                                    <td class="">{{$detalle->producto}}</td>
                                    <td class="">Numero: <br> {{$detalle->numero_lote}} <br> Caducidad: <br> {{$detalle->caducidad_lote}}</td>
                                    @if ($detalle->garantia_meses > 0)
                                    <td class="text-center">{{$detalle->garantia_meses}} Meses</td>
                                    @else
                                    <td class="text-center">No Devolutiva</td>
                                    @endif
                                    <td class="text-center">${{number_format($detalle->precio_venta,4)}}</td>
                                    <td class="text-center">${{number_format($detalle->precio_venta_mayoreo,4)}}</td>
                                    <td class="text-center">${{number_format($detalle->precio_venta_unidad,4)}}</td>
                                    <td class="text-center">{{$detalle->quantity}}</td>
                                    @if (auth()->user()->profile == 'Administrador')
                                    <td class="text-center">${{number_format($detalle->costo,4)}}</td>
                                    <td class="text-center">${{number_format($detalle->costo * $detalle->quantity,4)}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-right">Total</td>
                                <td class="text-center"><strong>{{$totalQuantityDetalles}}</strong></td>
                                <td class="text-center"><strong>${{number_format($totalCostoDetalles,4)}}</strong></td>
                                <td class="text-center"><strong>${{number_format($totalDetalle,4)}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn fondoNegro close-btn text-white"
                    data-dismiss="modal"><b>Cerrar</b></button>
            </div>
        </div>
    </div>
</div>
