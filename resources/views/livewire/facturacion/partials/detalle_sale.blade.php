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

                    <div class="col-sm-12 col-md-4 mt-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp bg-dark">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="numero_factura" class="form-control"
                                placeholder="Numero de Factura Credito Fiscal">
                        </div>
                        @error('numero_factura') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                    @endif

                    @if($transaccionId === 1)

                    <div class="col-sm-12 col-md-4 mt-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp bg-dark">
                                    <i class="far fa-user"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="cliente_consumidor_final" class="form-control"
                                placeholder="Nombre Cliente">
                        </div>
                        @error('cliente_consumidor_final') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp bg-dark">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="direccion_consumidor_final" class="form-control"
                                placeholder="Direccion Cliente">
                        </div>
                        @error('direccion_consumidor_final') <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp bg-dark">
                                    <i class="far fa-address-card"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="dui_consumidor_final" class="form-control"
                                placeholder="DUI Cliente">
                        </div>
                        @error('dui_consumidor_final') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                    @if($facturas=== null)

                    <div class="col-sm-12 col-md-4 mt-2">
                        <a href="javascript:void(0)" class="tabmenu btn fondoNegro text-white btn-block" data-toggle="modal"
                            data-target="#theModalFacturas"><b>Agregar N° factura</b></a>
                    </div>
                    @else
                    <div class="col-sm-12 col-md-4 mt-2">
                        <h6 class="text-success"><b>N° Factura configurado: {{$facturas->numero_factura_inicial}}</b></h6>
                        <h6 class="text-success"><b>Siguiente N° Factura: {{$facturas->numero_factura_correlativo}}</b></h6>
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <a href="javascript:void(0)" class="tabmenu btn fondoNegro text-white btn-block" wire:click="changeFactura({{$facturas->id}})"><b>Cambiar N° factura</b></a>
                    </div>
                    @endif
                    @endif

                    <div class="col-sm-12 col-md-2 mt-2 d-flex">
                        <a class="btn fondoNegro text-white mbmobile mb-4 btn-block" id="btn-buscar"><b><i
                                    class="fas fa-search-plus"></i>
                                Buscar</b></a>
                    </div>

                    <div class="col-sm-12 col-md-2 mt-2 d-flex">
                        <a wire:click.prevent="resetUI()" class="btn btn-danger mbmobile mb-4 btn-block"
                            id="btn-regresar"><b><i class="fas fa-arrow-left"></i></b></a>
                    </div>



                </div>

                @if(count($cart)==0)
                <div class="alert alert-danger">No hay productos asociados al detalle de la factura</div>
                @else
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th width='20%' class="table-th text-center text-white">
                                    <div class="size">Acciones</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">Cant</div>
                                </th>
                                <th class="table-th text-white">
                                    <div class="size-product">Producto</div>
                                </th>
                                <th class="table-th text-center text-white">
                                    <div class="size">Precio U</div>
                                </th>
                                <th class="table-th text-white text-center">
                                    <div class="size">Total</div>
                                </th>
                                <th class="table-th text-white text-center">
                                    <div class="size">Lote</div>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-square text-success">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0)" wire:click="decreaseQty({{$item->id}})"
                                        title="Restar Producto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-minus-square text-danger">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>
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

                                    <a wire:ignore.self href="javascript:void(0)"
                                        wire:click.prevent="DescuentoProduct({{$item->id}})" title="Descuento">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign text-danger">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </a>

                                    <a wire:ignore.self href="javascript:void(0)"
                                        wire:click.prevent="restablecerPrecioVenta({{$item->id}})"
                                        title="Restablecer Precio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-refresh-ccw text-success">
                                            <polyline points="1 4 1 10 7 10"></polyline>
                                            <polyline points="23 20 23 14 17 14"></polyline>
                                            <path
                                                d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15">
                                            </path>
                                        </svg>
                                    </a>

                                    <a wire:ignore.self href="javascript:void(0)"
                                        wire:click.prevent="cambiarTipoPrecio({{$item->id}})"
                                        title="Cambiar Tipo de Precio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-bag text-success">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                    </a>

                                </td>
                                <td>
                                    <input type="number" id="r{{$item->id}}" min="1" pattern="^[0-9]+"
                                        wire:change="updateCant({{$item->id}},$('#r'+ {{$item->id}}).val(),{{$item->attributes[5]}})"
                                        class="form-control text-center" value="{{$item->quantity}}">
                                </td>
                                <td>
                                    <p>{{$item->name}} {{$item->attributes[6]}} - Lote: {{$item->attributes[3]}}</p>
                                </td>
                                <td class="text-center">
                                    ${{number_format($item->price,4)}}
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($item->price * $item->quantity,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$item->attributes[3]}}</p>
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
    @include('livewire.facturacion.partials.modal_edit_and_create_n_facturas')
</div>
