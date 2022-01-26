<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b style="font-size: 18px;">{{$componentName}} | {{$pageTitle}}</b>

                    </h6>
                    <ul class="tabs tab-pills">
                        <li style="list-style: none;">
                            <a href="javascript:void(0)" class="tabmenu btn btn-dark" data-toggle="modal"
                                data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                </div>
                @include('common.searchbox')
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-white">Proveedor</th>
                                    <th class="table-th text-white">Vendedor</th>
                                    <th class="table-th text-white text-center">Telefono</th>
                                    <th class="table-th text-white text-center">NIT</th>
                                    <th class="table-th text-white text-center">NRC</th>
                                    <th class="table-th text-white text-center">GRAN CONTRIBUYENTE</th>
                                    <th class="table-th text-white text-center">ESTADO</th>
                                    <th class="table-th text-white text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Proveedores as $proveedor)
                                <tr>
                                    <td>
                                        {{$proveedor->nombre_proveedor}}
                                    </td>
                                    <td>
                                        {{$proveedor->nombre_vendedor}}
                                    </td>
                                    <td class="text-center">
                                        {{$proveedor->telefono}}
                                    </td>
                                    <td class="text-center">
                                        {{$proveedor->NIT}}
                                    </td>
                                    <td class="text-center">
                                        {{$proveedor->NRC}}
                                    </td>
                                    <td class="text-center">
                                        @if($proveedor->gran_con == 'SI')
                                        Si, es gran contribuyente
                                        @else
                                        No, es gran contribuyente
                                        @endif
                                    </td>
                                    <td class="text-center"><span
                                            class="badge {{$proveedor->estado_proveedor == 'ACTIVO' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{$proveedor->estado_proveedor}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click.prevent="Edit({{$proveedor->id}})"
                                            class="mtmobile" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0)" class="mtmobile"
                                            wire:click.prevent="Active({{$proveedor->id}})" title="Activar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-unlock text-success">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0)" class="mtmobile"
                                            onclick="Confirm('{{$proveedor->id}}', 'DeshabilitarProveedor', '¿Deshabilitar Proveedor?')"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-lock text-danger">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$Proveedores->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.proveedores.form')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('proveedor-added', msg => {
            $('#theModal').modal('hide');
            swal({
                title: 'Agregado!',
                text: msg,
                type: 'success',
            })
        });
        window.livewire.on('proveedor-update', msg => {
            $('#theModal').modal('hide');
            swal({
                title: 'Actualizado!',
                text: msg,
                type: 'success',
            })
        });
        window.livewire.on('category-delete', msg => {
            swal({
                title: 'Eliminado!',
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
