<script>
   try {
    onScan.attachTo(document, {
        suffixxKeyCodes: [13],
        onScan: function(barcode){
            console.log(barcode)
            window.livewire.emit('scanCode', barcode)
        },
        onScanError: function(e){
            console.log(e)
        }
    })

    console.log('Escaner Listo Quiquin!');
       
   } catch (e) {
    console.log('Error de lectura: ', e)
   }
</script>