<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="card-title">
                        <b style="font-size: 18px;">{{$componentName}} | {{$pageTitle5}}</b>

                    </h4>
                    <ul class="tabs tab-pills">
                        <li style="list-style: none;">
                            <a href="javascript:void(0)" class="tabmenu btn btn-dark" id="btn-regresar4">Atras</a>
                            <a href="javascript:void(0)" class="tabmenu btn btn-dark" data-toggle="modal"
                                data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp bg-dark">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" wire:model="search2" placeholder="Buscar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-white">Cliente</th>
                                    <th class="table-th text-white text-center">Telefono</th>
                                    <th class="table-th text-white text-center">NIT</th>
                                    <th class="table-th text-white text-center">NRC</th>
                                    <th class="table-th text-white text-center">GRAN CONTRIBUYENTE</th>
                                    <th class="table-th text-white text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Clientes as $cliente)
                                <tr>
                                    <td>
                                        {{$cliente->nombre_cliente}}
                                    </td>
                                    <td class="text-center">
                                        {{$cliente->telefono}}
                                    </td>
                                    <td class="text-center">
                                        {{$cliente->NIT_cliente}}
                                    </td>
                                    <td class="text-center">
                                        {{$cliente->NRC_cliente}}
                                    </td>
                                    <td class="text-center">
                                        @if($cliente->gran_con_cliente == 'SI')
                                        Si, es gran contribuyente
                                        @else
                                        No, es gran contribuyente
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="mtmobile btn btn-dark"
                                            wire:click.prevent="ClienteCreditoFiscal({{$cliente->id}})" title="Activar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$Clientes->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.facturacion.partials.form_new_cliente')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('cliente-added', msg => {
            $('#theModal').modal('hide');
            swal({
                title: 'Agregado!',
                text: msg,
                type: 'success',
            })
        });
        window.livewire.on('cliente-update', msg => {
            $('#theModal').modal('hide');
            swal({
                title: 'Actualizado!',
                text: msg,
                type: 'success',
            })
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

    /*function Confirm(id){
         swal({ 
             title: 'Confirmar',
             text: '¿Confirmas eliminar el registro?',
             type: 'warning',
             showCancelButton: true,
             cancelButtonText: 'Cerrar',
             cancelButtonColor: '#fff',
             confirmButtonColor: '#3B3F5C',
             confirmButtonText: 'Aceptar'
 
         }).then(function(result){
            if (result.value) {
             window.livewire.emit('deleteRow', id)
             swal.close() 
            } 
         })
     }*/

</script>
