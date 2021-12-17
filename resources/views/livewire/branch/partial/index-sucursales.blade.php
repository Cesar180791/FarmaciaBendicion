<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h4 class="card-title">
            <b style="font-size: 18px;">{{$ComponentName}} | {{$PageTitle}}</b>
        </h4>
        <ul class="tabs tab-pills">
            <li style="list-style: none;">
                <a class="tabmenu btn btn-dark btn-sm" id="nueva-sucursal"><i class="fas fa-store"></i> Crear</a>
            </li>
        </ul>
    </div>
    @include('common.searchbox')
    @if(count($sucursales)==0)
    <div class="alert alert-danger">No hay Registros que mostrar</div>
    @else
    <div class="widget-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="table-th text-white">Sucursal</th>
                        <th class="table-th text-white">Telefono</th>
                        <th class="table-th text-white">Direccion</th>
                        <th class="table-th text-white">Código</th>
                        <th class="table-th text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursales as $sucursal)
                    <tr>
                        <td>
                            <h6>{{$sucursal->nameShop}}</h6>
                        </td>
                        <td>
                            <h6>{{$sucursal->phoneShop}}</h6>
                        </td>
                        <td>
                            <h6>{{$sucursal->addressShop}}</h6>
                        </td>
                        <td>
                            <h6>{{$sucursal->codeShop}}</h6>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="viewSucursal({{$sucursal->id}})" class="mtmobile"
                                title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-eye text-primary"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                </path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                            <a href="javascript:void(0)" wire:click="editSucursal({{$sucursal->id}})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                            <a href="javascript:void(0)" onclick="Confirm('{{$sucursal->id}}')" class=""
                                title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$sucursales->links()}}
        </div>
    </div>
    @endif
</div>
