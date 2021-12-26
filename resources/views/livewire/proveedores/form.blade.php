@include('common.modalHead')
<div class="row">
	<div class="col-sm-12">
		<label>Nombre de el proveedor</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<span class="fas fa-edit">

					</span>
				</span>
			</div>
			<input type="text" wire:model.lazy="nombre_proveedor" class="form-control" placeholder="Ingrese Nombre de el proveedor">
		</div>
		@error('nombre_proveedor') <span class="text-danger er">{{ $message }}</span> @enderror
	</div>

		<div class="col-sm-12 mt-3">
			<label>telefono del Proveedor</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<span class="fas fa-edit">

					</span>
				</span>
			</div>
			<input type="text" wire:model.lazy="telefono" class="form-control" placeholder="Telefono del proveedor">
		</div>
		@error('telefono') <span class="text-danger er">{{ $message }}</span> @enderror
	</div>

		<div class="col-sm-12 mt-3">
			<label>NIT</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">
					<span class="fas fa-edit">

					</span>
				</span>
			</div>
			<input type="text" wire:model.lazy="NIT" class="form-control" placeholder="Direccion del proveedor">
		</div>
		@error('NIT') <span class="text-danger er">{{ $message }}</span> @enderror
	</div>

    <div class="col-sm-12 mt-3">
        <label>NRC</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <span class="fas fa-edit">

                </span>
            </span>
        </div>
        <input type="text" wire:model.lazy="NRC" class="form-control" placeholder="Direccion del proveedor">
    </div>
    @error('NRC') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>
@include('common.modalFooter')