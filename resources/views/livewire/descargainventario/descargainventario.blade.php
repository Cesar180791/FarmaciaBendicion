<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12" id="listar-productos" wire:ignore.self>
            @include('livewire.descargainventario.partials.list_productos')
        </div>
        <div class="col-sm-12" id="detalle" wire:ignore.self>
            @include('livewire.descargainventario.partials.detalle_descarga')
        </div>
        <div class="col-sm-12" id="seleccionar_lote_descarga" wire:ignore.self>
            @include('livewire.descargainventario.partials.seleccionar_lote_descarga')
        </div>
    </div>

    <script src="{{ asset('js/keypress.js') }}"></script>
    @include('livewire.descargainventario.partials.shortcuts')
    <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#listar-productos').hide();
            $('#seleccionar_lote_descarga').hide();

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
                $('#seleccionar_lote_descarga').hide();
            });

            window.livewire.on('ver-lotes', msg => {
                $('#seleccionar_lote_descarga').show();
                $('#listar-productos').hide();
            });

            window.livewire.on('no-stock', msg => {
                swal({
                    title: 'Error',
                    text: msg,
                    type: 'error',
                })
            });

            window.livewire.on('sale-error', msg => {
                swal({
                    title: 'Error',
                    text: msg,
                    type: 'error',
                })
            });

            window.livewire.on('add-ok', msg => {
                $('#listar-productos').hide();
                $('#seleccionar_lote_descarga').hide();
                $('#detalle').show();
            });


        });

        function Confirm(id, eventName, text) {
            swal({
                title: 'Confirmar',
                text: text,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'

            }).then(function (result) {
                if (result.value) {
                    window.livewire.emit(eventName, id)
                    swal.close()
                }
            })
        }

    </script>
</div>
