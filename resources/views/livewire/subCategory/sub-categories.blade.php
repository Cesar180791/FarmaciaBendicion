<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h6 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h6>
                <ul class="tabs tab-pills">
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" class="tabmenu btn fondoNegro text-white" data-toggle="modal"
                            data-target="#theModal"><b>Agregar</b></a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1" id="table">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white">Sub Categoría</th>
                                <th class="table-th text-white text-center">Descripcion</th>
                                <th class="table-th text-white text-center">Categoría</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $subCategory)
                            <tr>
                                <td>{{$subCategory->name}}</td>
                                <td>{{$subCategory->description}}</td>
                                <td>{{$subCategory->category}}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" wire:click.prevent="Edit({{$subCategory->id}})"
                                        class="btn fondoNegro mtmobile text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger"
                                        onclick="Confirm('{{$subCategory->id}}','{{$subCategory->products->count()}}')"
                                        title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.subCategory.form')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('subCategory-added', msg => {
                $('#theModal').modal('hide');
            });
            window.livewire.on('subCategory-update', msg => {
                $('#theModal').modal('hide');
            });
            window.livewire.on('subCategory-deleted', msg => {
                //notificacion
            });
            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show');
            });
            window.livewire.on('modal-hide', msg => {
                $('#theModal').modal('hide');
            });
            window.livewire.on('hidden.bs.modal', msg => {
                $('.er').css('display', 'none')
            });
        });

        function Confirm(id, products) {
            if (products > 0) {
                swal({
                    type: 'error',
                    text: 'No se puede eliminar la Sub-Categoría por que tiene Productos asignados'
                })
                return;
            }
            swal({
                title: 'Confirmar',
                text: '¿Confirmas eliminar el registro?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'

            }).then(function (result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                    swal.close()
                }
            })
        }

    </script>
</div>
