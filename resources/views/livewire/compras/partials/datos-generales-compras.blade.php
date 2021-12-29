<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h6 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle}}</b> 
        </h6>
    </div>

    <div class="widget-content">
        <div class="row">

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Proveedor</label>
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

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Numero de factura </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-file-invoice-dollar">
                                
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="factura" class="form-control"
                        placeholder="Ingrese el Código de barras">
                </div>
                @error('factura') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Fecha de compra</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="far fa-calendar-check">
                              
                            </span>
                        </span>
                    </div>
                    <input type="date" wire:model.lazy="fecha_compra" class="form-control" placeholder="Ingrese Nombre del rubro">
                </div>
                @error('fecha_compra') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <div class="col-sm-12 col-md-12 mt-3">
                <label>Descripcion de la compra</label>
                <div class="input-group">
                    <textarea name="descripcion_carga" wire:model.lazy="descripcion_carga" class="ckeditor form-control"
                        id="my-editor" cols="20" rows="5"></textarea>
                </div>
                @error('descripcion_carga') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>
  
        </div>
        <ul class="tabs tab-pills mt-4 mr-3 d-flex">
            <li class="ml-auto" style="list-style: none;">
                <a href="javascript:void(0)" class=" tabmenu btn btn-dark text-white mb-1" wire:click.prevent="validacionCampos()"
                    wire:ignore.self><b>Siguiente <i class="fas fa-arrow-right"></i></b></a> 
            </li>
        </ul>
    </div>

</div>
