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
                    <hr>
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
                            <th class="table-th text-white text-center">
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
                                <button wire:click.prevent="getDetails({{$compra->compra_id}})"
                                    class="btn fondoNegro text-white btn-sm"><i class="fas fa-list"></i></button>
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
