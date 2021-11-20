<div>
  <div class="row sales layout-top-spacing">
      <div class="col-sm-12">
          <div class="widget widget-chart-one">
              <div class="widget-heading">
                  <h4 class="card-title">
                      <b style="font-size: 18px;">{{$ComponentName}} | {{$PageTitle}}</b>
                  </h4>
                  <ul class="tabs tab-pills">
                      <li style="list-style: none;">
                          <a href="{{ url('/crear-sucursal')}}" class="tabmenu btn btn-success"><i class="fas fa-store"></i> Nueva Sucursal</a>
                      </li>
                  </ul>
              </div>
              @include('common.searchbox')
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
                                  <td><h6>{{$sucursal->nameShop}}</h6></td>
                                  <td><h6>{{$sucursal->phoneShop}}</h6></td>
                                  <td><h6>{{$sucursal->addressShop}}</h6></td>
                                  <td><h6>{{$sucursal->codeShop}}</h6></td>
                                  <td class="text-center">
                                    <a href="{{ url('/ver-sucursal/'.$sucursal->id)}}"  class="btn btn-success mtmobile" title="View">
                                      <i class="far fa-eye"></i>
                                    </a>
                                      <a  href="{{ url('editar-sucursal/'.$sucursal->id)}}" class="btn btn-dark mtmobile" title="Edit">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="javascript:void(0)"
                                        onclick="Confirm('{{$sucursal->id}}')" class="btn btn-danger" title="Delete">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>
                                @endforeach
                          </tbody>
                      </table>
                        {{$sucursales->links()}}
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      document.addEventListener('DOMContentLoaded', function(){

      });
      function Confirm(id, subCategories){
          if (subCategories >0){
              swal({
                  type: 'error',
                   text: 'No se puede eliminar la categoría por que tiene Sub-Categorías asignadas'})
              return;
          }
          swal({
              title: 'Confirmar',
              text: '¿Confirmas eliminar la Sucursal?',
              type: 'warning',
              showCancelButton: true,
              cancelButtonText: 'Cerrar',
              cancelButtonColor: '#fff',
              confirmButtonColor: '#3B3F5C',
              confirmButtonText: 'Aceptar'

          }).then(function(result){
             if (result.value) {
              window.livewire.emit('deleteRow', id)
              swal.close()
             }
          })
      }
  </script>
</div>
