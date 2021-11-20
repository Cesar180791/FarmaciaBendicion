<div>
  <div class="account-settings-container layout-top-spacing" wire:ignore.self>
    <div class="account-content">
      <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <form id="general-info" class="section general-info">
              <div class="info">
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
                          <input type="file" class="form-control-file" data-max-file-size="2M" wire:model="image"/>
                        </div>
                      </div>
                      <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                        <div class="form">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="fullName">Nombre actual de la Sucursal: {{$nameShop}}</label>
                                <input wire:model.lazy="nameNew" type="text" class="form-control mb-4" placeholder="Ejemplo: Sucursal Ciudad Toledo">
                                  @error('nameShop') <span class="text-danger er">{{ $message }}</span> @enderror
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="telefono">Telefono actual de la Sucursal es: {{$phoneShop}}</label>
                                <input wire:model.lazy="phoneNew" type="number" class="form-control mb-4" placeholder="Ejemplo: 2667-3030">
                                  @error('phoneShop') <span class="text-danger er">{{ $message }}</span> @enderror
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="direccion">Direccion actual: {{$addressShop}}</label>
                            <input wire:model.lazy="addressNew" type="text" class="form-control mb-4" placeholder="Ejemplo: Ciudad Toledo San Miguel">
                              @error('addressShop') <span class="text-danger er">{{ $message }}</span> @enderror
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
        <a href="{{ url('/lista-sucursales')}}" class="btn btn-warning"> <i class="fas fa-undo"></i> Regresar</a>
        <div class="blockui-growl-message">
          <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
        </div>
        <button id="multiple-messages" wire:click.prevent="update()" class="btn btn-primary"><i class="fas fa-pen"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    window.livewire.on('Sucursal-actualizada', msg=>{
      swal({
             title: 'Sucursal actualizada con Exito!',
             text: msg,
             type: 'success',
         })
    });
    window.livewire.on('No-Selected', msg=>{
      swal({
             title: 'Error',
             text: msg,
             type: 'warning',
         })
    });
});
</script>
