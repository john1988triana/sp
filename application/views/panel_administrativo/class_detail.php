<div class="md-col-12" style="margin-top:80px">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<table class="pfs table table-striped table-bordered" >
			<tbody>
				<tr>
					<td>id</td>
					<td id="user-email" ><?php if(isset($id))echo $id;?></td>
				</tr>
				<tr>
					<td>Área</td>
					<td><?php foreach($areas as $a){if($id_area == $a->IdArea){echo $a->Name;break;}} ?></td>
				</tr>
				<tr>
					<td>Nivel</td>
					<td><?php foreach($levels as $l){if($id_level == $l["id"]){echo $l["name"];break;}}?></td>
				</tr>
				<tr>
					<td>Ciudad</td>
					<td><?php foreach($cities as $c){if($city == $c->ID){echo utf8_decode($c->Name);break;}} ?></td>
				</tr>
				<tr>
					<td>Dirección</td>
					<td>
					<?php if($editable): ?>
						<input class="form-control address" value="<?php echo $address ?>"></input>
					<?php else: ?>
						<?php echo $caddress; ?>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>Estado</td>
					<td>
						<?php if($editable): ?>
						<select class="state">
							<?php foreach ($states as $value) { ?> 
								<option value="<?php echo $value['id']; ?>" <?php if($value['id']==$id_status){echo "selected";}?>>
									<?php echo $value['name']; ?>
								</option>
							<?php } ?>
						</select>
						<?php else: ?>
							<?php foreach ($states as $value) { ?> 
								<?php if($value['id']==$status){echo $value["name"];}?>
							<?php } ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>Teléfono</td>
					<td><input id="phone" class="form-control" value="<?php if(isset($phone))echo $phone; ?>"></input></td>
				</tr>
				<tr>
					<td>Precio</td>
					<td><input id="price_public" class="form-control" value="<?php if(isset($price_public))echo $price_public?>"></input></td>
				</tr>
				<tr>
					<td>Tema</td>
					<td><input id="topic" class="form-control" value="<?php if(isset($topic))echo $topic; ?>"></input></td>
				</tr>
				<tr>
					<td>Estudiante</td>
					<td>
					<?php if($id_student == NULL): ?>
						<input id="student-email" class="form-control" placeholder="Email" ></input>
						<input type="hidden" id="id_student" class="form-control" ></input>
						<span id="student-result"></span>
						<div id="student-create"></div>
					<?php else: ?>
						<a href="<?php echo base_url("administrador/estudiantes/detalles/".$id_student)?>"><?php echo $sFName ." ".$sLName; ?></a></td>
					<?php endif; ?>
				</tr>
				<tr>
					<td>Profesor</td>
					<td>
					<?php if($editable): ?>
						<select class="teacher">
							<?php foreach ($teachers as $teacher) { ?> 
								<option value="<?php echo $teacher->id_user; ?>" <?php if($teacher->id_user==$id_professor){echo "selected";}?>>
									<?php echo $teacher->firstName." ".$teacher->lastName; ?>
								</option>
							<?php } ?>
						</select>
						<div id="calendar"></div>
					<?php else: ?>
						<?php foreach ($teacher as $teacher) { ?> 
							<?php if($teacher['id']==$id_professor){echo $teacher->firstName." ".$teacher->lastName;}?>
						<?php } ?>
					<?php endif; ?>
					
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button type="button" onclick="saveClass();">Guardar</button></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="button" onclick="window.location.href='<?php echo base_url("administrador/clases/solicitadas"); ?>'">Volver</button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Guardando...</h1>
			</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script>
$("#student-email").change(function(){
	if($(this).val().indexOf("@") !=-1){
		$.get("<?php echo base_url("administrador/estudiantes/existe"); ?>?email="+$(this).val(),function(resp){
			var results = JSON.parse(resp);
			if(results.length == 1){
				$("#student-result").html("Estudiante Encontrado");
				$("#student-create").html('');
				$("#id_student").val(results[0].IdUser);
			}else{
				$("#student-result").html("Estudiante No Encontrado");
				$("#student-create").html('<form method="POST"><input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required><input id="fname" name="fname" type="text" class="form-control" placeholder="Apellido" required>'+
					'<input id="email" name="email" type="email" class="form-control" placeholder="Confirmar email" required>'+
					'<span id="error"></span>'+
					'<input id="create" type="submit" href="" class="btn-profe btn-login btn col-lg-12 " value="Crear Usuario"></input></form>');
				$("#student-create form").submit(function(e){
					if($("#student-create #email").val() != $("#student-email").val()){
						$("#student-create #error").html("los Correos no coinciden");
						e.preventDefault();
						return;
					}
					$("#student-create #error").html("");
					var formData = new FormData($("#student-create form")[0]);
					var request = new XMLHttpRequest();
					request.open("POST", "<?php echo base_url("administrador/estudiantes/crear"); ?>");
					request.onload = function(oEvent) {
						if (request.status == 200) {
							$("#student-create").html('');
							$("#student-email").change();
						}
					};
					request.send(formData);
					e.preventDefault();
				});
			}
		})
	}
});
$(".datepicker").datepicker({format: 'dd-mm-yyyy'});
var base_url = "<?php echo base_url(); ?>";
var request = {};
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
$(".teacher").change(function(){
	var id = $(".teacher option:selected").val();
	var date = new moment("<?php echo date("d-m-Y H:i",strtotime($start)); ?>","DD-MM-YYYY HH:mm");
	var busyList = [];
	var week = new moment(date).startOf('week');
	var auto = false;
	$.get(base_url+"perfil/disponibilidad/"+id,function(resp){
		var freeList = JSON.parse(resp);
		$.get(base_url+"perfil/ajaxClases/"+id+"/"+date,function(resp){
			var classList = JSON.parse(resp);
			busyList = [];
			for(var i = 0 ; i < 30 ;i++){
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
								start: end,
								end: toSplit.end,
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
			for(var j = 0 ; j < 4 ; j ++){
				for(var i = 0 ; i < freeList.length ;i++){
					var sday = freeList[i].start_day == 0 ? 7: freeList[i].start_day;
					var eday = freeList[i].end_day == 0 ? 7: freeList[i].end_day;
					freeList[i].id = i;
					freeList[i].title = "Disponible";
					freeList[i].start = new moment(week).add(sday-1,"d").add(freeList[i].start_time,"h").add(j,"w");
					freeList[i].end = new moment(week).add(eday-1,"d").add(freeList[i].end_time,"h").add(j,"w");
					splitBusy(sday,freeList[i].start,freeList[i].end);
				}
			}
			if(auto){ //auto is true when there is no direct match on the time the user request
				date = freeList[0].start;
			}
			var added = false;
				for(var i = 0 ; i < classList.length ;i++){
					if(classList[i].hash == "<?php echo $hash; ?>"){
						added= true;
						busyList.push({
						id:busyList.length,
						title:"Clase",
						editable:true,
						color:"#009966",
						start:new moment(classList[i].start),
						end:new moment(classList[i].end)
						});
					}else{
						busyList.push({
							id:busyList.length,
							title:"Agendado",
							editable:false,
							start:new moment(classList[i].start),
							end:new moment(classList[i].end)
						});
					}
				}
			if(!added){
				var e = {id:-2,	start:date,end:new moment(date).add(2,'h'),title:"Clase",editable:true,color:"#009966"} // class event object
				busyList.push(e);
			}
			request.start = date;
			request.end = new moment(date).add(2,"h");
			$('#calendar').fullCalendar("removeEvents");
			$('#calendar').fullCalendar({
				header:{left:"prev",center:"month,agendaWeek",right:"next"},
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
				//events:busyList,
				viewRender: function(view,element){
					var min = new moment(week);
					var max = new moment(week).add(1,"M");
					if(view.start <= min){
						$('#calendar').fullCalendar({header:{left:"",center:"",right:"next"}})
					}else if(view.end >= max){
						$('#calendar').fullCalendar({header:{left:"prev",center:"",right:"next"}})
					}else{
						$('#calendar').fullCalendar({header:{left:"prev",center:"",right:""}})
					}
					$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar( 'rerenderEvents' );
				},
				eventDrop: function(event, delta, revertFunc) {
					if (isOverlapping(event)) {
						revertFunc();
					}else{
						request.start = event.start;
						if(event.end){
							request.end = event.end;
						}
					}
				},
				eventResize: function(event, delta, revertFunc) {
					if (isOverlapping(event)) {
						revertFunc();
					}else{
						request.start = event.start;
						if(event.end){
							request.end = event.end;
						}
					}
				}
			});
			$('#calendar').fullCalendar( 'addEventSource', busyList); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar( 'rerenderEvents' );
		});
	});
});
$(".teacher").change();
$('#pleaseWaitDialog').on('hidden.bs.modal', function () {
  window.location.reload();
});
function saveClass(){
	$("#pleaseWaitDialog").modal();
	var base_url = "<?php echo base_url(); ?>";
	var data = {
		cls:{
			"hash":"<?php echo $hash; ?>",
			"address":$(".address").val(),
			"end":request.end.format("YYYY-MM-DD, HH:mm:ss"),
			"start":request.start.format("YYYY-MM-DD, HH:mm:ss"),
			"id_professor":$(".teacher option:selected").val(),
			"topic":$("#topic").val(),
			"phone":$("#phone").val(),
			"price_public":$("#price_public").val(),
			"status" : 4
		}
	};
	if($("#id_student").val()!=""){
			data.cls.id_student = $("#id_student").val();
		}
	$.post(base_url+"administrador/actualizar/clase",data,function(resp){
		$(".modal-header h1").html("Actualización Completa");
	});
}
</script>