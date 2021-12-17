<div class="account-settings-container layout-top-spacing" wire:ignore.self>
    <div class="account-content">
        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="general-info" class="section general-info">
                        <div class="info">
                            <a href="javascript:void(0)" wire:click="resetUI()" class="float-right tabmenu btn btn-danger btn-sm text-white"
                                id="regresar"><b> Cerrar</b></a>
                            <h6 class="">informacion general de la Sucursal</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                            <div class="upload mt-4 pr-md-4">
                                                @if ($image)
                                                <img style="height: 150; width: 150px;" src="{{$image->temporaryUrl()}}"
                                                    class="img img-responsive mb-2">
                                                @endif
                                                <input type="file" class="form-control-file" data-max-file-size="2M"
                                                    wire:model="image" />
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Nombre de la Sucursal</label>
                                                            <input wire:model.lazy="nameShop" type="text"
                                                                class="form-control mb-4"
                                                                placeholder="Ejemplo: Sucursal Ciudad Toledo">
                                                            @error('nameShop') <span
                                                                class="text-danger er">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="telefono">Telefono de la Sucursal</label>
                                                            <input wire:model.lazy="phoneShop" type="number"
                                                                class="form-control mb-4"
                                                                placeholder="Ejemplo: 2667-3030">
                                                            @error('phoneShop') <span
                                                                class="text-danger er">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="direccion">Direccion</label>
                                                    <input wire:model.lazy="addressShop" type="text"
                                                        class="form-control mb-4"
                                                        placeholder="Ejemplo: Ciudad Toledo San Miguel">
                                                    @error('addressShop') <span
                                                        class="text-danger er">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="account-settings-footer">
        <div class="as-footer-container">
            @if($selected_id < 1) 
            <button id="multiple-reset" wire:click.prevent="resetUI()" class="btn btn-warning"><i class="fas fa-snowplow"></i> limpiar</button>
            <button id="multiple-messages" wire:click.prevent="Store()" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
            @else
            <button id="multiple-messages" wire:click.prevent="update()" class="btn btn-primary ml-auto"><i class="fas fa-pen"></i> Actualizar</button>
            @endif
        </div>
    </div>
</div>
