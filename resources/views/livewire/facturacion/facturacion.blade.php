<div>
    <div class="row layout-top-spacing">
        
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing offset-lg-3 offset-md-3" id="menu" wire:ignore.self>
            <div class="widget widget-three">
                <div class="widget-heading">
                    <h5 class="text-center">Facturación</h5>

                </div>
                <div class="widget-content">
                    <div class="order-summary">

                        @foreach ($transacciones as $transaccion)
                        <div wire:click.prevent="validarTipoTransaccion({{$transaccion->id}})" class="btn btn-block summary-list {{$transaccion->tipo_transaccion == 'CONSUMIDOR FINAL' ? 'summary-income' : 'summary-profit'}}">
                            <div class="summery-info">
                                <div class="w-icon">
                                    @if ($transaccion->tipo_transaccion == 'CONSUMIDOR FINAL')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-briefcase">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                    @endif

                                </div>
                                <div class="w-summary-details">
                                    <div class="w-summary-info">
                                        <h6>{{$transaccion->tipo_transaccion}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- <div class="btn btn-block summary-list summary-profit">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-briefcase">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Credito Fiscal</h6>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="btn btn-block summary-list summary-expenses">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-gift">
                                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                        <rect x="2" y="7" width="20" height="5"></rect>
                                        <line x1="12" y1="22" x2="12" y2="7"></line>
                                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Promociones (En desarrollo)</h6>
                                    </div>

                                </div>

                            </div>

                        </div> -->

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="buscar" wire:ignore.self>
            @include('livewire.facturacion.partials.buscar_productos')
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="lote" wire:ignore.self>
            @include('livewire.facturacion.partials.seleccionar_lote_venta') 
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 layout-spacing" id="detalle" wire:ignore.self>
            @include('livewire.facturacion.partials.detalle_sale') 
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 layout-spacing" id="total" wire:ignore.self>
            @include('livewire.facturacion.partials.denomination') 
            @include('livewire.facturacion.partials.total') 
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="clientes" wire:ignore.self>
            @include('livewire.facturacion.partials.detalle_credito_fiscal') 
        </div>


    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#buscar').hide();
        $('#lote').hide();
        $('#detalle').hide();
        $('#total').hide();
        $('#clientes').hide();

       
        $('#btn-regresar').on("click", function () {
        $('#menu').show(); 
        $('#total').hide();
        $('#detalle').hide();
        $('#clientes').hide();
        });

        $('#btn-regresar2').on("click", function () {
        $('#total').show();
        $('#detalle').show();
        $('#buscar').hide();
        });

        $('#btn-regresar3').on("click", function () {
        $('#lote').hide();
        $('#buscar').show();
        });

        $('#btn-regresar4').on("click", function () {
        $('#clientes').hide();
        $('#menu').show();
        });

        

        $('#btn-buscar').on("click", function () {
        $('#total').hide();
        $('#detalle').hide();
        $('#buscar').show();
        });

        

        window.livewire.on('ver-lotes', msg=>{
            $('#buscar').hide();
            $('#lote').show();
        });

        window.livewire.on('facturacion', msg=>{
            $('#detalle').show();
            $('#total').show();
            $('#menu').hide();
            $('#clientes').hide();
        });

        window.livewire.on('credito-fiscal', msg=>{
            $('#menu').hide();
            $('#clientes').show();
        });

       

        window.livewire.on('no-stock', msg=>{
            swal({
               title: 'Error',
               text: msg,
               type: 'error',
           })
        });

        window.livewire.on('add-ok', msg=>{
            $('#detalle').show();
            $('#total').show();
            $('#lote').hide();
        });

        window.livewire.on('sale-ok', msg=>{
            swal({
               title: 'Facturado',
               text: msg,
               type: 'success',
           })
            $('#detalle').hide();
            $('#total').hide();
            $('#menu').show();
        });

        window.livewire.on('cliente-added', msg => {
            $('#theModal').modal('hide');
            swal({
                title: 'Agregado!',
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
