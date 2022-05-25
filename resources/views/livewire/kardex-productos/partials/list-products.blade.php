<div class="row">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h6 class="card-title">
                    <b>Listado de Productos Registrados al Sistema</b>
                </h6>
            </div>
             @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white">N° Registro</th>
                                <th class="table-th text-white">Producto</th>
                                <th class="table-th text-white text-center">Lab</th>
                                <th class="table-th text-white text-center">Exist</th>
                                <th class="table-th text-white text-center">Costo</th>
                                <th class="table-th text-white text-center">Total C.</th>
                                <th class="table-th text-white text-center">Exist U.</th>
                                <th class="table-th text-white text-center">Costo U.</th>
                                <th class="table-th text-white text-center">Total U.</th>
                                <th class="table-th text-white text-center">Total INV.</th>
                                <th class="table-th text-white text-center">KARDEX</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->Numero_registro}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->laboratory}}</td>
                                <td class="text-center">{{$product->existencia_caja}}</td>
                                <td class="text-center">${{number_format($product->cost,4)}}</td>
                                <td class="text-center">${{number_format($product->cost * $product->existencia_caja,4)}}</td>
                                @if ($product->existencia_unidad != null)
                                <td class="text-center">{{$product->existencia_unidad}}</td>
                                <td class="text-center">${{number_format($product->cost / $product->unidades_presentacion,4)}}</td>
                                <td class="text-center">${{number_format(($product->cost / $product->unidades_presentacion) * $product->existencia_unidad,4)}}</td>
                                @else
                                <td class="text-center">N/A</td>
                                <td class="text-center">N/A</td>
                                <td class="text-center">N/A</td>
                                @endif
                                <td class="text-center"><span class="badge badge-primary">${{number_format(($product->cost * $product->existencia_caja) + (($product->cost / $product->unidades_presentacion) * $product->existencia_unidad),4)}}</span></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn fondoNegro" wire:click.prevent="verKardex({{$product->id}})" title="Generar KARDEX">
                                       <i class="fa-solid fa-list text-white"></i>
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
   <script>
    /*document.addEventListener('DOMContentLoaded', function(){
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
    }*/
</script>
</div>

