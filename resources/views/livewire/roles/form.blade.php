<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header fondoNegro">
                <h5 class="modal-title text-white">
                    <b>{{$componentName}}</b> | {{$selected_id > 0 ? 'Editar' : 'Crear'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>Por Favor Espere</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                       <p><b>Rol</b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="roleName" class="form-control"
                                placeholder="Ingrese Nombre del Rol" maxlength="255">
                        </div>
                        @error('roleName') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn fondoNegro close-btn text-white"
                    data-dismiss="modal"><b>Cerrar</b></button>
                @if($selected_id < 1) <button type="button" wire:click.prevent="CreateRole()"
                    class="btn fondoNegro text-white close-modal"><b>Guardar</b></button>
                    @else
                    <button type="button" wire:click.prevent="UpdateRole()"
                        class="btn fondoNegro text-white close-modal"><b>Actualizar</b></button>
                    @endif
            </div>
        </div>
    </div>
</div>
