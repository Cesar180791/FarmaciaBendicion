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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#datos-generales').hide();
        $('#listar-productos').hide();
      
        $('#buscarbtn').on("click", function () {
        $('#detalle-compra').hide(); 
        $('#listar-productos').show();
        });

        $('#regresar').on("click", function () {
        $('#detalle-compra').show(); 
        $('#listar-productos').hide();
        });

       
        window.livewire.on('validacion-ok', msg=>{
            $('#seleccionar_lote_descarga').show();
            $('#listar-productos').hide();
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
