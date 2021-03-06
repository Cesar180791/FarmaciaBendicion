<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b>{{$componentName}}</b>
                    </h6>
                </div>
                <div class="widget-content">
                    <div class="form-inline">
                        <div class="form-group mr-5">
                            <select wire:model="role" class="form-control">
                                <option value="Seleccionar" selected>== Seleccione el Rol ==</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button wire:click.prevent="SyncAll()" type="button"
                            class="btn fondoNegro text-white mbmobile inblock mr-5"><b><i class="fas fa-check-circle"></i> Sincronizar Todos</b></button>
                        <button onclick="Revocar()" type="button" class="btn btn-warning mbmobile mr-5"><b><i class="fas fa-ban"></i> Revocar Todos</b>
                        </button>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-1">
                                    <thead class="text-white fondoNegro">
                                        <tr>
                                            <th class="table-th text-white text-center">ID</th>
                                            <th class="table-th text-white text-center">AUTORIZACIÓN</th>
                                            <th class="table-th text-white text-center">NOMBRE PERMISO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permisos as $permiso)
                                        <tr>
                                            <td class="text-center">{{$permiso->id}}</td>
                                            <td class="text-center">
                                                <div class="n-check">
                                                    <label class="new-control new-checkbox checkbox-primary">
                                                        <input type="checkbox"
                                                            wire:change="SyncPermiso($('#p' + {{$permiso->id }}).is(':checked'), '{{ $permiso->name }}')"
                                                            id="p{{ $permiso->id }}" value="{{$permiso->id}}"
                                                            class="new-control-input"
                                                            {{ $permiso->checked == 1 ? 'checked' : '' }}><br>
                                                        <span class="new-control-indicator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <P>{{$permiso->name}}</P>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$permisos->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('sync-error', msg => {
                swal({
                    title: 'Error',
                    text: msg,
                    type: 'error',
                })

            });

            window.livewire.on('permi', msg => {
                swal({
                    title: 'Exito',
                    text: msg,
                    type: 'success',
                })
            });
            window.livewire.on('sync-all', msg => {
                swal({
                    title: 'Exito',
                    text: msg,
                    type: 'success',
                })
            });
            window.livewire.on('remove-all', msg => {
                swal({
                    title: 'Exito',
                    text: msg,
                    type: 'success',
                })
            });
        });

        function Revocar() {
            swal({
                title: 'Confirmar',
                text: '¿Confirmas revocar todos los permisos?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'

            }).then(function (result) {
                if (result.value) {
                    window.livewire.emit('revokeall')
                }
            })
        }

    </script>
</div>
