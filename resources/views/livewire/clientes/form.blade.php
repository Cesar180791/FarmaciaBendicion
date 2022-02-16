@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Nombre de el cliente</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="nombre_cliente" class="form-control"
                placeholder="Ingrese Nombre de el proveedor">
        </div>
        @error('nombre_cliente') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Teléfono del cliente</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="telefono" class="form-control" placeholder="Telefono del proveedor">
        </div>
        @error('telefono') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>NIT</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-address-card"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="NIT_cliente" class="form-control" placeholder="Direccion del proveedor">
        </div>
        @error('NIT_cliente') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>NRC</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-registered"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="NRC_cliente" class="form-control" placeholder="Direccion del proveedor">
        </div>
        @error('NRC_cliente') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
		<p><b>¿El proveedor es gran contribuyente?</b></p>
		<div class="form-group">
			<select wire:model='gran_con_cliente' class="form-control">
				<option value="Seleccionar" disabled>Seleccionar</option>
                <option value="SI">Si</option>
                <option value="NO">No</option>
			</select>
			@error('gran_con_cliente') <span class="text-danger er">{{ $message }}</span> @enderror
		</div>
	</div>

</div>
@include('common.modalFooter')
