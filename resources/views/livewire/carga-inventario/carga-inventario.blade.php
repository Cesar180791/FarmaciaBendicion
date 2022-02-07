<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12" id="listar-productos" wire:ignore.self>
            @include('livewire.carga-inventario.partials.list-productos')
        </div>
        <div class="col-sm-12" id="detalle" wire:ignore.self>
            @include('livewire.carga-inventario.partials.detalle_carga')
        </div>
        <div class="col-sm-12" id="crear-lote" wire:ignore.self>
            @include('livewire.carga-inventario.partials.crear_lote')
        </div>
        <div class="col-sm-12" id="asignar-producto-lote" wire:ignore.self>
            @include('livewire.carga-inventario.partials.asignar_product_lote')
        </div>
    </div>
<script src="{{ asset('js/keypress.js') }}"></script>
@include('livewire.carga-inventario.partials.shortcuts')
@include('livewire.carga-inventario.partials.form')
<link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#listar-productos').hide();
        $('#asignar-producto-lote').hide();
        $('#crear-lote').hide();

        $('#buscarbtn').on("click", function () {
        $('#listar-productos').show();
        $('#detalle').hide();
        });

        $('#regresar').on("click", function () {
        $('#listar-productos').hide();
        $('#detalle').show();
        });

        $('#regresar2').on("click", function () {
        $('#listar-productos').show();
        $('#asignar-producto-lote').hide();
        });

        $('#regresar3').on("click", function () {
        $('#crear-lote').hide();
        $('#asignar-producto-lote').show();
        });

        
       

        window.livewire.on('editar-lote', msg=>{
            $('#crear-lote').show();
            $('#asignar-producto-lote').hide();
        });

        window.livewire.on('lote-actualizado', msg=>{
            $('#crear-lote').hide();
            $('#asignar-producto-lote').show();
        });

        window.livewire.on('ver-lotes', msg=>{
            $('#theModal').modal('hide');
            $('#detalle').hide();
            $('#listar-productos').hide();
            $('#asignar-producto-lote').show();
        });

        window.livewire.on('crear-lote', msg=>{
            $('#crear-lote').show();
            $('#asignar-producto-lote').hide();
        });

        window.livewire.on('lote-registrado', msg=>{
            $('#crear-lote').hide();
            $('#asignar-producto-lote').show();
        });

         window.livewire.on('empty-cost', msg=>{
            swal({
               title: 'Error',
               text: msg,
               type: 'error',
           })
        });

        window.livewire.on('add-ok', msg=>{
            $('#listar-productos').hide();
            $('#asignar-producto-lote').hide();
            $('#detalle').show();
        });

        window.livewire.on('product-added', msg=>{
            $('#listar-productos').hide();
            $('#asignar-producto-lote').hide();
            $('#detalle').show();
        });

    });
	  function Confirm(id, eventName, text){
        swal({
            title: 'Confirmar',
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'

        }).then(function(result){
           if (result.value) {
            window.livewire.emit(eventName, id)
            swal.close() 
           } 
        })
    }
</script>
</div>