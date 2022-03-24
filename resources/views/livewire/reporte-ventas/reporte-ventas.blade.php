<div>
    <div class="row sales">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-heading">
                    <h6 class="card-title text-center"><b>{{$componentName}}</b></h6>
                </div>
                <div class="widget-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            @include('livewire.reporte-ventas.partials.filtros')
                        </div>
                        <div class="col-sm-12 col-md-9">
                            @include('livewire.reporte-ventas.partials.tabla')
                        </div>
                    </div>
                </div>
            </div>
            @include('livewire.reporte-ventas.partials.modal-detalle')
        </div>
    </div>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('show-modal', msg => {
                $('#theModalDetalle').modal('show');
            });
        });
    </script>
</div>
