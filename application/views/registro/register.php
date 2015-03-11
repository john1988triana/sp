<section style="margin-top:83px;">
	<div class="msj alert alert-warning alert-danger" role="alert" style="display:none" id="alert2">
		<?php echo(validation_errors());?>
	</div>
	<div class="container">
		<label for="pass" class="error" id="pass_lb"></label>
	</div>
	<div class="container">
		<div class="row steps-center" style="">
			<?php if(isset($step)){include("circles.php");} ?>
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="login-panel panel-registro panel panel-default">
                
                <form action="<?php echo base_url('registro/register'); ?>" role="form" class="form-horizontal" id="formRegUser" method="post">
                
					<h3 class="text-center asi-funciona" style="color:#003333">¿Es tu primera vez en la plataforma?</h3>
                    <div class="text-center" style="height:80px; padding-top:30px;">
                      <p>
                      
                        <label>
                          <input name="tipo_usuario" type="radio" id="tipo_usuario_0" value="acudiente" <?php if($user_type == "acudiente"){ echo "checked='checked'";}?>>
                          soy Acudiente</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                          <input type="radio" name="tipo_usuario" value="estudiante" id="tipo_usuario_1" <?php if($user_type == "estudiante"){ echo "checked='checked'";}?>>
                        soy Estudiante</label>
                        <br>
                      </p>
                    </div>
                    
				  <div class="panel-body" id="form_content">
						
						<?php
							$attributes = array(
							'id' => 'formRegUser',
							'class' => 'form-horizontal'
							);
							echo form_open('login/add_register', $attributes);
						?>
						<fieldset>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
									<label for="name">Nombre</label>
									<input id="name" name="txtName" type="text" class="form-control" value="<?php echo (!empty($name)?$name:''); ?>" placeholder="Nombre" required>
								 </div>
							</div>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
									<label for="fname">Apellido</label>
									<input id="fname" name="txtLast" type="text" class="form-control" value="<?php echo (!empty($firstname)?$firstname:''); ?>" placeholder="Apellido" required>
								</div>
							</div>
                            
                            <div class="form-group" id="phoneDiv">
								<div class="col-md-10 col-md-offset-1">
									<label for="phoneTutor">Número de teléfono</label>
									<input id="phoneTutor" name="txtPhoneTutor" type="text" class="form-control" value="<?php echo (!empty($phone_tutor)?$phone_tutor:''); ?>" placeholder="Número de teléfono">
								</div>
							</div>
                            
                            
                            <div class="form-group" id="nameStudent">
								<div class="col-md-10 col-md-offset-1">
									<label for="fname_student">Nombre del alumno</label>
									<input id="fname_student" name="txtNameStudent" type="text" class="form-control" value="<?php echo (!empty($fname_student)?$fname_student:''); ?>" placeholder="Nombre del alumno">
								</div>
							</div>
                            
                            <div class="form-group" id="lastStudent">
								<div class="col-md-10 col-md-offset-1">
									<label for="lname_student">Apellido del alumno</label>
									<input id="lname_student" name="txtLastStudent" type="text" class="form-control" value="<?php echo (!empty($lname_student)?$lname_student:''); ?>" placeholder="Apellido del alumno">
								</div>
							</div>
                            
                            

							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
									<label for="email">Correo electrónico</label>
									<input id="email" name="txtEmailNew" type="email" class="form-control" value="<?php echo (!empty($reg_email)?$reg_email:''); ?>" placeholder="Correo electrónico" required>
								</div>
							</div>

							<div class="form-group">
							   <div class="col-md-10 col-md-offset-1">
								  <label for="pass">Contraseña</label>
								  <input id="pass" name="txtPassword" type="password" class="form-control" placeholder="Contraseña" required>
								</div>
							</div>

							<div class="form-group">
							   <div class="col-md-10 col-md-offset-1">
								  <label for="pass">Confirma tu contraseña</label>
								  <input id="Pass2" name="txtPasswordConfirm" type="password" class="form-control" placeholder="Repite tu contraseña" required>
								</div>
							</div>
							<?php echo (!empty($message) ? $message : ''); ?>
							<!--Botones de registro login y cuenta de google-->
							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
								<!--<div class="col-md-offset-2">-->
									<!--<input id="btn_sub_reg" type="submit" class="submit btn btn-success col-lg-12" value="Regístrate">-->
									<button type="submit" class="btn-estu btn-login btn col-lg-12" name="btnCompleteProfile" value="siguiente"><div>Reg&iacute;strate</div></button>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
								<!--<div class="col-md-offset-2">-->
									<a href="<?php echo base_url('login'); ?>" class="btn-profe btn-login btn col-lg-12 "><!--<span class="glyphicon glyphicon-user"></span>-->Ingresar</a>
								</div>
							</div>

							<div class="form-group">
								<div class="">
									<h4 class="text-center">ó inicia con tu cuenta de</h3>
										<div class="col-md-10 col-md-offset-1">
										<!--<div class="col-md-offset-2">-->
										<a href="<?php echo $sLoginGoogle ?>" class="btn-profe btn-login btn-google btn col-lg-12">Google</a>
									</div>
								</div>
							</div>
							<div class="form-group">
										<div class="col-md-10 col-md-offset-1">
										<!--<div class="col-md-offset-2">-->
										<a href="<?php echo $sLoginFacebook; ?>"class="btn-profe btn-login btn-facebook btn col-lg-12">facebook</a>
									</div>
								</div>

							<div class="form-group">
								<p class="text-center par">Al registrarme acepto los <a href"#">terminos y condiciones de uso</a></p>
							</div>
						</fieldset>
						<?php
							if (isset($error) AND $error['type'] == 'register') {
							 print '<div style="margin:10px 5px; padding:10px 0 10px 0; background-color:#da4f49; text-align:center; color:white; ">' . $error['message'] . '</div>';
						}
						?>
						<?php echo form_close(); ?>
						
					</div>
                    
                    </form>
                    
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>

<div class="row steps-center">
	<div class="col-md-12">
			
	</div>
</div>

<div class="amigas-separator"></div>
<script>var base_url = '<?php echo base_url(); ?>';

$(function() {
	
	var val = $('input:radio[name=tipo_usuario]:checked').val();
	
	if(val == "estudiante"){
		$("#form_content").show();
		$("#nameStudent").hide();
		$("#lastStudent").hide();
		$("#phoneDiv").hide();
	}
	else if(val == "acudiente") {
		$("#form_content").show();
		$("#nameStudent").show();
		$("#lastStudent").show();
		$("#phoneDiv").show();
	}
	else {
		$("#form_content").hide();
	}
	
    $('input[type=radio]').change(function(e) {
        if (this.id == 'tipo_usuario_0') {
            $("#form_content").show("200");
			$("#nameStudent").show("100");
			$("#lastStudent").show("100");
			$("#phoneDiv").show("100");
        } else if(this.id == 'tipo_usuario_1') {
            $("#form_content").show("200");
			$("#nameStudent").hide("100");
			$("#lastStudent").hide("100");
			$("#phoneDiv").hide("100");
        }
      });
});


</script>
</section>