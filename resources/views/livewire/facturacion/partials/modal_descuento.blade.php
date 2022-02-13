<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">

            <div class="widget-heading">
                <h6 class="card-title">
                    <b> {{$componentName}} | Descuento para {{$producto}}</b>
                </h6>
                <ul class="tabs tab-pills ml-auto">
                    <li style="list-style: none;">
                        <a href="javascript:void(0)" class="tabmenu btn btn-dark text-white mb-1" id="cerrar-descuento"
                            wire:ignore.self><b><i class="fas fa-arrow-left"></i></b></a>
                    </li>
                </ul>
            </div>

            <div class="row">

                <div class="col-sm-3 col-md-12 mt-3">
                    <label>Producto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp bg-dark">
                                <i class="fas fa-prescription-bottle-alt"></i>
                            </span>
                        </div>
                        <label class="form-control">{{$producto}}
                    </div>
                </div>

                <div class="col-sm-3 col-md-6 mt-3">
                    <label>Lote</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp bg-dark">
                                <i class="fas fa-truck-loading"></i>
                            </span>
                        </div>
                        <label class="form-control">{{$lote}}
                    </div>
                </div>

                <div class="col-sm-3 col-md-6 mt-3">
                    <label>Tipo de precio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp bg-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                        <label class="form-control">{{$tipoPrecio}}
                    </div>
                </div>

                <div class="col-sm-3 col-md-6 mt-3">
                    <label>Precio a Facturar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp bg-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                        <label class="form-control">{{number_format($precio,2)}}
                    </div>
                </div>

                <div class="col-sm-3 col-md-6 mt-3">
                    <label>Descuento (No Porcentaje)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp bg-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>

                        <input type="number" id="d{{$id_lote}}" min="1" pattern="^[0-9]+"
                            wire:change="aplicarDescuento({{$id_lote}},$('#d'+ {{$id_lote}}).val())"
                            class="form-control" value="{{$descuento}}">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
