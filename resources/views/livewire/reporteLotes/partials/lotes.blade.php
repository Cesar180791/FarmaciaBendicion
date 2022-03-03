<div class="table-responsive mt-4">
    <table class="table table-bordered table-striped mt-1">
        <thead class="text-white fondoNegro">
            <tr>
                <th class="table-th text-white">N° de lote</th>
                <th class="table-th text-white">Producto</th>
                <th class="table-th text-white">Laboratorio</th>
                <th class="table-th text-white">Componente</th>
                <th class="table-th text-white text-center">Existencia</th>
                <th class="table-th text-white text-center">Existencia U</th>
                <th class="table-th text-white text-center">Caducidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $lote)
            <tr>
                <td class=""><p>{{$lote->numero_lote}}</p></td>
                <td class=""><p>{{$lote->name}}</p></td>
                <td class=""><p>{{$lote->laboratory}}</p></td>
                <td class=""><p>{{$lote->chemical_component}}</p></td>
                <td class="text-center"><p>{{$lote->existencia_lote}}</p></td>
                @if ($lote->existencia_lote_unidad === null)
                <td class="text-center"><p>N/A</p></td>
                @else
                <td class="text-center"><p>{{$lote->existencia_lote_unidad}}</p></td>
                @endif
                @if($lote->caducidad_lote < now()->toDateString())
                <td class="text-center"><span class="badge badge-danger"><p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}</p></span></td>
                @endif
                @if(\Carbon\Carbon::parse($lote->caducidad_lote)->subMonths(3) < now()->toDateString() && $lote->caducidad_lote > now()->toDateString())
                <td class="text-center"><span class="badge badge-warning"><p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}</p></span></td>
                @endif
                @if(\Carbon\Carbon::parse($lote->caducidad_lote)->subMonths(3) > now()->toDateString())
                <td class="text-center"><span class="badge badge-success"><p class="text-white">{{\Carbon\Carbon::parse($lote->caducidad_lote)->format('M d, Y')}}</p></span></td>
                @endif
              
               
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$data->links()}}
</div>