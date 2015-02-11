<div class="container" style="margin-top:83px;">
	<div class="row steps-center">
		<div class="col-md-12"></div>
	</div>
	
	<div class="row steps-center">

		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Iniciar Sesión</h3>
				 </div>

				<div class="panel-body">
					<!-- Se llama al controlador y el metodo que ejecuta la acción de login en este caso controlador->login Metodo->login_in -->
					<form action="" method="post" role="form" class="form-horizontal" id="form3">
						<fieldset>
						
							<div class="form-group">
								<div class="col-lg-12">
									<label for="">Correo electrónico</label>
									<input id="email_check" name="" type="email" class="form-control" placeholder="Correo electrónico" required>
								</div>
							</div>
							<div id="email_check_lb">
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<a class="submit btn btn-primary col-lg-12" id="btn_reset" onclick="resetPass();" type="submit">Recuperar contraseña</a>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<a class="submit btn btn-primary col-lg-12" id="btn_reset" href="<?php echo base_url('login') ?>" type="submit">Volver atras</a>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-2"></div>
	</div>
</div>
</div>

<div class="row steps-center">
<div class="col-md-12"></div>
</div>
<div class="amigas-separator"></div>
<script src="<?php echo base_url("assets/js/login/login.js");?>"></script>
<script>
var base_url = '<?php echo base_url(); ?>';
</script>