var datax='http://127.0.0.1/nueva/ULogin/entrar';
var datam='http://127.0.0.1/nueva/';
(function($){
	$("#login1").submit(function(ev){
		ev.preventDefault();
		$.ajax({
			url: datax,
			type: 'POST',
			data: $(this).serialize(),//envia todo lo del formulario
			success: function(data){
				var estadologer=JSON.parse(data);
				//console.log(estadologer.estado);
				if(estadologer.estado==1){
					$("#erroruser").html('<div class="alert alert-success" role="alert">Bienvenido</div><script type="text/javascript">  window.locationf="http://www.cristalab.com"; </script>');
					window.location.replace(datam)					
				}else{
					$("#erroruser").html('<div class="alert alert-danger" role="alert">Email o Clave Errados</div>');
				}
			},
			error: function(){
				
			}
		});
	});
})(jQuery)