<div wire:ignore.self class="modal fade" id="theModalDetalle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
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
                                <th class="table-th text-white text-center">ID</th>
                                <th class="table-th text-white text-center">Cant</th>
                                <th class="table-th text-white">Producto</th>
                                <th class="table-th text-white text-center">Precio</th>
                                <th class="table-th text-white text-center">Total</th>
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
                                    <p>{{$detalle->name}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($detalle->precio_venta_mas_iva,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($detalle->precio_venta_mas_iva * $detalle->cantidad,4)}}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <p class="text-center font-weight-bold">Total</p>
                                </td>
                                <td>
                                    <p class="text-center">{{$countDetails}}</p>
                                </td>
                                <td>
                                    <p class="text-center">${{number_format($sumDetails,4)}}</p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn fondoNegro close-btn text-white"
                    data-dismiss="modal"><b>Cerrar</b></button>
                <a type="button" wire:click.prevent='$emit("print-factura-consumidor-final",{{$imprimirfacturaModal}})'
                    class="btn fondoNegro close-modal text-white"><b>Imprimir Factura</b></a>
            </div>
        </div>
    </div>
</div>
