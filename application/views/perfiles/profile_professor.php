﻿<div class="modal fade in" id="legal_modal" tabindex="-1" role="dialog" aria-labelledby="legalModal" aria-hidden="false" style="display: none;">
	<div class="modal-dialog">
  		<div class="modal-content">
   			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    				<h4 class="modal-title" id="myModalLabel">Información Legal</h4>
   			</div>
   			<div class="modal-body">
    			<ul id="legalTab" class="nav nav-tabs" role="tablist">
     				<li id="li_uso"><a onclick="uso(event)" role="tab" data-toggle="tab">Condiciones de Uso</a></li>
     				<li id="li_politicas" class="active"><a onclick="politicas(event)" role="tab" data-toggle="tab">Política de Datos</a></li>
    			</ul>
    		<div class="tab-content">
     			<div class="tab-pane" id="use">
      				<iframe src="http://www.amigaslive.com/amigasStore/0021/acuerdos/acuerdoUso.html"></iframe>
     			</div>
     			<div class="tab-pane active" id="policy">
      				<iframe src="http://www.amigaslive.com/amigasStore/0021/acuerdos/politicas.html"></iframe>
     			</div>
    		</div>
   			</div>
   			<div class="modal-footer">
   			</div>
  		</div>
 	</div>
</div>

<!-- ROW PERFIL -->
<div class="container" <?php if(isset($unique)){ echo 'style="margin-top:120px;"';}?>>
	<div class="row perfil-profesor">
		<div class="col-md-6 perfil-profesor-iz">
			<h3 style="color:#009966;" class="title-profesor">PERFIL</h3>
			<div>
				<img src="<?php echo base_url($picture); ?>" class="img-profile">
			</div>
			<div class="estrellas star-profesor">
				<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
				<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
				<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
				<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
				<span class="glyphicon glyphicon-star" style="color: grey;"></span>    
			</div>

			<div class="medallas-profesor">
				<img src="assets/img/medallas/1_color.png" alt="">
				<img src="assets/img/medallas/2_color.png" alt="">
				<img src="assets/img/medallas/3_color.png" alt="">
				<img src="assets/img/medallas/4_color.png" alt="">
				<img src="assets/img/medallas/5_bn.png" alt="" class="no-medalla">
			</div>
			<div class="btn-subir-foto btn" id="texto_foto" onclick="getFile()">Subir foto</div>
			<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" name="userfile" type="file" value="upload" onchange="sub(this)"/></div>
		</div>
		<div class="col-md-6 perfil-profesor-der">
			<div class="btn-subir-foto btn btn-radius ver-perfil-como">
				<p>Ver perfil como</p>
			</div>
			<h3 style="color:#009966;" class="title-profesor"><?php echo $FirstName." ".$FamilyName?></h3>
			<p>
				Este es el perfil. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum viverra accumsan laoreet. Proin interdum massa nulla, et elementum neque semper sed. Suspendisse et justo ut velit ullamcorper mattis. Quisque imperdiet dolor eu imperdiet mattis. Nulla imperdiet iaculis diam. Cras elementum quis sem nec pellentesque. Curabitur sollicitudin vestibulum est, non ornare magna auctor ac. Ut euismod justo sagittis bibendum consequat. Pellentesque ut
				massa ut nisl mollis pellentesque. Phasellus in sem mollis nunc cursus sollicitudin. Morbi a malesuada enim, eu aliquet nunc.	
			</p>
		</div>
	</div>


	<!-- Experticia -->


	<div class="row experticia perfil-profesor">
		<h3 class="title-profesor">EXPERTICIA</h3>
		<button type="button" class="btn  experticia-input" id="show_competencias">Agregar una nueva competencia</button>
		<div class="amigas-separator"></div>
		<!--div oculto-->
		<div class="form-group" id="hide_competencias" style="display:none">
				<select name="area" class="form-control competen" value="">
					<option value="" disabled selected>Selecciona área</option>
					<?php 
						foreach ($areas as $key => $value_areas) {
					?> 
						<option value=<?php echo $value_areas->IdArea; ?>>
							<?php echo $value_areas->Name; ?>
						</option>
					<?php
						}
					?>
				</select>
				<select name="level" class="form-control level" value="">
					<option value="" disabled selected>Selecciona nivel</option>
					<?php 
						foreach ($levels as $key => $value) {
					?> 
						<option value=<?php echo $value["id"]; ?>>
							<?php echo $value["name"]; ?>
						</option>
					<?php
						}
					?>
				</select>
			<button type="button" class="btn btn-agregar btn_agregar_experticia" style="margin-top:1.5%">Agregar</button>
		</div>
		<div id="areas-wrapper">
			<?php 
				for( $i = 0; $i < count($selected_areas) ; $i++){
					echo "<div class=\"numero-competencia\">"."&nbsp;" . ($i+1) . ".&nbsp;"."</div><div class=\"valor-competencia\">".$selected_areas[$i]->Name." - ".$selected_areas[$i]->level."</div><div class=\"borrar-competencia trasition-half\" data-id=\"".$selected_areas[$i]->id_area."\">X</div><br>";
				}
			?>
		</div>
	</div>


	<!-- Videos -->


	<div class="row videos-profesor perfil-profesor">
		<h3 class="title-profesor">VIDEOS</h3>
		<button type="button" class="btn suscribir-btn">Suscribirse</button>
		<div class="col-md-12">	
			<div class="col-md-offset-1">
				<div class="row col-md-12 youtube-form">
					<form class="navbar-form navbar-left" role="search"><h3>Ingrese el link del video de Youtube</h3>
					  <div class="form-group">
						<input type="text" class="form-control link_youtube" placeholder="Link">
						<button type="button" class="btn btn-agregar btn_agregar_video">Agregar</button>
					  </div>
				
					  <!--<button type="button" class="btn btn-default video_you">Colgar</button>-->
					</form>
				</div>
					
				</div>
			</div>
		
		<div class="row container-videos">
			<div class="col-md-4">
				<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe id="video_profe"></iframe></div>
			</div>
			<div class="col-md-4">
				<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://www.youtube.com/embed/x97biL1lKBE' frameborder='0' allowfullscreen></iframe></div>
			</div>
			<div class="col-md-4">
				<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://www.youtube.com/embed/x97biL1lKBE' frameborder='0' allowfullscreen></iframe></div>
			</div>
		</div>
	</div>


	<!-- Estudios -->


	<div class="row perfil-profesor">
		<h3 class="title-profesor">FORMACIÓN ACADEMICA</h3>
		<button type="button" class="btn suscribir-btn" id="show_estudios">+ añadir</button>

				<div id="exp-wrapper-est">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==0){ //id for laboral exp 
							continue;
						}
						echo "<div class=\"form-group textarea exp-profesor\" >
								<div class='grid-exp'>Institución: </div> <div class='grid-exp exp-var'>".$experience[$i]["institution"]."</div><br>
								<div class='grid-exp'>Profesión: </div> <div class='grid-exp exp-var'>".$experience[$i]["title"]."</div><br>
								<div class='grid-exp'>Año: </div> <div class='grid-exp exp-var'>".date("Y",strtotime($experience[$i]["from"]))." hasta ".date("Y",strtotime($experience[$i]["to"]))."</div><br>
								<span class='glyphicon glyphicon-remove-circle delete-group exp' aria-hidden='true' data-id=\"".$experience[$i]["id"]."\"></span>
								<div class=\"amigas-separator\"></div>
							</div>";
					}
				?>
				</div>
			<div class="amigas-separator"></div>
			<!--div oculto-->
			<div class="form-group" id="hide_estudios" style="display:none">
				<label for="add_empresa">Centro de estudios</label>
				<input type="text" placeholder="" class="form-control" id="add_universidad" >

				<label for="cbo_fecha_inicial">Fechas de estudio</label>
				<div class="row">
					<div class="col-md-4">
						<!--<input type="text" placeholder="Año inicio" class="form-control input-sm" id="add_anio_estu_desde" >-->
						<select class="form-control input-sm" id="add_anio_estu_desde">
						<?php
							$anio_actual = date("Y");
							$opciones = "";
							for ($anio=$anio_actual; $anio >= 1950; $anio--)
								$opciones .= "<option value=\"".$anio."\">".$anio."</option>";
							
							echo $opciones;
						?>
						</select>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<b>hasta</b>
					</div>
					<div class="col-md-4">
						<!--<input type="text" placeholder="Año inicio" class="form-control input-sm" id="add_anio_estu_hasta" >-->
						<select class="form-control input-sm" id="add_anio_estu_hasta">
						<?php
							$anio_actual = date("Y");
							$opciones = "";
							for ($anio=$anio_actual; $anio >= 1950; $anio--)
								$opciones .= "<option value=\"".$anio."\">".$anio."</option>";
							
							echo $opciones;
						?>
						</select>
					</div>
				</div>
				<label for="cbo_fecha_inicio">Disciplina acad&eacute;mica</label>
				<input type="text" placeholder="" class="form-control" id="add_titulo_obtenido" >
				
				<label for="">Actividades y grupos</label>
				<textarea class="form-control" rows="2" placeholder="" id="add_actividades_estu"></textarea>
				<label for="">Descripción</label>
				<textarea class="form-control" rows="3" placeholder="" id="add_descripcion_estu"></textarea>
				

				
				<div class="form-group">
					<button type="button" class="btn btn-agregar btn_agregar_estudios" style="margin-top:1.5%">Agregar</button>
					<!--<a href="" class="btn btn-info form-control"><span class="glyphicon glyphicon-refresh"></span>Actualizar información</a>-->
				</div>
			</div> 
	</div>


	<!-- Experiencia -->


	<div class="row experticia perfil-profesor ">
		<h3 class="title-profesor">EXPERIENCIA LABORAL</h3>
		<button type="button" class="btn suscribir-btn" id="show_experiencias">+ añadir</button> 
				<div id="exp-wrapper-pro">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==1){ //id for educational exp 
							continue;
						}
						echo "<div class=\"form-group exp-profesor\" class=\"col-xs-3\">
								<div class='grid-exp'>Institución: </div><div class='grid-exp exp-var'>".$experience[$i]["institution"]."</div><br>
								<div class='grid-exp'>Titulo: </div><div class='grid-exp exp-var'>".$experience[$i]["title"]."</div><br>
								<div class='grid-exp'>Año: </div><div class='grid-exp exp-var'>".date("Y-m",strtotime($experience[$i]["from"]))." hasta ".date("Y-m",strtotime($experience[$i]["to"]))."</div><br>
								<span class=\"glyphicon glyphicon-remove-circle delete-group exp\" aria-hidden='true' data-id=\"".$experience[$i]["id"]."\"></span>
								<div class=\"amigas-separator\"></div>
						  	</div>";
					}
				?>
				</div>
			
			<div class="amigas-separator"></div>
			<!--div oculto-->
			<div class="form-group" id="hide_experiencias" style="display:none">
				<label for="add_empresa">Nombre de la empresa</label>
				<input type="text" name="institution" class="form-control" id="add_empresa" >

				<label for="cbo_fecha_inicio">Titulo</label>
				<input type="text" name="title" class="form-control" id="add_titulo" >

				<label for="cbo_fecha_inicio">Ubicaci&oacute;n</label>
				<input type="text" name="address" class="form-control" id="add_ubicacion" >

					<label for="cbo_fecha_inicio">Periodo</label>
				<div class="row">
					<div class="col-xs-3">
						<select class="form-control input-sm" id="add_mes_desde">    
							<option value="-" selected="selected">Desde</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>

						</select>
					</div>
					<div class="col-xs-3">
						<!--<input type="text" placeholder="Año" class="form-control input-sm" id="add_anio_desde" >-->
						<select class="form-control input-sm" id="add_anio_desde">
						<?php
							$anio_actual = date("Y");
							$opciones = "";
							for ($anio=$anio_actual; $anio >= 1950; $anio--)
								$opciones .= "<option value=\"".$anio."\">".$anio."</option>";
							echo $opciones;
						?>
						</select>
					</div>
					
					<div class="col-xs-3">
						<select class="form-control input-sm" id="add_mes_hasta">    
							<option value="-" selected="selected">Hasta</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
					<div class="col-xs-3">
						<!--<input type="text" placeholder="Año" class="form-control input-sm" id="add_anio_hasta" >-->
						<select class="form-control input-sm" id="add_anio_hasta">
						<?php
							$anio_actual = date("Y");
							$opciones = "";
							for ($anio=$anio_actual; $anio >= 1950; $anio--)
								$opciones .= "<option value=\"".$anio."\">".$anio."</option>";
							
							echo $opciones;
						?>
						</select>
					</div>
				</div>
				<label for="">Descripción de actividades</label>
				<textarea class="form-control" rows="3" placeholder="Instructor de natación con enfasis en tal" id="actividad_exper"></textarea>

				<div class="form-group">
					<button type="button" class="btn btn-agregar btn_agregar_experiencia" style="margin-top:1.5%">Agregar</button>
				</div>
			</div>
	</div>
	<div class="row perfil-profesor">
		<h3 class="title-profesor">AGENDA</h3>
		<div class="col-md-12 agenda-profesor">
			<div class="col-md-offset-1" style="margin-top:30px">
				<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Si no tienes codigo de Aulas Amigas deja este espacio en blanco"></span>
				<h4>Ingresa tu código de Activación de Aulas Amigas:</h4>
				<input type="text" class="form-control" placeholder="">
			</div>
			<div class="clearfix"></div>
			<h4 class="col-md-offset-1">Ingresa tu disponibilidad:</h4>
			<div>*Tu disponibilidad deber ser de mínimo 3(tres) horas.</div>
			<div class="col-md-offset-1" id="calendar"></div>
			<button type="button" class="btn btn-agregar" id="btn-save-schedule" style="margin-top:1.5%">Actualizar disponibilidad</button>
		</div>
	</div>


			
			

				
				
	<div class="row experticia perfil-profesor">
		<div class="col-md-4 datos-porfesor">
				
				<div class="row col-md-12 texto-1-profe" style="margin-top:2px;">
					<div class=" col-md-4 col-xs-4">
						Ciudad:
					</div>
					<div class=" col-md-8 col-xs-8">
						Bogotá - Colombia
					</div>
				</div>
				<div class="row col-md-12 texto-1-profe" style="margin-top:2px;">
					<div class=" col-md-4">
						Telefono:
					</div>
					<div class=" col-md-8">
						<input style="border:none;outline:none;width:100%;" id="phone" value="<?php echo $Phone;?>"></input>
					</div>
				</div>
				<div class="row col-md-12 texto-1-profe" style="margin-top:2px;">
					<div class=" col-md-4">
						Direcci&oacute;n:
					</div>
					<div class=" col-md-8">
						<input style="border:none;outline:none;width:100%" id="address" value="<?php echo $Address; ?>"></input>
					</div>
				</div>
				<div class="row col-md-12 texto-1-profe" style="margin-top:2px;">
					<div class=" col-md-4">
						E-Mail:
					</div>
					<div class="row col-md-8">
						<span> <?php echo $Email;?></span>
					</div>
				</div>
				<div class="row col-md-12 texto-1-profe" style="margin-top:2px;">
					<div class=" col-md-4">
						Fecha de Nacimiento:
					</div>
					<div class=" col-md-8">
						<input class="datepicker" style="border:none;outline:none;width:100%" name="birthday" id="birthday" value="<?php echo ($DayBorn) ? $DayBorn . '-' . $MonthBorn . '-' . $YearBorn : '';?>" data-date="12-02-2012" type="text"></input>
					</div>
				</div>
				<div class="row col-md-12">
					<button type="button" class="btn btn-agregar btn-update" style="margin:auto;display:block;">Actualizar</button>
				</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-6">
			<div class="container col-md-12">
  				<hr id="separador-busqueda2"></hr>
   				<form action="<?php echo base_url('registro/validatePage'); ?>" method="post" role="form" enctype="multipart/form-data" id="mainform">
    				<p id="terminos"><input type="checkbox" name="terms" required <?php if($terms=="1") echo"checked";?>> Autorizo a Superprofe.co a publicar los datos suministrados en este documento con el fin de que los estudiantes que requieren profesores particulares tengan acceso a mi información, los siguientes datos NO serán publicados: teléfono, celular, dirección, correo electrónico y referencias. </p>
    				<span id="terminos"> <a>Acepto los t&eacute;rminos y condiciones.</a> </span>
    				<div class="row">
     					<div class="container col-md-3 col-md-offset-2">
      					<button type="submit" class="btn-siguiente-registro btn" id="btnlogin"><div>Continuar</div></button>
     					</div>
    				</div>
   				</form>
  			</div>
		</div>	
	</div>		
		

	
		


		
		

	


	

<div class="amigas-separator"></div>
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Actualizando perfil.</h1>
			</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-centered" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php echo "<script>
		base_url = '".base_url()."';
		id_user = '".$id_user."';
		$(document).ready(function(){
			$(\"iframe#video_profe\").attr('src','".$youtube."')
		})</script>";
?>
<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo base_url("assets/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script src="<?php echo base_url("assets/js/profile.js");?>"></script>
<script>
$(".redondo").css("border-radius","10px")
$("span#terminos a").css("cursor","pointer");
$("span#terminos a").mousedown(function(event) {
	$("#legal_modal").fadeIn('500');
});
$(".close").mousedown(function(event) {
	$("#legal_modal").css("display","none")
});
$('[data-toggle="tooltip"]').tooltip();
</script>