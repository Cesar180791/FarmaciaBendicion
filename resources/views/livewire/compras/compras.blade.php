<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12" id="datos-generales" wire:ignore.self>
            @include('livewire.compras.partials.datos-generales-compras')
        </div>
        <div class="col-sm-12 col-md-8" id="detalle-compra" wire:ignore.self>
            @include('livewire.compras.partials.detalle_compra')
        </div>
        <div class="col-sm-12 col-md-4" id="garantias" wire:ignore.self>
            @include('livewire.compras.partials.cuadro_garantias')
        </div>
        <div class="col-sm-12" id="listar-productos" wire:ignore.self>
            @include('livewire.compras.partials.list-productos')
        </div>
        <div class="col-sm-12" id="lotes" wire:ignore.self>
            @include('livewire.compras.partials.asignar_product_lote')
        </div>
        <div class="col-sm-12" id="nuevo-lote" wire:ignore.self>
            @include('livewire.compras.partials.crear_lote')
        </div>
    </div>
<script src="{{ asset('js/keypress.js') }}"></script>
@include('livewire.compras.partials.shortcuts')
@include('livewire.compras.partials.form')
<link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#datos-generales').hide();
        $('#listar-productos').hide();
        $('#nuevo-lote').hide();
        $('#lotes').hide();
      
        $('#buscarbtn').on("click", function () {
        $('#detalle-compra').hide(); 
        $('#listar-productos').show();
        $('#garantias').hide();
        });

        $('#regresar').on("click", function () {
        $('#detalle-compra').show(); 
        $('#listar-productos').hide();
        $('#garantias').show();
        });

        $('#regresar2').on("click", function () {
        $('#lotes').hide(); 
        $('#listar-productos').show();
        });

        $('#regresar3').on("click", function () {
        $('#lotes').show(); 
        $('#nuevo-lote').hide();
        });

        $('#regresar4').on("click", function () {
        $('#datos-generales').hide();
        $('#detalle-compra').show();
        $('#garantias').show();
        });

       
        window.livewire.on('ver-lotes', msg=>{
            $('#theModal').modal('hide');
            $('#detalle-compra').hide();
            $('#listar-productos').hide();
            $('#lotes').show();
        });

        window.livewire.on('crear-lote', msg=>{
            $('#nuevo-lote').show();
            $('#lotes').hide();
        });

        window.livewire.on('editar-lote', msg=>{
            $('#nuevo-lote').show();
            $('#lotes').hide();
        });


        window.livewire.on('lote-registrado', msg=>{
            $('#lotes').show(); 
            $('#nuevo-lote').hide();
        });

        window.livewire.on('add-ok', msg=>{
            $('#detalle-compra').show();
            $('#lotes').hide();
            $('#garantias').show();
        });

        window.livewire.on('lote-actualizado', msg=>{
            $('#nuevo-lote').hide();
            $('#lotes').show();
        });

        window.livewire.on('empty-cost', msg=>{
            swal({
               title: 'Error',
               text: msg,
               type: 'error',
           })
        });

        window.livewire.on('validacion-detalle-ok', msg=>{
            $('#datos-generales').show();
            $('#detalle-compra').hide();
            $('#garantias').hide();
        });

        window.livewire.on('politica-garantia', msg=>{
            swal({
               title: 'Politica de garantia',
               text: msg,
               type: 'warning',
           })
        });

        

        window.livewire.on('compra-ok', msg=>{
            $('#datos-generales').hide();
            $('#detalle-compra').show();
            $('#garantias').show();
            swal({
               title: 'Compra Registrada',
               text: msg,
               type: 'success',
           })
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
