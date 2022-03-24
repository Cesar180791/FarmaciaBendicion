<div class="table-responsive mt-4">
    <table class="table table-bordered table-striped mt-1">
        <thead class="text-white fondoNegro">
            <tr>
                <th class="table-th text-white text-center">
                    <div class="size">Caducidad</div>
                </th>
                <th class="table-th text-white">
                    <div class="size-product">Producto</div>
                </th>
                <th class="table-th text-white">
                    <div class="size">N° de lote</div>
                </th>
                <th class="table-th text-white">
                    <div class="size">N° de REGISTRO</div>
                </th>
                <th class="table-th text-white">
                    <div class="size">Laboratorio</div>
                </th>
                <th class="table-th text-white">
                    <div class="size-product">Componente</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Existencia</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Existencia U</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Costo</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">IVA</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">IVA + Costo</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size-product">Total (IVA + Costo X Existencia)</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Precio</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Precio Mayoreo</div>
                </th>
                <th class="table-th text-white text-center">
                    <div class="size">Precio Unitario</div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $lote)
            <tr>
                @if($lote->caducidad_lote < now()->toDateString())
                    <td class="text-center"><span class="badge badge-danger">
                            <p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}</p>
                        </span></td>
                    @endif
                    @if(\Carbon\Carbon::parse($lote->caducidad_lote)->subMonths(3) < now()->toDateString() &&
                        $lote->caducidad_lote > now()->toDateString())
                        <td class="text-center"><span class="badge badge-warning">
                                <p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}
                                </p>
                            </span></td>
                        @endif
                        @if(\Carbon\Carbon::parse($lote->caducidad_lote)->subMonths(3) > now()->toDateString())
                        <td class="text-center"><span class="badge badge-success">
                                <p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}
                                </p>
                            </span></td>
                        @endif
                        <td class="">
                            <p>{{$lote->name}}</p>
                        </td>
                        <td class="">
                            <p>{{$lote->numero_lote}}</p>
                        </td>
                        <td class="">
                            <p>{{$lote->Numero_registro}}</p>
                        </td>
                        <td class="">
                            <p>{{$lote->laboratory}}</p>
                        </td>
                        <td class="">
                            <p>{{$lote->chemical_component}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$lote->existencia_lote}}</p>
                        </td>
                        @if ($lote->existencia_lote_unidad === null)
                        <td class="text-center">
                            <p>N/A</p>
                        </td>
                        @else
                        <td class="text-center">
                            <p>{{$lote->existencia_lote_unidad}}</p>
                        </td>
                        @endif
                        <td class="text-center">
                            <p>${{number_format($lote->cost,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->iva_cost,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->final_cost,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->final_cost * $lote->existencia_lote,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->precio_caja,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->precio_mayoreo,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($lote->precio_unidad,4)}}</p>
                        </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$data->links()}}

<style>
    .size {
        width: 125px;
    }

    .size-product {
        width: 350px;
    }

</style>
