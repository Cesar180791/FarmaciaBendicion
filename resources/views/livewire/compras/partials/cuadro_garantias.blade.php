<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle"> 
            <div class="card-body">
                <div class="widget-heading">
                    <h6 class="card-title text-center">
                        <b>Tabla Referencial Politicas de Devolución a Proveedores</b>
                    </h6> 
                </div> 
                @if(count($politicas)==0)
                <div class="alert alert-danger">No hay politicas agregados a la compra</div>
                @else
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mt-1"> 
                        <thead class="text-white fondoNegro">
                            <tr>
                                <th class="table-th text-center text-white">Meses</th>
                                <th class="text-white">Concepto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($politicas as $politica)
                            <tr>
                                <td class="text-center"><span class="badge badge-success d-block">{{$politica->meses}}</span></td>
                                <td class="text-justify">{{$politica->concepto}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <!--<a class="btn fondoNegro text-white mbmobile" data-toggle="modal" data-target="#theModal"><b>Nuevo Producto</b></a>-->
            </div>
        </div>
    </div>
</div>