<div class="col-sm-12">
    <div class="widget widget-chart-one">
        <div class="widget-heading">
            <h6 class="card-title">
                <b style="font-size: 18px;">{{$componentName}} | {{$pageTitle}}</b>
            </h6>
        </div>
        @include('common.searchbox')
        <div class="widget-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white fondoNegro">
                        <tr>
                            <th class="table-th text-white">N° Registro</th>
                            <th class="table-th text-white">Producto</th>
                            <th class="table-th text-white text-center">Lab</th>
                            <th class="table-th text-white text-center">Precio</th>
                            <th class="table-th text-white text-center">P. Mayoreo</th>
                            <th class="table-th text-white text-center">P. Unidad</th>
                            <th class="table-th text-white text-center">Stock.</th>
                            <th class="table-th text-white text-center">Stock. U</th>
                            <th class="table-th text-white text-center">Ver lotes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->Numero_registro}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->laboratory}}</td>
                            <td class="text-center">${{number_format($product->precio_caja,4)}}</td>
                            <td class="text-center">${{number_format($product->precio_mayoreo,4)}}</td>
                            @if ($product->precio_unidad != null)
                            <td class="text-center">${{number_format($product->precio_unidad,4)}}</td>
                            @else
                            <td class="text-center">N/A</td>
                            @endif
                            <td class="text-center">
                                <p>{{$product->existencia_caja}}</p>
                            </td>
                            <td class="text-center">
                                @if ($product->precio_unidad != null)
                                <p>{{$product->existencia_unidad}}</p>
                                @else
                                <p>N/A</p>
                                @endif

                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" class="mtmobile"
                                    wire:click.prevent="FiltrarID({{$product->id}})" title="Ver Lotes">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-primary">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
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