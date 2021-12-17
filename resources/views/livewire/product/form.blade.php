@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6 mt-3">
        <label>Nombre del Producto</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ingrese Nombre del producto">
        </div>
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <label>Componente Quimico </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="chemical_component" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('chemical_component') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <label>Laboratorio </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="laboratory" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('laboratory') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <label>Código de Barras </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="barCode" class="form-control" placeholder="Ingrese el Código de barras">
        </div>
        @error('barCode') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <label>Numero de Registro </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="Numero_registro" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('Numero_registro') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <label>Seleccione Sub-Categoría</label>
        <div class="form-group">
            <select wire:model='subCategoryId' class="form-control">
                <option value="Seleccionar" disabled>Seleccionar</option>
                @foreach($sub_categories as $SubCategory)
                <option value="{{$SubCategory->id}}">{{$SubCategory->name}}</option>
                @endforeach
            </select>
            @error('subCategoryId') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

</div>
@include('common.modalFooter')
