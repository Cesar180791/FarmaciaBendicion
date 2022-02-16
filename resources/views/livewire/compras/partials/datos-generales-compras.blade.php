<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h6 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle}}</b> 
        </h6>
    </div>

    <div class="widget-content">
        <div class="row">

            <div class="col-sm-12 col-md-6 mt-3">
                <p><b>Proveedor</b></p>
                <div class="form-group">
                    <select wire:model='proveedores_id' class="form-control">
                        <option value="Seleccionar" disabled>Seleccionar</option>
                        @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->nombre_proveedor}}</option>
                        @endforeach
                    </select>
                    @error('proveedores_id') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mt-3">
                <p><b>Politica de Garantia</b></p>
                <div class="form-group">
                    <select wire:model='politicas_garantias_id' class="form-control">
                        <option value="Seleccionar" disabled>Seleccionar</option>
                        @foreach($politicas as $politica)
                        <option value="{{$politica->id}}">{{$politica->concepto}}</option>
                        @endforeach
                    </select>
                    @error('politicas_garantias_id') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mt-3">
                <p><b>Numero de factura </b></p>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp fondoNegro text-white">
                            <i class="fas fa-file-invoice"></i>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="factura" class="form-control"
                        placeholder="Ingrese el Código de barras">
                </div>
                @error('factura') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <div class="col-sm-12 col-md-6 mt-3">
                <p><b>Fecha de compra</b></p>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp fondoNegro text-white">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="date" wire:model.lazy="fecha_compra" class="form-control" placeholder="Ingrese Nombre del rubro">
                </div>
                @error('fecha_compra') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <div class="col-sm-12 col-md-12 mt-3">
                <p><b>Descripcion de la compra</b></p>
                <div class="input-group">
                    <textarea name="descripcion_lote" wire:model.lazy="descripcion_lote" class="ckeditor form-control"
                        id="my-editor" cols="20" rows="5"></textarea>
                </div>
                @error('descripcion_lote') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>
  
        </div>
        <ul class="tabs tab-pills mt-4 mr-3 d-flex">
            <li class="ml-auto" style="list-style: none;">
                <a href="javascript:void(0)" id="regresar4" class=" tabmenu btn btn-danger text-white mb-1" wire:ignore.self><b><i class="fas fa-arrow-left"></i> Atras</b></a>
                <a href="javascript:void(0)" class=" tabmenu btn btn-dark text-white mb-1" wire:click.prevent="validacionCabecera()"
                    wire:ignore.self><b>Guardar</b></a> 
            </li>
        </ul>
    </div>

</div>
