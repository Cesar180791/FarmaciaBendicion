<div class="row mt-2">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">
                <p class="text-center mb-3">Resumen de Venta</p>
                <div class="connect-sorting-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="task-header">
                                <div>
                                    <h6 class="text-primary"><b>Total: ${{number_format($total,2)}}</b></h6>
                                    <h6 class="">Cambio: ${{number_format($change,2)}}
                                        @if ($efectivo > $total)
                                        <span
                                            class="spinner-grow text-success align-self-center loader-sm">Loading...</span>
                                        @endif
                                    </h6>
                                    <hr>
                                    <h6 class="mt-3">Articulos: {{$itemsQuantity}}</h6>
                                    <h6>Numero de filas: {{$limitar_cant_producto}}</h6>
                                    <input type="hidden" id="hiddenTotal" value="{{$total}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="connect-sorting-content mt-3">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp hideonsm"
                                        style="background: #3B3F5C; color: white;">Efec F3
                                    </span>
                                </div>
                                <input type="number" id="cash" wire:model="efectivo" wire:keydown.enter="saveSale"
                                    class="form-control text-center" value="{{number_format($efectivo,2)}}">
                                <div class="input-group-append">
                                    <span wire:click="$set('efectivo', 0)" class="input-group-text"
                                        style="background: #3B3F5C; color:white">
                                        <i class="fas fa-backspace"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row justify-content-between mt-3">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if($total > 0)
                                    <button onclick="Confirm('','clearCart','¿Seguro de eliminar el detalle de venta?')"
                                        class="btn btn-danger mtmobile btn-sm">
                                        CANCELAR
                                    </button>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if($efectivo >= $total && $total > 0)

                                    @if($facturas=== null)


                                    <h6 class="text-danger"><b>Agregar Factura</b></h6>

                                    @else
                                    <button wire:click="saveSale" class="btn btn-dark btn-block">
                                        Facturar
                                    </button>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="{{ asset('plugins/loaders/custom-loader.css') }}" rel="stylesheet" type="text/css" />
</div>
