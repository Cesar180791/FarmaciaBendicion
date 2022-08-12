<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h6 class="card-title">
            <b>{{$componentName}} | Ver Compras</b>
        </h6>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a href="javascript:void(0)" id="regresar5" class="tabmenu btn btn-danger text-white"><b><i
                            class="fas fa-arrow-left"></i></b></a>
            </li>
        </ul>
    </div>

    <!-----------Inicio Filtros ------------->
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="row">
                <div class="col-sm-12">
                    
                    <h6><b>Filtros</b></h6>
                </div>
                <div class="col-sm-12">
                    <h6>Selecciona Usuario</h6>
                    <div class="form-group">
                        <select wire:model="userId" class="form-control">
                            <option value="0">Todos</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h6>Fecha desde</h6>
                    <div class="form-group">
                        <input type="date" wire:model="dateFrom" class="form-control flatpickr"
                            placeholder="Click para seleccionar">
                    </div>
                </div>
                <div class="col-sm-12">
                    <h6>Fecha hasta</h6>
                    <div class="form-group">
                        <input type="date" wire:model="dateTo" class="form-control flatpickr"
                            placeholder="Click para seleccionar">
                    </div>
                </div>

            </div>
        </div>
        <!-----------Fin Filtros ------------->
        <div class="col-sm-12 col-md-9">
            <!-----------Inicio Compras ------------->
            @if(count($data)==0)
            <div class="alert alert-danger">No hay compras registradas</div>
            @else
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white fondoNegro">
                        <tr>
                            <th class="table-th text-white text-center">
                                FOLIO
                            </th>
                            <th class="table-th text-white text-center">
                                Fecha
                            </th>
                            <th class="table-th text-white text-center">
                                Total
                            </th>
                            <th class="table-th text-white text-center">
                                N° Item
                            </th>
                            <th class="table-th text-white text-center">
                                Factura
                            </th>
                            <th class="table-th text-white text-center">
                                Proveedor
                            </th>
                            <th class="table-th text-white text-center">
                                Usuario
                            </th>
                            <th width="15%" class="table-th text-white text-center">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $compra)
                        <tr>
                            <td class="text-center">
                                <p>{{$compra->compra_id}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{\Carbon\Carbon::parse($compra->created_at)->format('M d, Y h:i A')}}</p>
                            </td>
                            <td class="text-center">
                                <p>${{number_format($compra->total,4)}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{$compra->item}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{$compra->factura}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{$compra->nombre_proveedor}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{$compra->usuario}}</p>
                            </td>
                            <td class="text-center" width="50px">
                                <a href="javascript:void(0);" wire:click.prevent="getDetails({{$compra->compra_id}})" data-toggle="tooltip" data-placement="top" title="Agregar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-primary"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>        
                                </a>

                                <!--<a href="javascript:void(0);" wire:click.prevent="cargarCompra({{$compra->compra_id}})" data-toggle="tooltip" data-placement="top" title="Agregar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>        
                                </a>-->

                                <a onclick="Confirm('{{$compra->compra_id}}','deleteCompra', '¿Eliminar Compra? esta acción no tiene retorno')" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>        
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            {{$data->links()}}
            @endif
            <!-----------Fin Compras ------------->
        </div>
    </div>
</div>
