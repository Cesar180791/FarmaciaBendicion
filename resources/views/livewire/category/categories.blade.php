<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h6 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b> 
                </h6>
                <ul class="tabs tab-pills">
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" class="tabmenu btn fondoNegro text-white" data-toggle="modal" data-target="#theModal"><b>Agregar</b></a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white">Categoría</th>
                                <th class="table-th text-white text-center">Descripción</th>
                                <th class="table-th text-white text-center">Imagen</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/categorias/' . $category->imagen) }}" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" 
                                    wire:click="Edit({{$category->id}})"
                                    class="btn fondoNegro mtmobile" title="Edit">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    
                                    <a href="javascript:void(0)" 
                                    onclick="Confirm('{{$category->id}}', '{{$category->subCategories->count()}}')" 
                                    class="btn btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.category.form')


<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show');
        });
        window.livewire.on('category-added', msg=>{
            $('#theModal').modal('hide');
        });
        window.livewire.on('category-update', msg=>{
            $('#theModal').modal('hide');
        });
    });

    function Confirm(id, subCategories){
        if (subCategories >0){
            swal({
                type: 'error',
                 text: 'No se puede eliminar la categoría por que tiene Sub-Categorías asignadas'})
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

        }).then(function(result){
           if (result.value) {
            window.livewire.emit('deleteRow', id)
            swal.close() 
           } 
        })
    }
</script>
</div>