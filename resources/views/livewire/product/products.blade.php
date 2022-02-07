<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b style="font-size: 18px;">{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills"> 
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" class="tabmenu btn bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a> 
                    </li>
                </ul>
            </div>
             @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">N° Registro</th>
                                <th class="table-th text-white">Producto</th>
                                <th class="table-th text-white text-center">Componente</th>
                                <th class="table-th text-white text-center">S-Categoría</th>
                                <th class="table-th text-white text-center">Lab</th>
                                <th class="table-th text-white text-center">Costo</th>
                                <th class="table-th text-white text-center">Costo + IVA</th>
                                <th class="table-th text-white text-center">Precio</th>
                                <th class="table-th text-white text-center">P. Mayoreo</th>
                                <th class="table-th text-white text-center">P. Unidad</th>
                                <th class="table-th text-white text-center">Estado</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->Numero_registro}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->chemical_component}}</td>
                                <td>{{$product->sub_category}}</td>
                                <td>{{$product->laboratory}}</td>
                                <td class="text-center">${{number_format($product->cost,4)}} <br> IVA: <br> ${{number_format($product->iva_cost,4)}}</td>
                                <td class="text-center">${{number_format($product->final_cost,4)}}</td>
                                <td class="text-center">${{number_format($product->precio_caja,4)}}</td>
                                <td class="text-center">${{number_format($product->precio_mayoreo,4)}}</td>
                                @if ($product->precio_unidad != null)
                                <td class="text-center">${{number_format($product->precio_unidad,4)}}</td>
                                @else
                                <td class="text-center">N/A</td>
                                @endif
                                <td class="text-center"><span class="badge {{$product->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{$product->estado}}</span></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="mtmobile" wire:click.prevent="Edit({{$product->id}})" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a href="javascript:void(0)" class="mtmobile" wire:click.prevent="Active({{$product->id}})"  title="Activar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock text-success"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>
                                    </a>
                                    <a href="javascript:void(0)" class="mtmobile"  onclick="Confirm('{{$product->id}}')"  title="Deshabilitar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock text-danger"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
   @include('livewire.product.form')
   <script>
    document.addEventListener('DOMContentLoaded', function(){
         window.livewire.on('product-added', msg=>{
            $('#theModal').modal('hide');
        });
        window.livewire.on('producto-update', msg=>{
            $('#theModal').modal('hide');
            swal({
            title: 'Exito',
            text: msg,
            type: 'success',
        }) 
        });
         window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show');
        });
         window.livewire.on('modal-hide', msg=>{
            $('#theModal').modal('hide');
        });
         window.livewire.on('hidden.bs.modal', msg=>{
            $('.er').css('display','none')
        });

    });

    function Confirm(id){
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
    }
</script>
</div>

