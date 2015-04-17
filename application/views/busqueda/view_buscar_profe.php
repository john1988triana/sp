<!--/.nav-collapse -->
<div class="jumbotron fondo_busqueda">
	<?php 
	 if(validation_errors())
		echo '<div class="col-md-12 alert text-center bg-danger">'.validation_errors('<h5>','</h5>').'</div>'; 
	 ?>
	<div class="container">
		<div class="col-md-12">
	 		<div class="col-md-5">	 		
			 	<div class="row well panel_busqueda">
					<!--Formulario para enviar los datos de consulta-->
						<!--Area-->
						<div class="text-center" style="font-size:16px;">
							<strong>Completa el formulario</strong>
						</div>
						<form action="<?php echo base_url('busqueda')?>" method="get">
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="area">En que &Aacute;rea Necesitas Profesor?</label>
									<select name="area" id="area" class="form-control col-md-9" value="<?php echo $area ?>">
										<option value="">&Aacute;rea</option>
										<?php 
											$areas = json_decode($areas, true);
											foreach ($areas as $key => $value_areas) {
										?> 
											<option value="<?php echo $value_areas['IdArea']; ?>" <?php if($value_areas['IdArea']==$area){echo "selected";}?>><?= $value_areas['Name']; ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<div class="error"><?php echo $errors["area"]; ?></div>
							</div>
							<!--Tema especifico-->
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="tema">Escribe la Tem&aacute;tica que Requieres :</label>
									<input type="text" name="topic" id="topic" class="form-control col-md-9" placeholder="Ej: Factorización" value="<?php echo $topic ?>">
								</div>
								<div class="error"><?php echo $errors["topic"]; ?></div>
							</div>
							<!--Nivel especifico-->
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="tema">Escoge el nivel de la clase :</label>
									<select name="level" id="level" class="form-control col-md-9">
										<option value="">Nivel</option>
										<?php 
											foreach ($levels as $key => $value) {
										?> 
											<option value="<?php echo $value['id'];?>" <?php if($value['id']==$level){echo "selected";}?>><?php echo utf8_decode($value['name']); ?></option> 
										<?php
											}
										?>      
									</select>
								</div>
								<div class="error"><?php echo $errors["level"]; ?></div>
							</div>
							<!--Ciudad: este campo se trae desde la base de amigas-->
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="ciudad">En qu&eacute; Ciudad Quieres Tomar la Clase? :</label>
									<select name="city" id="city" class="form-control col-md-9">
										<option value="">Ciudad</option>
										<?php 
											$cities = json_decode($cities, true);
											$cities = json_decode($cities['cities'], true);
											foreach ($cities as $key => $value_cities) {
										?> 
											<option value="<?php echo $value_cities['ID'];?>" <?php if($value_cities['ID']==$city){echo "selected";}?>><?php echo utf8_decode($value_cities['Name']); ?></option> 
										<?php
											}
										?>      
									</select>
								</div>
								<div class="error"><?php echo $errors["city"]; ?></div>
							</div>
							<!--Tema especifico--> 
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="tema">Escribe la Direcci&oacute;n Donde vas a Tomar la Clase :</label>
									<input type="text" name="address" id="address" class="form-control col-md-9" value="<?php echo $address;?>">						
								</div>
								<div class="error"><?php echo $errors["address"]; ?></div>
							</div>
							<!--Barrio -->
		                    <div class="row">
		                        <div class="col-md-12 txt-busqueda">
		                            <label for="neighbor">Barrio :</label>
		                            <input type="text" name="neighbor" id="neighbor" class="form-control col-md-9" value="<?php echo $address;?>">						
		                        </div>
		                    </div>
							<!--Teléfono-->
							<div class="row">
								<div class="col-md-12 txt-busqueda">
									<label for="tema">Escribe tu tel&eacute;fono :</label>
									<input type="text" name="phone" id="phone" class="form-control col-md-9" value="<?php echo $phone;?>">						
								</div>
								<div class="error"><?php echo $errors["phone"]; ?></div>
							</div>
							<!--Fecha -->
							<div class="row">
								<div class="col-md-6 txt-busqueda">
									<label for="tema">Cuando Quieres la Clase?</label>
									<!--<input type="text" class="form-control" data-beatpicker="true" data-beatpicker-position="['*','*']" data-beatpicker-module="today,clear,icon" placeholder="Seleccione la fecha" name="input_date" id="input_date" data-beatpicker-disable="{from:[2014,1,1],to:[2014 , 2 , '*']}">-->
									<div class="input-append date" data-date-format="dd-mm-yyyy">
									  <input class="span2 form-control" name="date" size="16" id="date" type="text" value="<?php echo $date;?>">
									  <span class="add-on"><i class="icon-th"></i></span>
									</div>
									<div class="error"><?php echo $errors["date"]; ?></div>
								</div>
								<!-- Hora se carga un formulario -->
								<div class="col-md-6 txt-busqueda">
									<label for="time">En que Horario? :</label>
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
									<div class="error"><?php echo $errors["time"]; ?></div>
								</div>
							</div>
							<!--Boton buscar que ejecuta la consulta-->
							<div class="row">
								<div class="col-md-12">
									<input type="submit" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Encontrar Profesor">
								</div>
							</div>
						</form>
				</div>
			</div>	
			<div class="col-md-5 hidden-xs hidden-sm">
				<h2 class="text-es text-center">Encuentra el Profesor<br>que Necesitas Aquí</h2>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<br>
	<span id="necesito-prof">Necesito profesor</span> <span id="mensaje-seguimiento-area"><?php echo $this->input->post("area")?></span><!--<span id="mensaje-seguimiento-tema"><?php /*echo $this->input->post("cbo_tema")*/?></span>--><span id="mensaje-seguimiento-ciudad"><?php echo $this->input->post("ciudad")?></span><span id="mensaje-seguimiento-direccion"><?php echo $this->input->post("direccion_clase")?></span><span id="mensaje-seguimiento-fecha"><?php echo $this->input->post("input_date")?></span><span id="mensaje-seguimiento-hora"><?php echo $this->input->post("cbo_hora")?></span>
</div>
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo (base_url('assets/js/datepicker/js/locales/bootstrap-datepicker.es.js')); ?>"></script>
<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<script type="text/javascript">
	$('#date').datepicker({
		format: 'dd-mm-yyyy',
		language: "es",
		autoclose: true,
		startDate: "+1d"
	})
	if($("#mensaje-seguimiento-area").html() != "" || $("#mensaje-seguimiento-ciudad").html() != "" || $("#mensaje-seguimiento-hora").html() != ""){

	$("#necesito-prof").css("display","inline-block")
	var ar = $("#mensaje-seguimiento-area").html()
	var ciu = $("#mensaje-seguimiento-ciudad").html()
	var hor = $("#mensaje-seguimiento-hora").html()
	var fec = $("#mensaje-seguimiento-fecha").html()
	var dir = $("#mensaje-seguimiento-direccion").html()

	$("#mensaje-seguimiento-area").html(" de <span class=\"txt-mensajes-1\">"+$("#area option[value='"+ar+"']").text()+"</span> ")
	$("#mensaje-seguimiento-ciudad").html(" localizado en <span class=\"txt-mensajes-1\">"+$("#ciudad option[value='"+ciu+"']").text()+"</span> ")
	$("#mensaje-seguimiento-hora").html(" a las: <span class=\"txt-mensajes-1\">"+$("#cbo_hora option[value='"+hor+"']").text()+"</span> ")
	$("#mensaje-seguimiento-fecha").html(" el dia: <span class=\"txt-mensajes-1\">"+fec+"</span> ")
	$("#mensaje-seguimiento-direccion").html(" en la direccion <span class=\"txt-mensajes-1\">"+dir+"</span> ")

	}

	$("#area").change(function() {
	var op = $(this).val();
	if($("#necesito-prof").css("display")=="none")
	$("#necesito-prof").toggle(500);
	$("#mensaje-seguimiento-area").html(" en el area de: <span class=\"txt-mensajes-1\">"+$("#area option[value='"+op+"']").text()+"</span> ")
	})

	$("#direccion_clase").blur(function() {
	var dir = $(this).val();
	if($("#necesito-prof").css("display")=="none")
	$("#necesito-prof").toggle(500);
	$("#mensaje-seguimiento-direccion").html(" en la direccion <span class=\"txt-mensajes-1\">"+dir+"</span> ")
	});

	$("#ciudad").change(function() {
	var op = $(this).val();
	if($("#necesito-prof").css("display")=="none")
	$("#necesito-prof").toggle(500);
	$("#mensaje-seguimiento-ciudad").html(" localizado en: <span class=\"txt-mensajes-1\">"+$("#ciudad option[value='"+op+"']").text()+"</span> ")
	})

	$("#cbo_hora").change(function() {
	var hor = $(this).val();
	if($("#necesito-prof").css("display")=="none")
	$("#necesito-prof").toggle(500);
	$("#mensaje-seguimiento-hora").html(" a las: <span class=\"txt-mensajes-1\">"+$("#cbo_hora option[value='"+hor+"']").text()+"</span> ")
	$("#mensaje-seguimiento-fecha").html(" el dia: <span class=\"txt-mensajes-1\">"+$("#dp3").val()+"</span> ")
	}) 

	$("select#area").change(function(){
	var v = $(this).val();
	var txt = $("select#area option[value='"+v+"']").text().trim();
	$("#nombre_area").val(txt);
	});
	$(".steps-center IMG").css("margin","0 auto")
</script>