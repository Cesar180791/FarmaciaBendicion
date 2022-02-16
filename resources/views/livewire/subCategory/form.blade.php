@include('common.modalHead')
<div class="row">
	<div class="col-sm-12">
		<p><b>Nombre de la Sub-Categoría</b></p>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dolly-flatbed"></i>
                </span>
			</div>
			<input type="text" wire:model.lazy="name" class="form-control" placeholder="Nombre de la Sub Categoría">
		</div>
		@error('name') <span class="text-danger er">{{ $message }}</span> @enderror
	</div>

		<div class="col-sm-12 mt-3">
			<p><b>Descripción de la Sub-Categoría</b></p>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-truck-loading"></i>
                </span>
			</div>
			<input type="text" wire:model.lazy="description" class="form-control" placeholder="Descripcion de la Sub Categoría">
		</div>
		@error('description') <span class="text-danger er">{{ $message }}</span> @enderror
	</div>

	<div class="col-sm-12 mt-3">
		<p><b>Seleccione Categoría</b></p>
		<div class="form-group">
			<select wire:model='categoryid' class="form-control">
				<option value="Seleccionar" disabled>Seleccionar</option>
				@foreach($categories as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
			@error('categoryid') <span class="text-danger er">{{ $message }}</span> @enderror
		</div>
	</div>
</div>
@include('common.modalFooter')