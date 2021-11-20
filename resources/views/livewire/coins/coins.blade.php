<div>
    <div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b style="font-size: 18px;">{{$componentName}} | {{$PageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li  style="list-style: none;">
                        <a href="javascript:void(0)" class="tabmenu btn bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">Valor</th>
                                <th class="table-th text-white">Tipo</th>
                                <th class="table-th text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demonimations as $demonimation)
                            <tr>
                                <td><h6>{{$demonimation->value}}</h6></td>
                                <td><h6>{{$demonimation->type}}</h6></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$demonimations->links()}}
                </div>
            </div>
        </div>
    </div>
     @include('livewire.coins.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

    });
</script>
</div>
