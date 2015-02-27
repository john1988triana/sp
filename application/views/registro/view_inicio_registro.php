<form  method="post" role="form" enctype="multipart/form-data" class="form-regis">
<div class="row registro-row" style="margin-top:83px;">
	<div class="redondo registro-col">
		<fieldset>
			<div class="row">
				<div class="col-md-6">
					<a href="<?php echo base_url('registro/alumno'); ?>" class="btn-ingresa-aqui btn"><div>Necesito una clase</div></a>
				</div>
				<div class="col-md-6">
					<a href="<?php echo base_url('registro/profesor'); ?>" class="btn-soy-profe btn"><div>Quiero ser superprofe</div></a>
				</div>
			</div>
			
		</fieldset> 
	</div>
	</form>
</div>
<input type="hidden" name="disponibilidad" id="disponibilidad" value="<?php echo $this->input->post("disponibilidad");?>" />
<input type="hidden" value="<?php echo $this->input->post("calif") ?>" id="calificacion">
<div class="amigas-separator"></div>