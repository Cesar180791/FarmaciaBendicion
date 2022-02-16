@include('common.modalHead')
<div class="row">
    <div class="col-sm-12">
        <p><b>Nombre de la Categoría</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
				<span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dolly-flatbed"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ingrese Nombre de la Categoría">
        </div>
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <p><b>Descripción de la Categoría</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-truck-loading"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="description" class="form-control"
                placeholder="Descripción de la Categoría">
        </div>
        @error('description') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <p><b>Seleccione una Imagen</b></p>
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model="image"
                accept="image/x-png, image/gif, image/jpeg">
            <label class="custom-file-label">Imagen {{$image}}</b></p>
            @error('image') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
