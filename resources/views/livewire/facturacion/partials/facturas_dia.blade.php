<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle">
            <div class="card-body">
                <div class="widget-heading">
                    <h6 class="card-title">
                        <b class="sizeEncabezado">{{$componentName}} | Ventas fecha
                            {{\Carbon\Carbon::parse(now())->format('M d Y')}} | Usuario: {{auth()->user()->name}}</b>
                    </h6>
                    <div class="col-sm-12">
                        <a class="btn btn-danger mbmobile" id="btn-regresar-menu"><b><i
                                    class="fas fa-arrow-left"></i></b></a>
                    </div>
                </div>

                @if(count($data)==0)
                <div class="alert alert-danger">No hay Ventas registradas este Día para usuario:
                    {{auth()->user()->name}}</div>
                @else

                <div class="d-flex">
                    <h6 class="text-center text-success ml-auto"><b>Ventas del Día ${{number_format($data->sum('total'),4)}}</b></h6>
                </div>

               

                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-white text-center">ID</th>
                                <th class="table-th text-white text-center">Items</th>
                                <th class="table-th text-white text-center">Total</th>
                                <th class="table-th text-white text-center">Recibido</th>
                                <th class="table-th text-white text-center">Cambio</th>
                                <th class="table-th text-white text-center">Tipo</th>
                                <th class="table-th text-white text-center">N° Factura</th>
                                <th class="table-th text-white text-center">Fecha</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td class="text-center">
                                    <p>{{$d->id}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$d->items}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($d->total,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($d->cash,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>${{number_format($d->change,4)}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$d->tipo_transaccion}} <br> {{$d->cliente_consumidor_final}} <br>
                                        {{$d->direccion_consumidor_final}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$d->numero_factura}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{\Carbon\Carbon::parse($d->created_at)->format('M d, Y h:i A')}}</p>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                        wire:click.prevent='$emit("print-factura-consumidor-final",{{$d->id}})' 
                                        title="Imprimir Factura">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-file-text text-success">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0)" wire:click.prevent="verDetalle({{$d->id}})"
                                        title="Ver Detalle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-eye text-success">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td colspan="2"><h6 class="text-center"><b>Total de ventas Diarias</b></h6></td>
                            <td><h6 class="text-center">${{number_format($data->sum('total'),4)}}</h6></td>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
