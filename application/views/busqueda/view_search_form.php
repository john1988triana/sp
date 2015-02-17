<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>"/>
<link rel="stylesheet" href="<?php echo base_url("assets/js/datepicker/css/datepicker.css")?>"/>
<link rel="stylesheet" href="<?php echo base_url("assets/css/landing-superprofe.css")?>"/>

<div class="container">
	<div class="row panel_component">
		<!--Formulario para enviar los datos de consulta-->
		<!--Area-->
		<form action="<?php echo base_url('busqueda')?>" method="get" target="_parent">
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="area">En que &Aacute;rea Necesitas Profesor?:</label>
					<select name="area" id="area" class="form-control col-md-9" value="<?php echo $area ?>">
						<option value="">&Aacute;rea</option>
						<?php 
							$areas = json_decode($areas, true);
							foreach ($areas as $key => $value_areas) {
						?> 
							<option value="<?php echo $value_areas['IdArea']; ?>" <?php if($value_areas['IdArea']==$area){echo "selected";}?>>
								<?php echo $value_areas['Name']; ?>
							</option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
			<!--Tema especifico-->
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="tema">Escribe la Tem&aacute;tica que Requieres:</label>
					<input type="text" name="topic" id="topic" class="form-control col-md-9" placeholder="Ej: Factorización" value="<?php echo $topic ?>">
				</div>
			</div>
			
			<!--Nivel especifico-->
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="tema">Escoge el nivel de la clase:</label>
					<select name="level" id="level" class="form-control col-md-9">
						<option value="">Nivel</option>
						<?php 
							foreach ($levels as $key => $value) {
						?> 
							<option value="<?php echo $value['id'];?>" <?php if($value['id']==$level){echo "selected";}?>>
								<?php echo utf8_encode($value['name']); ?>
							</option> 
						<?php
							}
						?>      
					</select>
				</div>
			</div>

			<!--Ciudad: este campo se trae desde la base de amigas-->
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="ciudad">En qu&eacute; Ciudad Quieres Tomar la Clase?:</label>
					<select name="city" id="city" class="form-control col-md-9">
						<option value="">Ciudad</option>
						<?php 
							$cities = json_decode($cities, true);
							$cities = json_decode($cities['cities'], true);
							foreach ($cities as $key => $value_cities) {
						?> 
							<option value="<?php echo $value_cities['ID'];?>" <?php if($value_cities['ID']==$city){echo "selected";}?>>
								<?php echo utf8_decode($value_cities['Name']); ?>
							</option> 
						<?php
							}
						?>      
					</select>
				</div>
			</div>

			<!--Tema especifico-->
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="tema">Escribe la Direcci&oacute;n Donde vas a Tomar la Clase:</label>
					<input type="text" name="address" id="address" class="form-control col-md-9" value="<?php echo $address;?>">						
				</div>
			</div>
			
			<!--Tel?fono-->
			<div class="row">
				<div class="col-md-12 txt-busqueda">
					<label for="tema">Escribe tu tel&eacute;fono:</label>
					<input type="text" name="phone" id="phone" class="form-control col-md-9" value="<?php echo $phone;?>">						
				</div>
			</div>
			
			<!--Fecha -->
			<div class="row">
				<div class="col-md-6 txt-busqueda-mid">
					<label for="tema">Cuando Quieres la Clase?</label>
					<!--<input type="text" class="form-control" data-beatpicker="true" data-beatpicker-position="['*','*']" data-beatpicker-module="today,clear,icon" placeholder="Seleccione la fecha" name="input_date" id="input_date" data-beatpicker-disable="{from:[2014,1,1],to:[2014 , 2 , '*']}">-->
					<div class="input-append date" data-date-format="dd-mm-yyyy">
					  <input class="span2 form-control" name="date" size="16" id="date" type="text" value="<?php echo $date;?>">
					  <span class="add-on"><i class="icon-th"></i></span>
					</div>
				</div>

				<!-- Hora se carga un formulario -->

				<div class="col-md-6 txt-busqueda-mid">
					<label for="time">En que Horario?</label>
					<select name="time" id="time" class="form-control">
						<option value="">opción</option>
						<option value="7" <?php if($time == 7){echo "selected";}?>>7:00 am</option>
						<option value="8" <?php if($time == 8){echo "selected";}?>>8:00 am</option>
						<option value="9" <?php if($time == 9){echo "selected";}?>>9:00 am</option>
						<option value="10"<?php if($time == 10){echo "selected";}?>>10:00 am</option>
						<option value="11"<?php if($time == 11){echo "selected";}?>>11:00 am</option>
						<option value="12"<?php if($time == 12){echo "selected";}?>>12:00 pm</option>
						<option value="13"<?php if($time == 13){echo "selected";}?>>1:00 pm</option>
						<option value="14"<?php if($time == 14){echo "selected";}?>>2:00 pm</option>
						<option value="15"<?php if($time == 15){echo "selected";}?>>3:00 pm</option>
						<option value="16"<?php if($time == 16){echo "selected";}?>>4:00 pm</option>
						<option value="17"<?php if($time == 17){echo "selected";}?>>5:00 pm</option>
						<option value="18"<?php if($time == 18){echo "selected";}?>>6:00 pm</option>
						<option value="19"<?php if($time == 19){echo "selected";}?>>7:00 pm</option>
					</select>
				</div>
			</div>


			<!--Boton buscar que ejecuta la consulta-->
			<div class="row">
				<div class="col-md-12">
					<label for=""></label>
					<input type="submit" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Encontrar Profesor">
				</div>
			</div>
		</form>
	</div>
</div>
<script src="<?php echo (base_url('assets/js/jquery-1.11.1.min.js')); ?>"></script>
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo (base_url('assets/js/datepicker/js/locales/bootstrap-datepicker.es.js')); ?>"></script>

<script>
$('#date').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: true,
	startDate: "+1d",
	language: "es",
})
</script>