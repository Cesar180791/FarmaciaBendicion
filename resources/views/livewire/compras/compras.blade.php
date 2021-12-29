<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12" id="datos-generales" wire:ignore.self>
            @include('livewire.compras.partials.datos-generales-compras')
        </div>
        <div class="col-sm-12" id="detalle-compra" wire:ignore.self>
            @include('livewire.compras.partials.detalle_compra')
        </div>
        <div class="col-sm-12" id="listar-productos" wire:ignore.self>
            @include('livewire.compras.partials.list-productos')
        </div>
        <div class="col-sm-12" id="lotes" wire:ignore.self>
            @include('livewire.compras.partials.asignar_product_lote')
        </div>
    </div>
</div>

<link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#datos-generales').hide();
        $('#listar-productos').hide();
        $('#lotes').hide();
      
        $('#buscarbtn').on("click", function () {
        $('#detalle-compra').hide(); 
        $('#listar-productos').show();
        });

        $('#regresar').on("click", function () {
        $('#detalle-compra').show(); 
        $('#listar-productos').hide();
        });

        $('#regresar2').on("click", function () {
        $('#lotes').hide(); 
        $('#listar-productos').show();
        });

       
        window.livewire.on('ver-lotes', msg=>{
            $('#listar-productos').hide();
            $('#lotes').show();
        });

        window.livewire.on('add-ok', msg=>{
            $('#detalle-compra').show();
            $('#lotes').hide();
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
