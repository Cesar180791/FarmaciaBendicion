<div wire:ignore.self class="modal fade" id="theModalFacturas" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header fondoNegro">
                <h5 class="modal-title text-white">
                    <b>N° Facturas</b> | {{$id_factura > 0 ? 'Editar' : 'Asignar'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>Por Favor Espere</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 mt-3">
                        <p><b>Serie </b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fa-solid fa-receipt"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="serie_factura" class="form-control"
                                placeholder="Ingrese serie de factura">
                        </div>
                        @error('serie_factura') <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 mt-3">
                        <p><b>N° factura </b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fa-solid fa-receipt"></i>
                                </span>
                            </div>
                            <input type="number" wire:model.lazy="numero_factura_inicial" class="form-control"
                                placeholder="Ingrese Numero de factura">
                        </div>
                        @error('numero_factura_inicial') <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn fondoNegro close-btn text-white"
                    data-dismiss="modal"><b>Cerrar</b></button>
                @if($id_factura < 1) <button type="button" wire:click.prevent="StoreFactura()"
                    class="btn fondoNegro close-modal text-white"><b>Guardar</b></button>
                    @else
                    <button type="button" wire:click.prevent="UpdateFactura()"
                        class="btn fondoNegro close-modal text-white"><b>Actualizar</b></button>
                    @endif
            </div>
        </div>
    </div>
</div>
