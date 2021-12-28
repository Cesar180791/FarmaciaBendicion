<script>
	var listener = new window.keypress.Listener();

	listener.simple_combo("f1", function(){
            $('#detalle').hide();
            $('#listar-productos').show();    
	})
	listener.simple_combo("esc", function(){
        $('#detalle').show();
        $('#listar-productos').hide(); 
        $('#asignar-producto-lote').hide();
        $('#crear-lote').hide();

	})
	
</script>