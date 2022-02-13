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
        <label>Unidades Presentación </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="number" wire:model.lazy="unidades_presentacion" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('unidades_presentacion') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <label>Precio Costo (Sin IVA) </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="number" wire:model.lazy="cost" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('cost') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <label>IVA </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <label class="form-control">{{$iva_cost}}
        </div>
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <label>Costo + IVA </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <label class="form-control">{{$final_cost}}
        </div>
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <label>Precio Caja </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_caja" class="form-control"
                placeholder="Ingrese Precio caja">
        </div>
        @error('precio_caja') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <label>Precio Mayoreo </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_mayoreo" class="form-control"
                placeholder="Ingrese Precio Mayoreo">
        </div>
        @error('precio_mayoreo') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

<div class="col-sm-12 col-md-4 mt-3">
        <label>Precio Unidad </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_unidad" class="form-control"
                placeholder="Ingrese Precio Unidad">
        </div>
        @error('precio_unidad') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-12 mt-3">
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
