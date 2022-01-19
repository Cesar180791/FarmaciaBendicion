<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle">
            <div class="card-body">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle2}}</b>
                    </h6>
                </div>
                <div class="d-flex row">
                    @if($transaccionId === 2)
                    <div class="col-sm-3 col-md-6">
                        <input type="text" wire:model.lazy="numero_factura" class="form-control input-sm" placeholder="Ingresa Numero de Factura">
                        @error('numero_factura') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                    @endif
                    <div col-sm-9 class="ml-auto">
                        <a class="btn btn-dark mbmobile mb-4 ml-auto" id="btn-regresar"><b>Atras</b></a>
                    <a class="btn btn-dark mbmobile mb-4 ml-2" id="btn-buscar"><b>Buscar F1</b></a>
                    </div>

                    
                </div>

                @if(count($cart)==0)
                <div class="alert alert-danger">No hay Registros que mostrar</div> 
                @else
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-center text-white">
                                    <div class="size">Acciones</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">Cant</div>
                                </th>
                                <th class="table-th text-white">
                                    <div class="size-product">Producto</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">Precio</div>
                                </th>
                                <th class="table-th text-white text-center">
                                    <div class="size">Lote</div>
                                </th>
                                <th class="table-th text-white text-center">
                                    <div class="size">Vencimiento</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td class="text-center">
                                
                                    <a href="javascript:void(0)"
                                       wire:click.prevent="increaseQty({{$item->attributes[5]}},{{$item->id}})"
                                        title="Agregar Producto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square text-success"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                    </a>

                                    <a href="javascript:void(0)"
                                       wire:click.prevent="decreaseQty({{$item->id}})"
                                        title="Restar Producto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square text-danger"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                    </a>

                                     <a href="javascript:void(0)"
                                        onclick="Confirm('{{$item->id}}', 'removeItem', '¿Eliminar el Producto?')"
                                        title="Quitar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trash-2 text-danger">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>

                                </td>
                                <td>
                                    <input type="number" id="r{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updateCant({{$item->id}},$('#r'+ {{$item->id}}).val(),{{$item->attributes[5]}})"
                                        class="form-control text-center" value="{{$item->quantity}}">
                                </td>
                                <td>
                                    <p>{{$item->name}} {{$item->attributes[6]}}</p>
                                </td>
                                <td class="text-center">
                                    ${{number_format($item->price,4)}}
                                </td>
                                <td class="text-center">
                                    <p>{{$item->attributes[3]}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$item->attributes[4]}}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1">
                                    <h6 class="text-center font-weight-bold">Articulos</h6>
                                </td>
                                <td>
                                    <h6 class="text-center">{{$itemsQuantity}}</h6>
                                </td>
                                <td>
                                    <h6 class="text-center font-weight-bold">Total Venta</h6>
                                </td>
                                <td>
                                    <h6 class="text-center">${{number_format($total,4)}}</h6>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
                <div wire:loading.inline wire:target="EjecutarDescarga">
                    <h6 class="text-danger text-center">Actualizando inventario...</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .my-custom-scrollbar {
        position: relative;
        height: auto;
        width: auto;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .size {
        width: 100px;
    }

    .size-product {
        width: 250px;
    }

</style>