<div>
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="productos" wire:ignore.self>
            @include('livewire.kardex-productos.partials.list-products')
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="kardex" wire:ignore.self>
            @include('livewire.kardex-productos.partials.kardex')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#kardex').hide();

            $('#regresar').on("click", function () {
                $('#kardex').hide();
                $('#productos').show();
            });

            window.livewire.on('ver-kardex', msg=>{
                $('#kardex').show();
                $('#productos').hide();
            });
        });

       /* function Confirm(id){
            swal({
                title: 'Confirmar',
                text: '¿Confirmas Deshabilitar Producto?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'

            }).then(function(result){
               if (result.value) {
                window.livewire.emit('DeshabilitarProducto', id)
                swal.close() 
               } 
            })
        }*/
    </script>
</div>