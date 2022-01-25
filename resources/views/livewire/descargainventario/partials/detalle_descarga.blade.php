<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle">
            <div class="card-body">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b class="sizeEncabezado">{{$componentName2}} | {{$pageTitle2}}</b>
                    </h6>
                </div>
                <a class="btn btn-dark mbmobile mb-4" id="buscarbtn"><b>Buscar F1</b></a>
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
                                <th class="table-th text-center text-white">
                                    <div class="size">Stok lote</div>
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
                                <td class="text-center">
                                    <p>{{$item->attributes[6]}}</p>
                                </td>
                                <td>
                                    <p>{{$item->name}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{number_format($item->attributes[0],4)}}</p>
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
                                <td class="text-center">
                                    <p>{{$item->attributes[3]}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$item->attributes[4]}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$item->attributes[5]}}</p>
                                </td>
                       
                                <td class="text-center">
                                    <p>{{$item->attributes[7]}}</p>
                                </td>
                                <td class="text-center">
                                    <p><b>{{$item->attributes[8]}}</b></p>
                                </td></tr>
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
                                <td colspan="2">
                                    <h6 class="text-center font-weight-bold">Total Descarga</h6>
                                </td>
                                <td>
                                    <h6 class="text-center">${{number_format($total,4)}}</h6>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-sm-12 col-md-12 mt-3">
                    <hr>
                    <h6>Descripcion de la Descarga</h6>
                    <hr>
                    <textarea name="descripcion_descarga" wire:model.lazy="descripcion_descarga" class="ckeditor form-control"
                        id="my-editor" cols="20" rows="5"></textarea>
                    @error('descripcion_descarga') <span class="text-danger er">{{ $message }}</span> @enderror
                    <hr>
                </div>

                <ul class="tabs tab-pills mt-3">
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" wire:click="EjecutarDescarga" class="float-right tabmenu btn btn-dark"
                            id=""><i class="far fa-save"></i><b> Guardar</b></a>
                    </li>
                </ul>
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
        width: 150px;
    }

    .size-product {
        width: 250px;
    }

</style>
