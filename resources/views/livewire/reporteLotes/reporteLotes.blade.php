<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-heading">
                    <h6 class="card-title text-center"><b>{{$componentName}}</b></h6>
                </div>
                <div class="widget-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            @include('livewire.reportelotes.partials.filtros')
                        </div>
                        <div class="col-sm-12 col-md-9">
                            @include('livewire.reportelotes.partials.lotes')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
