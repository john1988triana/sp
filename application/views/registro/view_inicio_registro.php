<form  method="post" role="form" enctype="multipart/form-data" class="form-regis">
<div class="container" style="margin-top:83px;">
	<div class="col-md-8 col-md-offset-2 redondo container well">
		<fieldset>
				<div class="col-md-6">
					<a href="<?php echo base_url('registro/alumno'); ?>" class="btn-ingresa-aqui btn col-lg-10"><div> Soy estudiante</div></a>
				</div>
				<div class="col-md-6">
					<a href="<?php echo base_url('registro/profesor'); ?>" class="btn-soy-profe btn col-lg-10"><div> Quiero ser superprofe</div></a>
				</div>
		</fieldset> 
	</div>
	</form>
</div>
<input type="hidden" name="disponibilidad" id="disponibilidad" value="<?php echo $this->input->post("disponibilidad");?>" />
<input type="hidden" value="<?php echo $this->input->post("calif") ?>" id="calificacion">
<div class="amigas-separator"></div>