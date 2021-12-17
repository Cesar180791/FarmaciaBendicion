document.addEventListener('DOMContentLoaded', function () {

    $('#crear-sucursal').hide();
    $('#ver-sucursal').hide();


    $('#nueva-sucursal').on("click", function () {
        $('#crear-sucursal').show();
        $('#listar-sucursales').hide();
    });

    $('#regresar').on("click", function () {
        $('#crear-sucursal').hide();
        $('#listar-sucursales').show();
    });

    $('#regresar2').on("click", function () {
        $('#ver-sucursal').hide();
        $('#listar-sucursales').show();
    });

    window.livewire.on('mostrar-sucursal', msg=>{
        $('#listar-sucursales').hide();
        $('#ver-sucursal').show();
      });

      window.livewire.on('edit-sucursal', msg=>{
        $('#crear-sucursal').show();
        $('#listar-sucursales').hide();
      });

    window.livewire.on('Sucursal-creada', msg=>{
        swal({
               title: 'Sucursal Creada con Exito!',
               text: msg,
               type: 'success',
           })
        $('#crear-sucursal').hide();
        $('#listar-sucursales').show();
      });

    window.livewire.on('Sucursal-actualizada', msg=>{
        swal({
               title: 'Sucursal actualizada con Exito!',
               text: msg,
               type: 'success',
           })
        $('#crear-sucursal').hide();
        $('#listar-sucursales').show();
      });

    

})

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