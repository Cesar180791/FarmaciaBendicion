<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12 col-md-12" id="listar-sucursales" wire:ignore.self>
           @include('livewire.branch.partial.index-sucursales')
        </div>
        <div class="col-sm-12 col-md-12" id="ver-sucursal" wire:ignore.self>
            @include('livewire.branch.partial.ver-sucursal')
         </div>
        <div class="col-sm-12 col-md-12" id="crear-sucursal" wire:ignore.self>
            @include('livewire.branch.partial.crear-sucursal')
         </div>
        <div class="col-sm-12 col-md-12" id="editar-sucursal" wire:ignore.self>
           
        </div>
    </div>
</div>
<link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/sucursales/listar_sucursales.js') }}"></script> 


