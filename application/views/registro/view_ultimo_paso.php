<div class="container">
	<div class="container">
		<div class="row steps-center" style="">
			<?php if($validation_background==0 || $validation_professional_ref==0 || $validation_personal_ref==0 || 
						$validation_interview==0 || $validation_personal_test==0 || $validation_agreement==0){?>
					<div class="col-md-12 alert alert-warning text-center mensaje-busqueda-realizada"><strong>Tus datos fueron enviados con éxito. A partir de este momento inicias el proceso de validación para convertirte en un Superprofe, revisa tu correo te enviaremos las instrucciones para que agendes tu cita.</strong></div>
			<?php } ?>
			<div class="col-md-10 col-md-offset-1">
				<div class="login-panel panel-registro">
				<h2 class="text-center asi-funciona" style="color:#003333">Asi va tu proceso: </h2>

			<div class="panel-body">
				<div class="row">
						<div class="col-md-9 col-md-offset-1">
							<form name="formcp" class="form-horizontal" role="form" method="post" action="<?php echo (base_url('registro/validateCompleteProfile'));?>">   
								
								<div class="form-group">
									<h4>1. Validaci&oacute;n de antecedentes: <?php if($validation_background==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
								<div class="form-group">									
									<h4>2. Validaci&oacute;n de referencias profesionales: <?php if($validation_professional_ref==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
								<div class="form-group">
									<h4>3. Validaci&oacute;n de referencias personales: <?php if($validation_personal_ref==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
								<div class="form-group">
									<h4>4. Citaci&oacute;n a entrevista: <?php if($validation_interview==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
								<div class="form-group ">
									<h4>5. Realizaci&oacute;n de test de personalidad: <?php if($validation_personal_test==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
								<div class="form-group ">
									<h4>6. Contrato firmado y activaci&oacute;n en la plataforma: <?php if($validation_agreement==1){?><span class="glyphicon glyphicon-ok chulo"></span><?php }else{?> <span class="glyphicon glyphicon-remove equis"></span> <?php } ?></h4>
								</div>
							</form>
						</div>
					<div class="col-md-3"></div>
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
</div>  
<div class="amigas-separator"></div>
