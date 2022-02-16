@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Nombre del Producto</b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-notes-medical"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ingrese Nombre del producto">
        </div>
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Componente Quimico </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-vial"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="chemical_component" class="form-control"
                placeholder="Ingrese el Componente quimico">
        </div>
        @error('chemical_component') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Laboratorio </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-clinic-medical"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="laboratory" class="form-control"
                placeholder="Ingrese el laboratorio">
        </div>
        @error('laboratory') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Código de Barras </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-barcode"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="barCode" class="form-control" placeholder="Ingrese el Código de barras">
        </div>
        @error('barCode') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Numero de Registro </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="far fa-registered"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="Numero_registro" class="form-control"
                placeholder="Ingrese el Numero de Registro">
        </div>
        @error('Numero_registro') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Unidades Presentación </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-pills"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="unidades_presentacion" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('unidades_presentacion') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <p><b>Precio Costo (Sin IVA) </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="cost" class="form-control"
                placeholder="Ingrese el Código de barras">
        </div>
        @error('cost') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <p><b>IVA </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <label class="form-control">{{$iva_cost}}
        </div>
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <p><b>Costo + IVA </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <label class="form-control">{{$final_cost}}
        </div>
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <p><b>Precio Caja </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_caja" class="form-control"
                placeholder="Ingrese Precio caja">
        </div>
        @error('precio_caja') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-4 mt-3">
        <p><b>Precio Mayoreo </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_mayoreo" class="form-control"
                placeholder="Ingrese Precio Mayoreo">
        </div>
        @error('precio_mayoreo') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

<div class="col-sm-12 col-md-4 mt-3">
        <p><b>Precio Unidad </b><p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="precio_unidad" class="form-control"
                placeholder="Ingrese Precio Unidad">
        </div>
        @error('precio_unidad') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-12 mt-3">
        <p><b>Seleccione Sub-Categoría</b><p>
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
