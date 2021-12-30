<script>
	var listener = new window.keypress.Listener();

	listener.simple_combo("f1", function(){
            $('#detalle-compra').hide();
            $('#listar-productos').show();    
	})
	listener.simple_combo("esc", function(){
        $('#detalle-compra').show();
        $('#listar-productos').hide(); 
        $('#lotes').hide();
        $('#nuevo-lote').hide();
        $('#datos-generales').hide();

	})
	
</script>