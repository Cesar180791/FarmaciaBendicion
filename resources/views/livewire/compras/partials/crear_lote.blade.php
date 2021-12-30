<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h4 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle3}} para {{$producto}}</b> 
        </h4>
    </div>

    <div class="widget-content">
        <div class="row">

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Creado por</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="far fa-user">
                               
                            </span>
                        </span>
                    </div>
                    <label type="text" class="form-control">{{auth()->user()->name}}
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Numero de lote</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-boxes">
                     
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="numero_lote" class="form-control" placeholder="Ingrese el numero de lote">
                </div>
                @error('numero_lote') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <div class="col-sm-12 col-md-4 mt-3">
                <label>Caducidad</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="far fa-calendar-check">
                              
                            </span>
                        </span>
                    </div>
                    <input type="date" wire:model.lazy="caducidad_lote" class="form-control" placeholder="Ingrese Nombre del rubro">
                </div>
                @error('caducidad_lote') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>

            <ul class="tabs tab-pills ml-auto mt-4 mr-3">
                <li style="list-style: none;">
                    <button type="button" id="regresar3" wire:click.prevent="resetUI()" class="btn btn-danger"><b><i class="fas fa-arrow-left"></i></b></button>
                    @if($loteId < 1)
                    <button type="button" wire:click.prevent="crearLote()" class="btn btn-dark">Guardar</button>
                    @else
                    <button type="button" wire:click.prevent="actualizarLote()" class="btn btn-dark">Actualizar</button>
                    @endif
                </li>
            </ul>

        </div>
    </div>

</div>
