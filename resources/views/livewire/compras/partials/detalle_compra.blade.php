<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle"> 
            <div class="card-body">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle2}}</b>
                    </h6> 
                </div> 
                <a class="btn fondoNegro text-white mbmobile mb-4" id="buscarbtn"><b>Buscar F1</b></a>
                <a class="btn fondoNegro text-white mbmobile mb-4" data-toggle="modal" data-target="#theModal"><b>Nuevo Producto</b></a>
                @if(count($cart)==0)
                <div class="alert alert-danger">No hay productos agregados a la compra</div>
                @else
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
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
                                    <div class="size">Costo</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">C+IVA</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">C+IVA*CANT</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">Precio</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">P. MAYOREO</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">P. UNIDAD</div>
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
                                        wire:change="updateCant({{$item->id}}, $('#r'+ {{$item->id}}).val() )"
                                        class="form-control text-center" value="{{$item->quantity}}">
                                </td>
                                <td>
                                    <p>{{$item->name}}</p>
                                </td>
                                <td>
                                    <input type="number" id="c{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updateCost({{$item->id}}, $('#c'+ {{$item->id}}).val() )"
                                        class="form-control text-center"
                                        value="{{number_format($item->attributes[0],4)}}">
                                </td>
                                <td class="text-center">
                                    <p>
                                        ${{number_format($item->attributes[2],4)}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p>
                                        ${{number_format($item->attributes[2] * $item->quantity,4)}}
                                    </p>
                                </td>
                                <td>
                                    <input type="number" id="p{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updatePrice({{$item->id}}, $('#p'+ {{$item->id}}).val() )"
                                        class="form-control text-center" value="{{$item->attributes[3]}}">
                                </td>
                                <td>
                                    <input type="number" id="m{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updateMayoreo({{$item->id}}, $('#m'+ {{$item->id}}).val() )"
                                        class="form-control text-center" value="{{$item->attributes[4]}}">
                                </td>
                                <td>
                                    <input type="number" id="u{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updateUnidad({{$item->id}}, $('#u'+ {{$item->id}}).val() )"
                                        class="form-control text-center" value="{{$item->attributes[5]}}">
                                </td>
                       
                                <td class="text-center">
                                    <p>{{$item->attributes[6]}}</p>
                                </td>
                                <td class="text-center">
                                    <p><b>{{$item->attributes[7]}}</b></p>
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
                                    <h6 class="text-center font-weight-bold">Total Compra</h6>
                                </td>
                                <td>
                                    <h6 class="text-center">${{number_format($total,2)}}</h6>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <ul class="tabs tab-pills mt-3">
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" wire:click="validarCampos" class="float-right tabmenu btn fondoNegro text-white"
                            id=""><b>Siguiente <i class="fas fa-arrow-right"></i></b></a>
                    </li>
                </ul>
                @endif
                <div wire:loading.inline wire:target="validarCampos">
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
        width: 150px;
    }

    .size-product {
        width: 250px;
    }

</style>
