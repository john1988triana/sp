<div class="modal fade in" id="legal_modal" tabindex="-1" role="dialog" aria-labelledby="legalModal" aria-hidden="false" style="display: none;">
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
<div class="container" style="margin-top:120px;">
	<div class="error"><?php echo $error;?></div>
	<div class="row steps-center">
		<div class="col-md-12" id="circles" style="">
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn1_ok.png'));?>" alt="">
				<p class="text-center">Reg&iacute;strate</p>
			</div>
			<div class="col-md-3">
			<a href="<?php echo (base_url('registro/datos_personales'));?>">
				<img src="<?php echo (base_url('assets/img/btn2_ok.png'));?>" alt="">
				<p class="text-center">Completa tus datos</p> 
			</a>
			</div>
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn3.png'));?>" alt="">
				<p class="text-center">Crea tu p&aacute;gina</p>
			</div>
			<div class="col-md-3">
				<a style="cursor:pointer" onclick="document.getElementById('mainform').submit(); event.preventDefault();">
					<img src="<?php echo (base_url('assets/img/btn4.png'));?>" alt="">
					<p class="text-center">Estamos validando tu cuenta</p>
				</a>
			</div>  
		</div>
	</div>
	<div class="col-md-12 container borde-perfil-profe">
		<div class="row col-md-12">
			<div class="col-md-5">		
				<h3 style="color:#009966; text-align:center;"><?php echo $FirstName." ".$FamilyName ?></h3>
				<div>
					<img src="<?php echo base_url($picture); ?>" class="img-profile">
				</div>
				<div>
					<div class="btn-subir-foto btn" id="texto_foto" onclick="getFile()">Subir foto</div>
					<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" name="userfile" type="file" value="upload" onchange="sub(this)"/></div>
				</div>
				<h4 class="texto-1-profe">Ciudad: Bogotá-Colombia</h4>
				<h4 class="texto-1-profe">Telefono: <?php echo $Phone;?></h4>
				<h4 class="texto-1-profe">Direcci&oacute;n: <?php echo $Address; ?></h4>
				<h4 class="texto-1-profe">E-Mail:<span> <?php echo $Email;?></span></h4>
			</div>      
			<div class="col-md-7">
				<div class="col-md-offset-1" style="margin-top:30px">
					<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Si tienes un código promocional ingresalo, de lo contrario deja este espacio en blanco"></span>
					<h4>Ingresa tu código de Activación de Aulas Amigas:</h4>
					<input type="text" class="form-control" placeholder="">
				</div>
				<div class="clearfix"></div>

				<h4 class="col-md-offset-1">Ingresa tu disponibilidad:</h4>
				<span class="glyphicon glyphicon-question-sign prf embed-responsive-item" src="//www.youtube.com/embed/x97biL1lKBE" data-toggle="tooltip" data-placement="right" title="Da clic sobre el calendario para seleccionar los días y horas en los que tienes disponibilidad para dar clases si tienes alguna inquietud puedes ver el siguiente video">
					
				</span>
				<div class="col-md-offset-1" id="calendar"></div>
				<button type="button" class="col-md-offset-3 btn btn-agregar" id="btn-save-schedule" style="margin-top:1.5%">Actualizar disponibilidad</button>

				<!--<div class="row" style="display:none">-->
				<div class="row">
					<div class="col-md-12 alert text-center mensaje-busqueda-realizada">
						<p style="font-weight: bold;"> Tu disponibilidad ha sido actualizada con exito!</p>
					</div>
				</div>
				<!--</div>-->

			</div>
		</div>
	</div>

	<div class="container col-md-12 borde-perfil-profe2">
		<div class="col-md-4 columna-reg-3 profe-features">

			<h3>Trayectoria profesional y acad&eacute;mica</h3>
			<div class="amigas-separator"></div>
			<div id="hide_profile" class="form-group textarea">

				<label for="">Agrega una corta Descripción de tu perfil</label>
				<textarea class="form-control" id="descri_per" rows="3" placeholder="<?php echo $profile; ?>" ><?php echo $profile; ?></textarea>

				<div class="form-group">
					<button type="button" class="btn btn-agregar btn_agregar_descrip" style="margin-top:1.5%">Guardar</button>
				</div>

				<!--<div class="row" style="display:none">-->
				<div class="row">
					<div class="col-md-12 alert text-center mensaje-busqueda-realizada">
						<p style="font-weight: bold;"> Tu perfil profesional ha sido guardado con exito!"</p>
					</div>
				</div>
				<!--</div>-->
			</div>
			
			<h3>Experticia</h3>
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Da clic en agregar nueva competencia y su nivel"></span>
			<button type="button" class="btn btn-link" id="show_competencias">Agregar nueva competencia y su nivel</button>
			<div class="amigas-separator"></div>
			<!--div oculto-->
			<div class="form-group" id="hide_competencias" style="display:none">
				<label for="">Competencia</label>
					<select name="area" class="form-control competen" value="">
						<option value="-">-</option>
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
					<label for="">Nivel de Competencia</label>
					<select name="level" class="form-control level" value="">
						<option value="-">-</option>
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
							echo "<div class=\"numero-competencia\">".($i+1)."</div><div class=\"valor-competencia\">".$selected_areas[$i]->Name." - ".$selected_areas[$i]->level."</div><div class=\"borrar-competencia\" data-id=\"".$selected_areas[$i]->id_area."\">X</div><br>";
					}
				?>
				</div>
			<input type="hidden" id="lanzar_area" value="<?php echo "";//$experticia["id_area"]?>">

			
			<h3>Experiencia</h3>
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Esta es la experiencia laboral que tiene este Profesor"></span>
				<div id="exp-wrapper-pro">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==1){ //id for educational exp 
							continue;
						}
						echo "<div class=\"form-group\" class=\"col-xs-3\">
								<h5>Institución: <b>".$experience[$i]["institution"]."</b></h5>
								<h5>Titulo: <b>".$experience[$i]["title"]."</b></h5>
								<h5>Año: <b>".date("Y-m",strtotime($experience[$i]["from"]))." hasta ".date("Y-m",strtotime($experience[$i]["to"]))."</b></h5>
								<div class=\"delete-group exp\" data-id=\"".$experience[$i]["id"]."\"></div>
								<div class=\"amigas-separator\"></div>
						  </div>";
					}
				?>
				</div>
			<button type="button" class="btn btn-link" id="show_experiencias">Agregar más experiencia</button> 
			<div class="amigas-separator"></div>
			<!--div oculto-->
			<div class="form-group" id="hide_experiencias" style="display:none">
				<label for="add_empresa">Nombre de la empresa</label>
				<input type="text" name="institution" class="form-control" id="add_empresa" >

				<label for="cbo_fecha_inicio">Cargo</label>
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


			<h3>Estudios</h3>
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Estos son los estudios que tiene este profesor"></span>

				<div id="exp-wrapper-est">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==0){ //id for laboral exp 
							continue;
						}
						echo "<div class=\"form-group textarea\" >
							<h5>Institución: <b>".$experience[$i]["institution"]."</b></h5>
							<h5>Profesión:<b>".$experience[$i]["title"]."</b></h5>
							<h5>Año: <b>".date("Y",strtotime($experience[$i]["from"]))." hasta ".date("Y",strtotime($experience[$i]["to"]))."</b></h5>
							<div class=\"delete-group exp\" data-id=\"".$experience[$i]["id"]."\"></div>
							<div class=\"amigas-separator\"></div>
						</div>";
					}
				?>
				</div>
			<button type="button" class="btn btn-link" id="show_estudios">Actualizar mi nivel académico</button>
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

			<h3>Referencias profesionales</h3>
				<div id="ref-wrapper-pro">
				<?php 
					for( $i = 0; $i < count($reference) ; $i++){
						if($reference[$i]["type"]==1){ //id for personal reference 
							continue;
						}
						echo "<div class=\"form-group textarea\" >
							<h5>Nombre: <b>".$reference[$i]["name"]."</b></h5>
							<h5>Cargo:<b>".$reference[$i]["title"]."</b></h5>
							<h5>Teléfono:<b>".$reference[$i]["phone"]."</b></h5>
							<h5>Dirección: <b>".$reference[$i]["address"]."</b></h5>
							<div class=\"delete-group ref\" data-id=\"".$reference[$i]["id"]."\"></div>
							<div class=\"amigas-separator\"></div>
						</div>";
					}
				?>
				</div>
			<button type="button" class="btn btn-link" id="show_referencias">Actualizar mis referencias profesionales</button>
				
			<div class="amigas-separator"></div>

			<div class="form-group" id="hide_referencias" style="display:none"> 
				<label for="">Nombre</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_nombre_ref_pro"></textarea>
				<label for="">Cargo</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_role_ref_pro"></textarea>
				<label for="">Telefóno</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_telef_ref_pro"></textarea>
				<label for="">Dirección</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_direccion_ref_pro"></textarea>
				<div class="form-group">
					<button type="button" class="btn btn-agregar btn_agregar_referencias_pro" style="margin-top:1.5%">Agregar</button>
					<!--<a href="" class="btn btn-info form-control"><span class="glyphicon glyphicon-refresh"></span>Actualizar información</a>-->
				</div>
			</div>
			<!--<div class="form-group textarea">
				<h5>Nombre: <b>N</b></h5>
				<h5>Telefóno: <b>N</b></h5>
				<h5>Dirección: <b>N</b></h5>
			</div>-->    

			<h3>Referencias personales</h3>
				<div id="ref-wrapper-per">
				<?php 
					for( $i = 0; $i < count($reference) ; $i++){
						if($reference[$i]["type"]==0){ //id for laboral ref 
							continue;
						}
						echo "<div class=\"form-group textarea\" >
							<h5>Nombre: <b>".$reference[$i]["name"]."</b></h5>
							<h5>Parentezco:<b>".$reference[$i]["title"]."</b></h5>
							<h5>Teléfono:<b>".$reference[$i]["phone"]."</b></h5>
							<h5>Dirección: <b>".$reference[$i]["address"]."</b></h5>
							<div class=\"delete-group ref\" data-id=\"".$reference[$i]["id"]."\"></div>
							<div class=\"amigas-separator\"></div>
						</div>";
					}
				?>
				</div>
				
			<button type="button" class="btn btn-link" id="show_referenciasper">Actualizar mis referencias personales</button>
				
			<div class="amigas-separator"></div>
			<div class="form-group" id="hide_referenciasper" style="display:none"> 
				<label for="">Nombre</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_nombre_ref_per"></textarea>
				<label for="">Parentezco</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_role_ref_per"></textarea>
				<label for="">Telefóno</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_telef_ref_per"></textarea>
				<label for="">Dirección</label>
				<textarea class="form-control" rows="1" placeholder="" id="add_direccion_ref_per"></textarea>
				<div class="form-group">
					<button type="button" class="btn btn-agregar btn_agregar_referencias_per" style="margin-top:1.5%">Agregar</button>
					<!--<a href="" class="btn btn-info form-control"><span class="glyphicon glyphicon-refresh"></span>Actualizar información</a>-->
				</div>
			</div>
		</div>
		<div class="col-md-8">		
			<div class="col-md-offset-1">
				<div class="row col-md-12">
					<form class="navbar-form navbar-left" role="search"><h3>Ingrese el link del video de Youtube</h3>
					  <div class="form-group">
						<input type="text" class="form-control link_youtube" placeholder="Link">
					  </div>
				
					  <!--<button type="button" class="btn btn-default video_you">Colgar</button>-->
					</form>
				</div>
				<div class="row col-md-10">
					<iframe width="618" height="380" id="video_profe">
					</iframe>
				</div>
				<div class="row col-md-10 col-md-offset-2">
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-agregar btn_agregar_video" style="margin-top:7.5px">Agregar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="container col-md-12">
		<hr id="separador-busqueda2"></hr>
			<form action="<?php echo base_url('registro/validatePage'); ?>" method="post" role="form" enctype="multipart/form-data" id="mainform">
				<p id="terminos"><input type="checkbox" name="terms" required <?php if($terms=="1") echo"checked";?>> Autorizo a Superprofe.co a publicar los datos suministrados en este documento con el fin de que los estudiantes que requieren profesores particulares tengan acceso a mi información, los siguientes datos NO serán publicados: teléfono, celular, dirección, correo electrónico y referencias. </p>
				<span id="terminos"> <a>Acepto los t&eacute;rminos y condiciones.</a> </span>
				<div class="row">
					<div class="container col-md-3 col-md-offset-4">
						<button type="submit" class="btn-siguiente-registro btn" id="btnlogin"><div>Continuar</div></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> 

<div class="amigas-separator"></div>
<?php echo "<script>
		base_url = '".base_url()."';
		id_user ='".$this->session->userdata("sIdUser")."';
		$(document).ready(function(){
			$(\"iframe#video_profe\").attr('src','".$youtube."')
		})
	</script>"
?>
<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo (base_url('assets/js/datepicker/js/locales/bootstrap-datepicker.es.js')); ?>"></script>
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
$('[data-toggle="tooltip"]').tooltip()
</script>