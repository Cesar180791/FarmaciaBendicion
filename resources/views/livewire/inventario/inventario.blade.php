<div class="row sales layout-top-spacing">
    <div class="col-sm-12" id="ver-productos" wire:ignore.self>
        @include('livewire.inventario.partials.ver-inventario')
    </div>

    <div class="col-sm-12" id="ver-lotes" wire:ignore.self>
        @include('livewire.inventario.partials.ver-lotes')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#ver-lotes').hide();

            $('#regresar').on("click", function () {
                $('#ver-lotes').hide();
                $('#ver-productos').show();
                livewire.emit('updatingSearch2')
            });
           
            window.livewire.on('ver-lotes', msg => {
                $('#ver-lotes').show();
                $('#ver-productos').hide();
            });
        });
    </script>
</div>
