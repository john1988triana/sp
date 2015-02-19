<div class="grey-backgorund">
	<div class="container" style="margin-top:80px;">
		<div class="row container estudiante-container">			
			<div class="col-md-4 perfil-col">		
				<h3 style="color:#009966; text-align:center;"><?php echo $FirstName ?></h3>
				<div>
					<img src="<?php echo base_url($picture); ?>" class="img-profile">
				</div>
				<div>
					<div class="btn-subir-foto btn btn-radius" id="texto_foto" onclick="getFile()">
						<p>Subir foto</p>
						<img src="assets/img/upload-icon.png">
					</div>
					<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" name="userfile" type="file" value="upload" onchange="sub(this)"/></div>
				</div>
				<div class="texto-1-profe" style="margin-top:2px;">
					<div>
						<p class="label-form">Ciudad:</p>
					</div>
					<div class="input-div">
						<p>Bogotá - Colombia</p>
					</div>
				</div>
				<div class=" texto-1-profe">
					<div>
						<p class="label-form">Telefono:</p>
					</div>
					<div>
						<input class="btn-radius" style="border:none;outline:none;width:100%;" id="phone" value="<?php echo $Phone;?>"></input>
					</div>
				</div>
				<div class="texto-1-profe" style="margin-top:2px;">
					<div>
						<p class="label-form">Direcci&oacute;n:</p>
					</div>
					<div>
						<input class="btn-radius" style="border:none;outline:none;width:100%" id="address" value="<?php echo $Address; ?>"></input>
					</div>
				</div>
				<div class="texto-1-profe" style="margin-top:2px;">
					<div>
						<p class="label-form">E-Mail:</p>
					</div>
					<div class="input-div">
						<span><p><?php echo $Email;?></P></span>
					</div>
				</div>
				<div class="texto-1-profe">
					<div>
						<p class="label-form">Fecha de Nacimiento:</p>
					</div>
					<div>
						<input class="datepicker" style="border:none;outline:none;width:40%" name="birthday" id="birthday" value="<?php echo ($DayBorn) ? $DayBorn . '-' . $MonthBorn . '-' . $YearBorn : '';?>" data-date="12-02-2012" type="text"></input>
					</div>
				</div>
				<div class="tutor-group texto-1-profe" style="display:none;">
					<div>
						<div>
							<p class="label-form">Nombre del Acudiente:</p>
						</div>
						<div>
							<input class="btn-radius" style="border:none;outline:none;width:100%" id="tutorFName" value="<?php echo isset($tutorFirstName) ? $tutorFirstName:""; ?>"></input>
						</div>
					</div>
					<div>
						<div>
							<p class="label-form">Apellido del Acudiente:</p>
						</div>
						<div>
							<input class="btn-radius" style="border:none;outline:none;width:100%" id="tutorLName" value="<?php echo isset($tutorLastName) ? $tutorLastName:""; ?>"></input>
						</div>
					</div>
					<div>
						<div>
							<p class="label-form">Teléfono del Acudiente:</p>
						</div>
						<div>
							<input class="btn-radius" style="border:none;outline:none;width:100%" id="tutorPhone" value="<?php echo isset($tutorPhone) ? $tutorPhone:""; ?>"></input>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-agregar btn-update btn-radius btn-subir-foto  btn-act" id="btn-save-schedule" style="margin:auto;display:block;">Actualizar</button>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-7 perfil-col">
				<div>
					<h3>Trayectoria acad&eacute;mica</h3>
					<div class="amigas-separator"></div>

					<h3>Estudios</h3>
						<div id="exp-wrapper-est">
						<?php 
							for( $i = 0; $i < count($studies) ; $i++){
								$end = $studies[$i]["to"];
								if($end == "0000-00-00"){
									$end = "Actualmente";
								}else{
									$end = date("Y",strtotime($studies[$i]["to"]));
								}
								if($studies[$i]["title"] != ""){
									$study_title = $studies[$i]["title"];
								}
								else {
									$study_title = "&nbsp;";
								}
								echo "<div class=\"form-group textarea estudios-estudiante\" >

									<div class='estudios-grid'>Institución:</div><span><div class='estudios-grid'>".$studies[$i]["institution"]."</div></span><br>

									<div class='estudios-grid'>Profesión:</div><span><div class='estudios-grid'>".$study_title."</div></span><br>
									<div class='estudios-grid'>Año:</div><span><div class='estudios-grid'>".date("Y",strtotime($studies[$i]["from"]))." hasta ".$end."</div></span>
									<div class=\"delete-group exp\" data-id=\"".$studies[$i]["id"]."\"></div>
									<div class=\"amigas-separator\"></div>
								</div>";
							}
						?>
						</div>
					<button type="button" class="btn btn-subir-foto btn-radius btn-estudios" id="show_estudios">
						<p>Actualizar mi<br>
						nivel académico</p>
						<img src="assets/img/estudios-icon.png">
					</button>
					<div class="amigas-separator"></div>
					<!--div oculto-->
					<div class="form-group" id="hide_estudios" style="display:none">
						<label for="add_empresa">Centro de estudios</label>
						<input type="text" placeholder="" class="form-control btn-radius" id="add_universidad" >
						
						<label for="">Nivel</label>
						<select id="level" class="form-control level btn-radius" value="">
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
						
						<label for="cbo_fecha_inicial">Fechas de estudio</label>
						<div class="row">
							<div class="col-md-4">
								<!--<input type="text" placeholder="Año inicio" class="form-control input-sm" id="add_anio_estu_desde" >-->
								<select class="form-control input-sm btn-radius" id="add_anio_estu_desde">
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
								<select class="form-control input-sm btn-radius" id="add_anio_estu_hasta " >
								<?php
									$anio_actual = date("Y");
									$opciones = "<option value=\"-\">Actualmente</option>";
									for ($anio=$anio_actual; $anio >= 1950; $anio--)
										$opciones .= "<option value=\"".$anio."\">".$anio."</option>";
									
									echo $opciones;
								?>
								</select>
							</div>
						</div>
						<label for="cbo_fecha_inicio">Titulo</label>
						<input type="text" placeholder="" class="form-control btn-radius" id="add_titulo_obtenido" >
						<div class="form-group">
							<button type="button" class="btn btn-agregar btn_agregar_estudios btn-radius btn-act" style="margin-top:1.5%">Agregar</button>
						</div>
					</div>  
				</div>					
			</div>
		</div>
	</div>
</div> 


<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h1>Actualizando...</h1>

			</div>

			<div class="modal-body">

				<div class="progress">

					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>

				</div>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

			</div>

		</div>

	</div>

</div>



<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<script src="<?php echo base_url("assets/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
<script>
$(".btn-update").click(function(){
	var birthday =$("#birthday").val().split("-");
	var data = {
		phone:$("#phone").val(),
		address:$("#address").val(),
		dayBorn:birthday[0],
		monthBorn:birthday[1],
		yearBorn:birthday[2]};
	if($("#tutorPhone").val()!=""){
		data.tutorPhone = $("#tutorPhone").val();
	}
	if($("#tutorLName").val()!=""){
		data.tutorLastName = $("#tutorLName").val();
	}
	if($("#tutorFName").val()!=""){
		data.tutorFirstName = $("#tutorFName").val();
	}
	
	$("#pleaseWaitDialog").modal();
	$.post("<?php echo base_url("perfil/actualizar"); ?>", data)
	  .done(function( data ) {
		$("#pleaseWaitDialog").modal("hide");
		swal({
			title: "Listo!",
			text: "Actualización exitosa",
			type: "success",
			confirmButtonText: "Aceptar" },
			function(){
				
			});
	  });
});
$(".btn_agregar_estudios").click(function(){
	var studies = {
			institution:$("#add_universidad").val(),
			title:$("#add_titulo_obtenido").val(),
			id_level:$("#level option:selected").val(),
			from:$("#add_anio_estu_desde").val()+"-01-01",
			to:$("#add_anio_estu_hasta").val()+"-01-01",
		}
		console.debug(studies);
		$.post("<?php echo base_url("perfil/estudios"); ?>",studies,function(rta){
			var end = "";
			if(studies.to == "--01-01"){
				end = "Actualmente";
			}else{
				end = studies.to.split("-")[0];
			}
			var div = "<div class=\"form-group\" class=\"col-xs-3\">"+
						"<h5>Institución:</h5> <h5><span>"+studies.institution+"</span></h5>"+
						"<h5>Titulo:</h5> <h5><span>"+studies.title+"</span></h5>"+
						"<h5>Año: <b>"+studies.from.split("-")[0]+" hasta "+end+"</b></h5>"+
						"<div class=\"delete-group exp\" data-id=\""+rta+"\"></div>"+
						"<div class=\"amigas-separator\"></div>"+
				  "</div>";
			$("#exp-wrapper-est").append(div);
			$('#hide_estudios').toggle("fast");
		});
});
$("#show_estudios").click(function(){
        $('#hide_estudios').toggle("fast");
    });
$(".datepicker").datepicker({format:"dd-mm-yyyy",viewMode:"years"}).on('changeDate', function(ev){
	var before = new Date();
	before.setFullYear(before.getFullYear()-18);
    if (ev.date.valueOf() > before.valueOf()){
		$(".tutor-group").show("fast");
    }else{
		$(".tutor-group").hide("fast");
	}
  });
$(document).ready(function(){
	var val = $(".datepicker").val().split("-");
	if(val.length == 3){
		var birthday = new Date();
		birthday.setFullYear(val[2]);
		birthday.setMonth(val[1]-1);
		birthday.setDate(val[0]);
		var before = new Date();
		before.setFullYear(before.getFullYear()-18);
		if (birthday.valueOf() > before.valueOf()){
			$(".tutor-group").show("fast");
		}else{
			$(".tutor-group").hide("fast");
		}
	}
});
function getFile(){
	document.getElementById("upfile").click();
}
 function sub(obj){
	var file = obj.value;
	var fileName = file.split("\\");
	document.getElementById("texto_foto").innerHTML = fileName[fileName.length-1];
	
	var fd = new FormData();
	fd.append("userfile", obj.files[0]);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', "<?php echo base_url("perfil/savePicture"); ?>", true);
	xhr.onload = function() {
		if (this.status == 200) {
			$(".img-profile").attr("src",this.response);
			
		};
	};
	xhr.send(fd);
	event.preventDefault();
}
</script>