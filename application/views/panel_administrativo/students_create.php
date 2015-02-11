<div class="container">
	<div class="row steps-center" style="">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="login-panel panel-registro panel panel-default">
				<div class="panel-body">
				<form id="create-form" method="post" enctype="application/x-www-form-urlencoded">
				<h4>El estudiante no existe, completa los datos para darle de alta en el sistema.</h4>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label for="name">Nombre</label>
						<input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>
					 </div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label for="fname">Apellido</label>
						<input id="fname" name="fname" type="text" class="form-control" placeholder="Apellido" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label for="email">Correo electrónico</label>
						<input id="email-create" name="email" type="email" class="form-control" placeholder="Correo electrónico" required>
					</div>
				</div>
				<input id="create" type="submit" href="" class="btn-profe btn-login btn col-lg-12 " value="Crear Usuario"></input>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$("#create-form").submit(function(e){
	var data = {};
	data.email = $("#email-create").val();
	data.name = $("#name").val();
	data.fname = $("#fname").val();
	$.post("<?php echo base_url("administrador/estudiantes/crear"); ?>",data,function(){
		$("#email").val(data.email);
		$("#search-form").submit();
	});
	e.preventDefault();
});
</script>