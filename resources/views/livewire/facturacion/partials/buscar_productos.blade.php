<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h4 class="card-title">
            <b class="sizeEncabezado">{{$componentName}} | {{$pageTitle}}</b>
        </h4>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar" class="tabmenu btn btn-dark text-white"><b>Regresar</b></a>
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
                        <th class="table-th text-white text-center">Stock</th>
                        <th width="10%" class="table-th text-white text-center">Stock U</th>
                        <th class="table-th text-white">Producto</th>
                        <th class="table-th text-white text-center">Componente</th>
                        <th width="10%" class="table-th text-white text-center">Lab</th>
                        <th width="10%" class="table-th text-white text-center">Precio</th>
                        <th width="10%" class="table-th text-white text-center">P. Mayoreo</th>
                        <th width="10%" class="table-th text-white text-center">P. Unidad
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-center">
                            <p>{{$product->existencia_caja}}</p>
                        </td>
                        <td class="text-center">
                            @if ($product->precio_unidad != null)
                            <p>{{$product->existencia_unidad}}</p>
                            @else
                            <p>No se vende por unidad</p>
                            @endif
                           
                        </td>
                        <td>
                            <p>{{$product->name}}</p>
                        </td>
                        <td>
                            <p>{{$product->chemical_component}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$product->laboratory}}</p>
                        </td>
                        <td class="text-center">
                            <button wire:click.prevent="verLotes({{$product->id}},'CAJA o PRESENTACION PRINCIPAL')" class="btn btn-dark btn-block den">
                                ${{number_format($product->precio_caja,4)}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button wire:click.prevent="verLotes({{$product->id}},'MAYOREO')" class="btn btn-dark btn-block den">
                                ${{number_format($product->precio_mayoreo,4)}}
                            </button>
                        </td>
                        @if ($product->precio_unidad != null)
                        <td class="text-center">
                            <button wire:click.prevent="verLotes({{$product->id}},'UNIDAD')" class="btn btn-dark btn-block den">
                                ${{number_format($product->precio_unidad,4)}}
                            </button>
                        </td>
                        @else
                        <td class="text-center">
                            <p>Sin precio de unidad</p>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
    @endif
</div>
