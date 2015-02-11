	<div class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo base_url('assets/img/logo_superprofe.svg'); ?>">Super<span>Profe</span>.co</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav nav-pills pull-right">
					<li><a href="<?php echo base_url('login'); ?>">Iniciar Sesión</a></li>
					<li><a href="<?php echo base_url('login/como_funciona'); ?>">Como funciona</a></li>
					<li><a href="<?php echo base_url('login/inicioRegistrarse'); ?>">Registrate</a></li>
					<li><a href="<?php echo base_url('login/contactenos'); ?>">Contácto</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<div class="msj2 alert alert-warning alert-danger" role="alert" style="display:none" id="alert">
		<div class="msj2">
		<h4></h4>
		<ol>
			<li>
				<label for="txtEmail" class="error">Ingresa un email valido</label>
			</li>
			<li>
				<label for="txtPassword" class="error">Ingresa una contraseña</label>
			</li>
		</ol>
		</div>  
	</div>
	<div class="jumbotron fondo_busqueda">
	<div class="container">

		<div class="row steps-center">
			<div class="col-md-12"></div>
		</div>
		
		<div class="row steps-center panel_busqueda">

			<div class="col-md-12">
					
					<h3 class="text-center sub-titulos">INICIAR SESION</h3> 

						<form action="<?php echo base_url('login/log_in'); ?>" method="post" role="form" class="form-horizontal" id="form3">
							<fieldset>
							
								<div class="form-group">
									<div class="col-lg-12">
										<label for="txtEmail">Correo electrónico</label>
										<input id="txtEmail" name="txtEmail" type="email" class="form-control" id="" placeholder="Correo electrónico" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-12">
										<label for="">Contraseña</label>
										<input id="txtPassword" name="txtPassword" type="password" class="form-control" id="" placeholder="Contraseña" required>
									</div>
								</div>
								
								<?php echo($message); ?>
								
								<div class="form-group">
									<div class="col-lg-12">
										<!--<input type="submit" class="btn-profe btn-login col-lg-12" value="Ingresar" id="btnlogin">-->
										<button type="submit"  class="btn-profe btn-login btn col-lg-12">Ingresar</a>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<a href="<?php echo base_url('login/resetPassword'); ?>" class="text-center">Olvidaste tu contraseña?</a>
									</div>
								</div>
								<div class="form-group input-group-lg">
									<div class="col-lg-12">
										<a href="<?php echo base_url('registro'); ?>" class="btn-estu btn-login btn col-lg-12">Regístrarme</a>
									</div>
								</div>
								<div class="form-group">     
									<div class="text-center"><label for="">ó inicia con tu cuenta de</label></div>
									<div class="col-lg-12">
										<a href="<?php echo $sLoginGoogle ?>"class="btn btn-google btn-login col-md-12">Google</a>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<a href="<?php echo $sLoginFacebook; ?>"class="btn btn-facebook btn-login col-md-12">facebook</a>
									</div>
								</div>
							</fieldset>
						</form>
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

<script>
	var base_url = '<?php echo base_url(); ?>';
	function enviar () {
		document.getElementById('form3').submit();
	}
</script>