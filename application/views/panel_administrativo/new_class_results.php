<div class="md-col-12">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<table class="pfs table table-striped table-bordered" >
				<tbody>
					<tr>
						<td>Email</td>
						<td id="user-email" ><?php if(isset($Email))echo $Email;else echo $this->input->get("email"); ?></td>
					</tr>
					<tr>
						<td>Nombre</td>
						<td><input id="firstName" class="form-control" value="<?php if(isset($FirstName))echo $FirstName; ?>"></input></td>
					</tr>
					<tr>
						<td>Apellido</td>
						<td><input id="lastName" class="form-control" value="<?php if(isset($FamilyName))echo $FamilyName; ?>"></input></td>
					</tr>
					<tr>
						<td>País de Residecia</td>
						<td>
							<select id="country" class="form-control">    		   
							<?php 
								foreach($countries as $key => $value_countries){
									$value = $value_countries['IdCountry'] . '_' . $value_countries['Name'];
									if($value_countries['IdCountry'] == $Country){
										?>
											<option value="<?php echo $value; ?>" code="<?php echo $value_countries['Code']; ?>" selected="selected"><?php echo $value_countries['Name'];?></option>
										<?php
									}else{
										?>
											<option value="<?php echo $value; ?>" code="<?php echo $value_countries['Code']; ?>"><?php echo $value_countries['Name'];?></option>
										<?php
									}
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Ciudad</td>
						<td>
							<select id="city" class="form-control"></select>
						</td>
					</tr>
					<tr>
						<td>Dirección</td>
						<td><input id="address" class="form-control" value="<?php if(isset($Address))echo $Address; ?>"></input></td>
					</tr>
					<tr>
						<td>Tipo de Documento</td>
						<td><select id="docType" class="form-control">  
							<?php foreach($document_type as $value_document_type){
									if($DocType == $value_document_type['id_doctype']){?>
											<option value="<?php echo $value_document_type['id_doctype'];?>" selected="selected"><?php echo $value_document_type['name']; ?></option>
										<?php
									}else{
										 ?>
											<option value="<?php echo $value_document_type['id_doctype'];?>"><?php echo $value_document_type['name']; ?></option>
										<?php
									}	                                                    
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Documento</td>
						<td><input id="doc" class="form-control" value="<?php if(isset($DocNumber))echo $DocNumber; ?>"></input></td>
					</tr>
					<tr>
						<td>Fecha de Nacimiento</td>
						<td><input id="birthday" class="form-control datepicker_birth" value="<?php if(isset($DayBorn))echo $DayBorn."-".$MonthBorn."-".$YearBorn; ?>"></input></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><input id="phone" class="form-control" value="<?php if(isset($Phone))echo $Phone; ?>"></input></td>
					</tr>
					<tr>
						<td>Móvil</td>
						<td><input id="mobile" class="form-control" value="<?php if(isset($Movil))echo $Movil; ?>"></input></td>
					</tr>
					<tr>
						<td>Genero</td>
						<td>
                        <select name="gender" id="gender" class="form-control" >
								<option value="0" <?php if($Gender == 0) echo "selected"?> >Masculino</option>
                                <option value="1" <?php if($Gender == 1) echo "selected"?> >Femenino</option>
                        </select>
                        
                        
                        </td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Actualizar Datos" onclick="updateStudent()"></input></td>
					</tr>
				</tbody>
			</table>
			<div class="row well panel_busqueda classTable" style="width:auto;margin:auto;">
			<!--Formulario para enviar los datos de consulta-->
				<!--Area-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="area">En que &Aacute;rea Necesitas Profesor?:</label>
							<select name="area" id="area" class="form-control col-md-9" >
								<option value="">&Aacute;rea</option>
								<?php 
									$areas = json_decode($areas, true);
									foreach ($areas as $key => $value_areas) {
								?> 
									<option value="<?php echo $value_areas['IdArea']; ?>">
										<?php echo $value_areas['Name']; ?>
									</option>
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
							<label for="tema">Escribe la Tem&aacute;tica que Requieres:</label>
							<input type="text" name="topic" id="topic" class="form-control col-md-9" placeholder="Ej: Factorización" >
						</div>
							<div class="error"><?php echo $errors["topic"]; ?></div>
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
									<option value="<?php echo $value['id'];?>">
										<?php echo utf8_decode($value['name']); ?>
									</option> 
								<?php
									}
								?>      
							</select>
						</div>
							<div class="error"><?php echo $errors["level"]; ?></div>
					</div>
					
					<!--Fecha -->
					<div class="row">
						<div class="col-md-6 txt-busqueda">
							<label for="tema">Cuando Quieres la Clase?</label>							
							<div class="input-append date" data-date-format="dd-mm-yyyy">
							  <input class="span2 form-control datepicker" name="date" size="16" id="date" type="text">
							  <span class="add-on"><i class="icon-th"></i></span>
							</div>
							<div class="error"><?php echo $errors["date"]; ?></div>
						</div>
						<div class="col-md-6 txt-busqueda">
							<label for="time">En que Horario Quieres Recibirla?</label>
							<select name="time" id="time" class="form-control">
								<option value="">opción</option>
								<option value="7" >7:00 am</option>
								<option value="8" >8:00 am</option>
								<option value="9" >9:00 am</option>
								<option value="10">10:00 am</option>
								<option value="11">11:00 am</option>
								<option value="12">12:00 pm</option>
								<option value="13">1:00 pm</option>
								<option value="14">2:00 pm</option>
								<option value="15">3:00 pm</option>
								<option value="16">4:00 pm</option>
								<option value="17">5:00 pm</option>
								<option value="18">6:00 pm</option>
								<option value="19">7:00 pm</option>
							</select>
							<div class="error"><?php echo $errors["time"]; ?></div>
						</div>
					</div>

					<!--Boton buscar que ejecuta la consulta-->
					<div class="row">
						<div class="col-md-12">
							<label for=""></label>
							<input type="submit" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Encontrar Profesor">
						</div>
					</div>
			</div>
		</div>
		<div class="col-md-12" id="results">
		</div>
		<section class="container" id="teacher-detail" style="display:none">
	<div class="col-md-4" style="border-right-style: dashed;border-right-width: 2px;">
		<h3 class="text-center" id="detail-name" style="color:#009966;"></h3>
		<div class="panel-body text-center">
			<img class="img-profile" id="detail-image" style="margin: 0px auto;" src="">
			<div class="estrellas" id="detail-stairs">
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span> 
				<span class="glyphicon glyphicon-star"></span> 
				<span class="glyphicon glyphicon-star"></span> 
				<span class="glyphicon glyphicon-star"></span>    
			</div>
			<h4 class="par" id="detail-city">Ciudad:</h4>      
			<h4 class="par" id="detail-area">Area: </h4>
			<h4 class="par" id="detail-price">precio: <span style="color:#00B85C;"></span></h4>
			<h3 class="text-center" style="color:#009966;">PERFIL</h3>
			<p id="detail-profile"></p>
		</div>
	</div>
	<div class="col-md-8">
		<h3 class="text-center" style="color:#009966;">FORMACIÓN ACADEMICA</h3>
		<p id="detail-studies"></p>
		<h3 class="text-center" style="color:#009966;">EXPERIENCIA LABORAL</h3>
		<p id="detail-exp"></p>
	</div>
</section>
<section class="container" id="teacher-availability" style="display:none">
	<div class="col-md-5">
		<span class="calendar-instructions">Arrasta el cuadro verde para ajustar la hora de clase. Recuerda que debes moverlo en los espacios disponibles del profesor</span>
		<div id="calendar"></div>
		<div class="legend">
			<div style="float:left;"><div class="black-square"></div>No Disponible</div>
			<div style="float:left;"><div class="white-square"></div>Disponible</div>
			<div style="float:left;"><div class="green-square"></div>Clase</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="promo-section">
			<h4 style="text-align:center;">Si tienes un código promocional digítalo aquí:</h4>
			<input class="promo-code" type="text"></input>
			<div class="clearfix"></div>
			<button type="submit" class="btn-schedule btn" onclick="saveClass();">Programar mi clase</button>
		</div>
	</div>
</section>
	</div>
</div>
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 id="h1_wait">&nbsp;</h1>
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
<script src="<?php echo (base_url('assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script>
var request ={};
function isOverlapping(event){
		var array = $('#calendar').fullCalendar('clientEvents');
		for(i in array){
			if(array[i]._id != event._id){
				if(!(array[i].start.format() > event.end.format() || array[i].end.format() < event.start.format())){
					return true;
				}
			}
		}
		return false;
	}
var base_url = "<?php echo base_url("");?>";
function saveClass(){
	$("#h1_wait").text("Agendando clase");
	$("#pleaseWaitDialog").modal();
	var data = {
		"address":request.address,
		"city":request.city,
		"end":request.end.format("YYYY-MM-DD, HH:mm:ss"),
		"start":request.start.format("YYYY-MM-DD, HH:mm:ss"),
		"level":$("#level option:selected").val(),
		"id_area":request.id_area,
		"id_professor":request.id_professor,
		"student_email":$("#user-email").text(),
		"price":request.price,
		"topic":request.topic,
		"phone":$("#phone").val() + " " + $("#mobile").val()
	};
	$.post(base_url+"administrador/agendar",data,function(resp){
		$("#pleaseWaitDialog").modal("hide");
		swal({
			title: "Listo!",
			text: "La clase fue agendada exitosamente",
			type: "success",
			confirmButtonText: "Aceptar" },
			function(){
				window.location.href = "/administrador/clases/nueva";
			});
	});
}
$(".datepicker").datepicker({format: 'dd-mm-yyyy',
	language: "es",
	autoclose: true,
	startDate: "+1d"
	});

$(".datepicker_birth").datepicker({format: 'dd-mm-yyyy',
	language: "es",
	autoclose: true
	});
	
$("#classButton").click(function(){
	$("#classTable").toggle();
});
$(".btn-busqueda-profe").click(function(){
	if($("#city option:selected").val().split("_")[0] == ""){
		$(".modal-header h1").html("Error.");
		$(".modal-body").html('Se debe elegir una ciudad valida');
		$("#pleaseWaitDialog").modal();
		return;
	}
	var data = {
		area:$("#area option:selected").val(),
		topic:$("#topic option:selected").val(),
		level:$("#level option:selected").val(),
		city:$("#city option:selected").val().split("_")[0],
		address:$("#address").val(),
		phone:$("#phone").val(),
		date:$("#date").val(),
		time:$("#time option:selected").val()
	}
	$.post(base_url+"administrador/buscar",data,function(resp){
		var rta = JSON.parse(resp);
		if(rta.length == 0){
			$(".modal-header h1").html("No hay profesores disponibles.");
			$(".modal-body").html('No hay profesores disponibles en el horario elegido');
			$("#pleaseWaitDialog").modal();
			return;
		}
		$("#results").html("");
		var http = new XMLHttpRequest();
		http.open("GET",base_url+"application/views/panel_administrativo/professor_thumb.html",false);
		http.send();
		var template = http.responseText;
		for(var i in rta){
			var item = template.replace("{{FIRST_NAME}}",rta[i].firstName);
			item = item.replace("{{LAST_NAME}}",rta[i].lastName);
			item = item.replace("{{IMAGE}}",rta[i].Image =="assets/img/default.png" ?base_url+"assets/img/logo_superprofe.svg" : base_url+rta[i].Image);
			item = item.replace("{{CITY}}",$("#city option:selected").text());
			item = item.replace("{{AREA}}",$("#area option:selected").text());
			item = item.replace("{{PRICE}}",parseFloat(rta[i].price)+parseFloat(rta[i].fee_sp));
			item = item.replace("{{RATE}}",rta[i].rate);
			for(var j = 1 ; j <= 5 ; j++){
				if(j<= rta[i].rate){
					item = item.replace("{{COLOR}}","#FFCC00");
				}else{
					item = item.replace("{{COLOR}}","#666");
				}
			}
			item = item.replace("{{ID_USER}}",rta[i].id_user);
			item = item.replace("{{FIRST_NAME}}",rta[i].firstName);
			item = item.replace("{{LAST_NAME}}",rta[i].lastName);
			item = item.replace("{{IMAGE}}",rta[i].Image =="assets/img/default.png" ?base_url+"assets/img/logo_superprofe.svg" : base_url+rta[i].Image);
			item = item.replace("{{ID_CITY}}",rta[i].City);
			item = item.replace("{{ID_AREA}}",$("#area option:selected").val());
			item = item.replace("{{ADDRESS}}",$("#address").val());
			item = item.replace("{{TOPIC}}",$("#topic").val());
			item = item.replace("{{PRICE}}",parseFloat(rta[i].price)+parseFloat(rta[i].fee_sp));
			item = item.replace("{{DATE}}",$("#date").val()+" "+$("#time option:selected").val()+":00");
			$("#results").append(item);
		}
	});
});
function refreshTeacherDetail(id,firstName,lastName,image,rate,price,city,area,address,topic,date){
		request.id_professor = id;
		request.price = price;
		request.id_area = area;
		request.city = city;
		request.address = address;
		request.topic = topic;
		var auto = false;
		date = new moment(date,"DD-MM-YYYY H:mm");
		var week = new moment(date).startOf('week');
		$("#teacher-availability").show(500);
		$("#teacher-detail").show(500);
		$("#detail-name").html(firstName +" "+lastName);
		$("#detail-image").attr("src",image=="assets/img/default.png" ? base_url+"assets/img/logo_superprofe.svg":image);
		$("#detail-area").html("Area: "+$("#area option:selected").text());
		$("#detail-city").html("Area: "+city);
		$("#detail-price").html("Precio: "+price);
		$.get(base_url+"perfil/experiencia/"+id,function(resp){
			var exp = JSON.parse(resp);
			$("#detail-exp").html("");
			$("#detail-studies").html("");
			for(var i in exp){
				var experience = exp[i];
				var div = "<div class=\"form-group\" class=\"col-xs-3\">"+
					"<h5>Institució<b>"+experience.institution+"</b></h5>"+
					"<h5>Titulo: <b>"+experience.title+"</b></h5>"+
					"<h5>Año: <b>"+experience.from+" hasta "+experience.to+"</b></h5>"+
					"<div class=\"amigas-separator\"></div>"+
				"</div>";
				if(experience.type == 0){
					$("#detail-exp").append(div);
				}else{
					$("#detail-studies").append(div);
				}
			}
		});
		$.get(base_url+"perfil/info/"+id,function(resp){
			var info = JSON.parse(resp);
			$("#detail-profile").text(info.profile);
		});
		$.get(base_url+"perfil/disponibilidad/"+id,function(resp){
			var freeList = JSON.parse(resp);
			$.get(base_url+"perfil/ajaxClases/"+id+"/"+date.unix(),function(resp){
				var classList = JSON.parse(resp);
				var busyList = [];
				for(var i = 0 ; i < 7 ;i++){
					busyList.push({id:i-1,title:"No disponible",color:"#000",editable:false,
					start: (new moment(week)).hour(7).add(i,'d'),end: (new moment(week)).hour(21).add(i,'d')})
				}
				/** This function inverts the free to busy lapses it initially it suposes the full 
				*	week is busy then removes the lapses of "free" time
				*/
				function splitBusy(day,start,end){
					var l = busyList.length;
					for(var i = 0 ; i<l ; i++){
						if(busyList[i].start.day() == start.day()){
							var toSplit = busyList[i];
							if(toSplit.start >= start && toSplit.end > end){
								//move begining to the end of end
								toSplit.start.hour(end.hour());
							}else if(toSplit.end <= end && toSplit.start < start){
								//move the end to the begining of start
								toSplit.end.hour(start.hour());
							}else if(toSplit.start < start && toSplit.end > end){
								//split in two
								busyList.push({id:busyList.length,
									title:"No disponible",
									color:"#000",
									start: new moment(end),
									end: new moment(toSplit.end),
									editable:false
									})
								toSplit.end.hour(start.hour());
							}else{
								busyList.splice(i,1);
							}
							break;
						}
					}
				}
				for(var i = 0 ; i < freeList.length ;i++){
					var sday = freeList[i].start_day == 0 ? 7: freeList[i].start_day;
					var eday = freeList[i].end_day == 0 ? 7: freeList[i].end_day;
					freeList[i].id = i;
					freeList[i].title = "Disponible";
					freeList[i].start = new moment(week).add(sday-1,"d").add(freeList[i].start_time,"h");
					freeList[i].end = new moment(week).add(eday-1,"d").add(freeList[i].end_time,"h");
					splitBusy(sday,freeList[i].start,freeList[i].end);
				}
				if(auto){ //auto is true when there is no direct match on the time the user request
					date = freeList[0].start;
				}
				for(var i = 0 ; i < classList.length ;i++){
					busyList.push({
						id:busyList.length,
						title:"Agendado",
						editable:false,
						start:new moment(classList[i].start),
						end:new moment(classList[i].end)
					});
				}
				var e = {id:-2,	start:date,end:new moment(date).add(2,'h'),title:"clase",editable:true,color:"#009966"} // class event object
				for(var i = 0 ; i< busyList.length ; i++){
					if(!(busyList[i].start.format() >= e.end.format() || busyList[i].end.format() <= e.start.format())){
						if(busyList[i].start.hours()>9){
							e.start = new moment(busyList[i].start).add(-2,'h');
							e.end = new moment(busyList[i].start);
						}else if(busyList[i].end.hours()<18){
							e.start = new moment(busyList[i].end);
							e.end = new moment(busyList[i].end).add(2,'h');
						}
					}
				}
				busyList.push(e);
				request.start = date;
				request.end = new moment(date).add(2,"h");
				$('#calendar').fullCalendar("removeEvents");
				$('#calendar').fullCalendar({

					header:{left:"",center:"",right:""},

					firstDay:1,

					lang:"es",

					allDaySlot:false,

					slotDuration:"01:00:00",

					axisFormat:'h(:mm)a',

					minTime:"07:00:00",

					maxTime:"21:00:00",

					height:"auto",

					defaultView: 'agendaWeek',

					defaultDate: week,

					eventColor:"#003333",

					selectable: true,

					editable: true,

					selectOverlap: false,

					slotEventOverlap : false,
					
					eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {
						
						var today = moment();
   						var tomorrow = today.add('days', 1);
						tomorrow.startOf('day');
						
						var start_date = moment(event.start.format("DD:MM:YYYY"), "DD:MM:YYYY");
						
						var start_time = moment(event.start.format("HH:mm:ss"), "HH:mm:ss");
						var end_time = moment(event.end.format("HH:mm:ss"), "HH:mm:ss");
						
						var min_time = moment("07:00:00", "HH:mm:ss");
						var max_time = moment("21:00:00", "HH:mm:ss");
						
						if(start_date < tomorrow)
						{
							swal({
								title: "Error!",
								text: "El día de la clase no puede ser pasada, ni ser hoy.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						if((start_time < min_time) || (start_time > end_time)) {
							swal({
								title: "Error!",
								text: "La clase debe iniciar mínimo a las 7:00 am.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if((end_time > max_time) || (start_time > end_time)) {
							swal({
								title: "Error!",
								text: "La clase debe terminar máximo a las 9:00 pm.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if (isOverlapping(event)) {
                            revertFunc();
                        }else{
							request.start = event.start;
							if(event.end){
								request.end = event.end;
							}
						}
					},
					
					eventResize: function(event, delta, revertFunc) {
						
						var start_time = moment(event.start.format("HH:mm:ss"), "HH:mm:ss");
						var end_time = moment(event.end.format("HH:mm:ss"), "HH:mm:ss");
						
						if(end_time.subtract(start_time).hours() <= 1)
						{
							swal({
								title: "Error!",
								text: "La clase debe ser de mínimo dos (2) horas.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if (isOverlapping(event)) {

                            revertFunc();

                        }else{

							request.start = event.start;

							if(event.end){

								request.end = event.end;

							}

						}

					}

				});

				for(var i in busyList){

					$('#calendar').fullCalendar("renderEvent",busyList[i]);

				}
			});
		});
		for(var i=0; i < Math.round(rate); i++){				
			$("#detail-stairs span:nth-child("+(i+1)+")").css("color","#FFCC00");
		}
	}
function updateStudent(){
	
	if($("#phone").val() != "" && $("#phone").val().length >= 7)
	{
		$("#h1_wait").text("Actualizando datos...");
	
		$("#pleaseWaitDialog").modal();
		var row = $(this).parents("tr");
		var data = {
			std:{
				firstName:$("#firstName").val(),
				lastName:$("#lastName").val(),
				firstName:$("#firstName").val(),
				email:$("#user-email").text(),
				birthday:$("#birthday").val(),
				phone:$("#phone").val(),
				mobile:$("#mobile").val(),
				gender:$("#gender option:selected").val(),
				address:$("#address").val(),
				doc:$("#doc").val(),
				docType:$("#docType option:selected").val(),
				city:$("#city option:selected").val(),
				country:$("#country option:selected").val()
			}
		}
		
		$.post(base_url+"administrador/actualizar/estudiante/",data,function(resp){
			var rta = JSON.parse(resp);
			if(rta){
				$("#pleaseWaitDialog").modal("hide");
				swal({
					title: "Listo!",
					text: "La actualización de datos se realizó exitosamente",
					type: "success",
					confirmButtonText: "Aceptar" });
			}
		});
	}
	else
	{
		swal({
				title: "Error!",
				text: "El número de teléfono es obligatorio y debe contener al menos 7 dígitos",
				type: "error",
				confirmButtonText: "Aceptar" });
	}
}
$("#country").change(function(){
	var cod = {Code:$(this).find("option:selected").attr("code")};
	$.post("<?php echo base_url("registro/ajaxCities");?>",cod,function(resp){
		var cities = JSON.parse(resp);
		var options = '<option value="" selected="selected">Selecciona una opción</option>';
		var selected = "<?php echo $City; ?>";
		for(var i in cities){
			if(cities[i].ID == selected){
				options += "<option value='"+cities[i].ID+"_"+cities[i].Name+"' selected>"+cities[i].Name+"</option>";
			}else{
				options += "<option value='"+cities[i].ID+"_"+cities[i].Name+"'>"+cities[i].Name+"</option>";
			}
		}
		$("#city").html(options);
	});
	}
);
$("#country").change();
</script>