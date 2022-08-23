@if(count($data)==0)
<div class="alert alert-danger">No hay Ventas registradas</div>
@else
<div class="table-responsive mt-4">
    <table class="table table-bordered table-striped mt-1">
        <thead class="text-white fondoNegro">
            <tr>
                <th class="table-th text-white text-center">
                    FOLIO
                </th>
                <th class="table-th text-white text-center">
                    Transacción
                </th>
                <th class="table-th text-white text-center">
                    N° Productos
                </th>
                <th class="table-th text-white text-center">
                    Total
                </th>
                <th class="table-th text-white text-center">
                    Recibido
                </th>
                <th class="table-th text-white text-center">
                    Cambio
                </th>
                <th class="table-th text-white text-center">
                    N° Factura
                </th>
                <th class="table-th text-white text-center">
                    Usuario
                </th>
                <th class="table-th text-white text-center">
                    Fecha
                </th>
                <th class="table-th text-white text-center" width="10%">Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $venta)
            <tr>
                <td class="text-center">
                    <p>{{$venta->folio}}</p>
                </td>
                <td class="text-center">
                    <p>{{$venta->tipo_transaccion}}</p>
                </td>
                <td class="text-center">
                    <p>{{$venta->items}}</p>
                </td>
                <td class="text-center">
                    <p>${{number_format($venta->total,4)}}</p>
                </td>
                <td class="text-center">
                    <p>${{number_format($venta->cash,4)}}</p>
                </td>
                <td class="text-center">
                    <p>${{number_format($venta->change,4)}}</p>
                </td>
                <td class="text-center">
                    <p>{{$venta->numero_factura}}</p>
                </td>
                <td class="text-center">
                    <p>{{$venta->usuario}}</p>
                </td>
                <td class="text-center">
                    <p>{{\Carbon\Carbon::parse($venta->created_at)->format('M d, Y h:i A')}}</p>
                </td>
                <td class="text-center" width="50px">
                    <button wire:click.prevent="getDetails({{$venta->folio}})"
                        class="btn fondoNegro text-white"><i class="fas fa-list"></i></button>
                    <button class="mt-2 btn fondoNegro text-white" href="javascript:void(0)" wire:click.prevent='$emit("print-factura-consumidor-final",{{$venta->folio}})'
                        title="Imprimir Factura">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
{{$data->links()}}
@endif
