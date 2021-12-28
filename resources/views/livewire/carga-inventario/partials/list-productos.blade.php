<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h4 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle}}</b>
        </h4>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar" class="tabmenu btn btn-danger text-white"><b><i class="fas fa-arrow-left"></i></b></a>
            </li>
        </ul>
    </div>
    @include('common.searchbox')
    @if(count($products)==0)
    <div class="alert alert-danger">No hay Registros que mostrar</div>
    @else
    <div class="widget-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="table-th text-white">N° Registro</th>
                        <th width="50%" class="table-th text-white">Producto</th>
                        <th class="table-th text-white text-center">Componente</th>
                        <th class="table-th text-white text-center">S-Categoría</th>
                        <th class="table-th text-white text-center">Lab</th>
                        <th class="table-th text-white text-center">Costo</th>
                        <th class="table-th text-white text-center">Costo + IVA</th>
                        <th class="table-th text-white text-center">P.Venta</th>
                        <th class="table-th text-white text-center">P.Venta + IVA</th>
                        <th class="table-th text-white text-center">Estado</th>
                        <th class="table-th text-white text-center">Existencias</th>
                        <th class="table-th"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->Numero_registro}}
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->chemical_component}}
                        </td>
                        <td>
                            {{$product->sub_category}}
                        </td>
                        <td>
                            {{$product->laboratory}}
                        </td>
                        <td class="text-center">
                            ${{number_format($product->cost,4)}} <br> IVA:
                                ${{number_format($product->iva_cost,4)}}
                        </td>
                        <td class="text-center">
                            ${{number_format($product->final_cost,4)}}
                        </td>
                        <td class="text-center">
                            ${{number_format($product->price,4)}} <br> IVA:
                                ${{number_format($product->iva_price,4)}}
                        </td>
                        <td class="text-center">
                            ${{number_format($product->final_price,4)}}
                        </td>
                        <td class="text-center"><span
                                class="badge {{$product->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{$product->estado}}</span>
                        </td>
                        <td class="text-center">
                            {{$product->existencia}}
                        </td>
                        <td class="">
                            <ul class="table-controls">
                                <li style="list-style: none;"> 
                                    <a href="javascript:void(0);"
                                        wire:click.prevent="asignarIdBusquedaProducto({{$product->id}})"
                                        data-toggle="tooltip" data-placement="top" title="Agregar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-circle text-primary">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
    @endif
</div>
