var eventList = []

function addValidation(id_professor, id_area, id_level){
	
	$("#div_" + id_area + "" + id_level).removeAttr("onclick");
	$("#div_" + id_area + "" + id_level).removeAttr("style");
	
	$.get(base_url+"profile/addValidation?id_professor=" + id_professor + "&id_area=" + id_area + "&id_level=" + id_level,function(resp){
		//alert(resp);
		$("#val_" + id_area + "" + id_level).text(resp.replace("\"","").replace("\"",""));
		
	});
}

function deleteitem(obj){
	
	if($(obj).hasClass("exp")){
		
		swal({
			title: "¿Está seguro?",
			text: "Se eliminará la experiencia seleccionada",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonText: "Si. eliminala!" ,
			closeOnConfirm: false,   
			closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					$.ajax({
					url:base_url+"perfil/experiencia/"+id_user+"/"+$(obj).attr("data-id"),
					type:"DELETE"});
					$(obj).parent().remove();
			
					swal("Eliminada!", "La experiencia seleccionada fue eliminada.", "success");
				}
		});
		
	}else if($(obj).hasClass("ref")){
		
		swal({
			title: "¿Está seguro?",
			text: "Se eliminará la referencia seleccionada",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonText: "Si. eliminala!" ,
			closeOnConfirm: false,   
			closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					$.ajax({
					url:base_url+"perfil/referencia/"+id_user+"/"+$(obj).attr("data-id"),
					type:"DELETE"});
					$(obj).parent().remove();
			
					swal("Eliminada!", "La referencia seleccionada fue eliminada.", "success");
				}
		});
		
	}
}


function deleteCompetition(element){
	
	var element = $(element);
	
	swal({
			title: "¿Está seguro?",
			text: "Se eliminará la experticia seleccionada",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonText: "Si. eliminala!" ,
			closeOnConfirm: false,   
			closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					$.ajax({url:base_url+"perfil/competencia/"+id_user+"/"+element.attr("data-id")+"-"+element.attr("data-level"),
							type:"DELETE"});
					element.prev().remove(); //number
					element.prev().remove(); //text
					element.next().remove(); //br
					element.remove();//this
					
					var ids = $("#areas-wrapper .numero-competencia");
					
					for(var i = 0; i< ids.length ; i++){
						
						$(ids[i]).html("&nbsp;" + (i+1) + ".&nbsp;");
						
					}
			
					swal("Eliminada!", "La experticia seleccionada fue eliminada.", "success");
				}
		});
}

$(document).ready(function() {
	
	var _schedule_state = 0;
	var _class_element = 0;
	
	var _endDate;
	var _startDate;
	
	
	
	$("#btn-schedule").click(function(){
		
		if(_schedule_state == 0){
			$.get(base_url+"profile/checkUserLogged",function(resp){
				if(resp == 1) {
					swal({
						title: "Ya puedes programar tu clase!",
						text: "En la agenda selecciona el horario que se ajuste a tu necesidad, luego da click en Agendar Clase.",
						type: "success",
						confirmButtonText: "Aceptar" },
						function(){
							$("#btn-schedule").text("Agendar clase");
							_schedule_state = 1;
							
							$("#cover_calendar").hide();
							
					});
				}
				else {
					$("#login").modal();	
				}
			});
		}
		else {
			$("#agendar").modal();	
		}
		
		
	});
	
	$("#btAgendar").click(function(){
		$("#topic_form_error").html("");
		$("#level_form_error").html("");
		$("#city_form_error").html("");
		$("#address_form_error").html("");
		$("#phone_form_error").html("");
		
		if($("#topic_form").val() == ""){
			$("#topic_form_error").html("Este campo es obligatorio");
		}
		else if($("#level_form").val() == 0){
			$("#level_form_error").html("Se debe escoger un nivel");
		}
		else if($("#city_form").val() == 0){
			$("#city_form_error").html("Se debe escoger una ciudad");
		}
		else if($("#address_form").val() == ""){
			$("#address_form_error").html("Este campo es obligatorio");
		}
		else if(($("#phone_form").val() ) == "" || ( $("#phone_form").val().length < 7) ){
			$("#phone_form_error").html("Este campo es obligatorio y debe tener mínimo 7 dígitos");
		}
		else{
			
			var data = {
	
				"address":$("#address_form").val(),
	
				"city":$("#city_form").val(),
	
				"end":_endDate.format("YYYY-MM-DD HH:mm:ss"),
	
				"start":_startDate.format("YYYY-MM-DD HH:mm:ss"),
	
				"id_area":id_area,
				
				"id_level":$("#level_form").val(),
	
				"id_professor":id_user,
	
				"topic":$("#topic_form").val(),
	
				"phone":$("#phone_form").val()
	
			};
			
			$("#agendar").modal("hide");
			$(".modal-header h1").html("Programando tu clase");
			$("#pleaseWaitDialog").modal();
			
			$.post(base_url+"busqueda/guardar_from_public_profile",data,function(resp){

				var info = JSON.parse(resp);
	
				if(!info){
	
					//$("#login").modal();
	
				}else{
	
					window.location.href=base_url+"clase/solicitar/" + info;
	
				}
	
			});
			
		}
		
	});
	
	
	
	
	var request ={};
	
	$.get(base_url+"perfil/disponibilidad/"+id_user,function(resp){
		
		var freeList = JSON.parse(resp);
		
		var date = new moment();

		var week = new moment().startOf('week');
		
		
		$.get(base_url+"perfil/ajaxClases/"+id_user+"/"+date.unix(),function(resp){
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


				for(var i = 0 ; i < classList.length ;i++){

					busyList.push({

						id:busyList.length,

						title:"Agendado",

						editable:false,

						start:new moment(classList[i].start),

						end:new moment(classList[i].end)

					});

				}

				var e = {id:-2,	start:date,end:new moment(date).add(2,'h'),title:"clase",editable:true,color:"#009966"}; // class event object
				
				var overE = false;
				
				for(var i = 0 ; i< busyList.length ; i++){
					if(!(busyList[i].start.format() >= e.end.format() || busyList[i].end.format() <= e.start.format() )){
						overE = true;
					}
				}
				
				if(overE == false)
				{
					//busyList.push(e);
					//request.start = date;
					//request.end = new moment(date).add(2,"h");
				}
				
				$('#calendar').fullCalendar("removeEvents");
				
				$('#calendar').fullCalendar({
					header:{
						left:"",
						center:"",
						right:""
					},
					firstDay:1,
					lang:"es",
					slotDuration:"01:00:00",
					axisFormat:'h(:mm)a',
					minTime:"07:00:00",
					maxTime:"21:00:00",
					height:"auto",
					defaultView: 'agendaWeek',
					defaultDate: week,
					allDayText: "Todo el día",
					allDaySlot: false,
					eventColor:"#003333",
					selectable: true,
					selectHelper: true,
					editable: true,
					eventOverlap: false,
					timezone: 'local',
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
						else{
							_startDate = moment(event.start);
							_endDate = moment(event.end);
						}
					},
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
						else {
							_startDate = moment(event.start);
							_endDate = moment(event.end);
						}
					},
					select: function(start, end) {
						
						if(_class_element == 0)
						{
							var start_time = moment(start.format("HH:mm:ss"), "HH:mm:ss");
							var end_time = moment(end.format("HH:mm:ss"), "HH:mm:ss");
							
							var today = moment();
							var tomorrow = today.add('days', 1);
							tomorrow.startOf('day');
							
							var start_date = moment(start.format("DD:MM:YYYY"), "DD:MM:YYYY");
							
							var min_time = moment("07:00:00", "HH:mm:ss");
							var max_time = moment("21:00:00", "HH:mm:ss");
							
							if(end_time.subtract(start_time).hours() <= 1)
							{
								swal({
									title: "Error!",
									text: "La clase debe ser de mínimo dos (2) horas.",
									type: "error",
									confirmButtonText: "Aceptar" });
								$('#calendar').fullCalendar('unselect');
							}
							else if(start_date < tomorrow)
							{
								swal({
									title: "Error!",
									text: "El día de la clase no puede ser pasada, ni ser hoy.",
									type: "error",
									confirmButtonText: "Aceptar" });
								$('#calendar').fullCalendar('unselect');
							}
							else if((start.hours() < min_time.hours()) || (start.hours() > end.hours())) {
								
								swal({
									title: "Error!",
									text: "La clase debe iniciar mínimo a las 7:00 am.",
									type: "error",
									confirmButtonText: "Aceptar" });
								$('#calendar').fullCalendar('unselect');
							}
							else if((end.hours() > max_time.hours()) || (start.hours() > end.hours())) {
								swal({
									title: "Error!",
									text: "La clase debe terminar máximo a las 9:00 pm.",
									type: "error",
									confirmButtonText: "Aceptar" });
								$('#calendar').fullCalendar('unselect');
							}
							else{
								var title = "Espacio para reservar clase";
								var eventData;
								if (title) {
									eventData = {
										id:(busyList.length + 1),
										title: title,
										start: start,
										end: end
									};
									busyList.push(eventData);
									$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
									$('#calendar').fullCalendar({selectable:false});
								}
								$('#calendar').fullCalendar('unselect');
								
								_startDate = moment(start);
								_endDate = moment(end);
								
								_class_element = 1;	
							}
							
						}
						else {
							swal({
								title: "Error!",
								text: "Solo es posible agendar una clase a la vez.",
								type: "error",
								confirmButtonText: "Aceptar" },
								function(){
									$('#calendar').fullCalendar('unselect');
							});
						}
						
					}
				});
				
				for(var i in busyList){

					$('#calendar').fullCalendar("renderEvent",busyList[i]);

				}
		});
			  
	});
	$("#btn-save-schedule").click(function(){
		var i,j;
		$(".modal-header h1").html("Actualizando perfil.");
		$(".modal-body").html('<div class="progress"><div class="progress-bar progress-bar-striped active" style="width: 100%;"></div></div>');
		$("#pleaseWaitDialog").modal();
		for( i = 0; i<eventList.length ; i++){//summ adjacent availabilities
			for(var j=0;j< eventList.length;j++){
				if(eventList[i].end.days() == eventList[j].start.days() && eventList[i].end.hours() == eventList[j].start.hours()){
					eventList[i].end = eventList[j].end;
					eventList.splice(j,1);
					j=Math.max(0,j-1);
					i=Math.max(0,i-1);
				}else if(eventList[j].end.days() == eventList[i].start.days() && eventList[j].end.hours() == eventList[i].start.hours()){
					eventList[j].end = eventList[i].end;
					eventList.splice(i,1);
					i=Math.max(0,i-1);
					j=Math.max(0,j-1);
				}
			}
		}
		
		var evts = [];
		for( i in eventList){
			var evt = {
				start_day:eventList[i].start.day(),
				start_time:eventList[i].start.hours(),
				end_day:eventList[i].end.day(),
				end_time:eventList[i].end.hours()
			}
			evts.push(evt);
			if(evt.start_day == evt.end_day){
				if(evt.end_time < evt.start_time +3 ){
					$(".modal-header h1").html("Error");
					$(".modal-body").html("Tu disponibilidad mínima debe ser de franjas de 3 horas");
					$("#pleaseWaitDialog").modal();
					return;
				}
			}
		}
		$.post(base_url+"perfil/disponibilidad/"+id_user,{"events":evts},function(){
			$(".modal-header h1").html("Actualización Completa");
			$(".modal-body").html("La actualización se ha realizado con exito");
		});
	});
	$(".btn-update").click(function(){
		$(".modal-header h1").html("Actualizando perfil.");
		$(".modal-body").html('<div class="progress"><div class="progress-bar progress-bar-striped active" style="width: 100%;"></div></div>');
		$("#pleaseWaitDialog").modal();
		var birthday =$("#birthday").val().split("-");
		var data = {
			phone:$("#phone").val(),
			address:$("#address").val(),
			dayBorn:birthday[0],
			monthBorn:birthday[1],
			yearBorn:birthday[2],
			profile:$("#bio-profesor").val()};
		$.post(base_url+"perfil/actualizar/"+id_user,data,function(){
			//$(".modal-header h1").html("Actualización Completa");
			//$(".modal-body").html("La actualización se ha realizado con exito");
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
	
	$(".borrar-competencia").click(function(){
		var element = $(this);
		deleteCompetition(element);
	});
	
    $("#show_competencias").click(function(){
        $('#hide_competencias').toggle("fast");
    });

    $("#show_experiencias").click(function(){
        $('#hide_experiencias').toggle("fast");
    });

    $("#show_estudios").click(function(){
        $('#hide_estudios').toggle("fast");
    });

    $("#show_referencias").click(function(){
        $("#hide_referencias").toggle("fast");
    });
    $("#show_referenciasper").click(function(){
        $("#hide_referenciasper").toggle("fast");
    });
	$(".numero-competencia").css("cursor","pointer")
	$(".btn_agregar_descrip").click(function(e) {
		if(e.which==1){
			$(".modal-header h1").html("Actualizando perfil.");
			$(".modal-body").html('<div class="progress"><div class="progress-bar progress-bar-striped active" style="width: 100%;"></div></div>');
			$("#pleaseWaitDialog").modal();
			$.post(base_url+"perfil/actualizar/"+id_user,{profile:$("#descri_per").val()},function(){
				$(".modal-header h1").html("Actualización Completa");
				$(".modal-body").html("La actualización se ha realizado con exito");
			})
	   }
	})
	$(".delete-group").click(function(){
		if($(this).hasClass("exp")){
			
			var element = $(this);
			
			swal({
				title: "¿Está seguro?",
				text: "Se eliminará la experiencia seleccionada",
				type: "warning",
				showCancelButton: true,
				cancelButtonText: "No",
				confirmButtonText: "Si. eliminala!" ,
				closeOnConfirm: false,   
				closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
						url:base_url+"perfil/experiencia/"+id_user+"/"+element.attr("data-id"),
						type:"DELETE"});
						element.parent().remove();
				
						swal("Eliminada!", "La experiencia seleccionada fue eliminada.", "success");
					}
			});
			
		}else if($(this).hasClass("ref")){
			
			var element = $(this);
			
			swal({
				title: "¿Está seguro?",
				text: "Se eliminará la referencia seleccionada",
				type: "warning",
				showCancelButton: true,
				cancelButtonText: "No",
				confirmButtonText: "Si. eliminala!" ,
				closeOnConfirm: false,   
				closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							url:base_url+"perfil/referencia/"+id_user+"/"+element.attr("data-id"),
							type:"DELETE"});
							element.parent().remove();
				
						swal("Eliminada!", "La referencia seleccionada fue eliminada.", "success");
					}
			});
			
		}
	});
	$(".btn_agregar_experticia").click(function(e) {
		if(e.which==1){
			texto_error = "Datos vacios en este campo.";
			var valor_elemento = $(".competen option:selected").val();
			var ids = $("#areas-wrapper .borrar-competencia");
			var level = $(".level option:selected").val();
			var levelname = $(".level option:selected").text();
			for(var i = 0; i< ids.length ; i++){
				if($(ids[i]).attr("data-id") == valor_elemento && $(ids[i]).attr("data-level") == level){
					valor_elemento="-";
					valor_texto = "";
					texto_error = "Area ya existente"
				}
			}
			if(valor_elemento!="-" && level !="-"){
				$.post(base_url+"perfil/competencia/"+id_user+"/"+valor_elemento+"/"+level,function(){
					$('#hide_competencias').toggle("fast");
					text = $(".competen option:selected").text();
					if(level == -1){
						var div = "<div class=\"numero-competencia\">"+ids.length+"</div><div class=\"valor-competencia\">"+text+" - Primaria</div><div class=\"borrar-competencia\" data-id=\""+valor_elemento+"-2\" onclick=\"deleteitem(this)\">X</div><br>";
						var div = "<div class=\"numero-competencia\">"+(ids.length+1)+"</div><div class=\"valor-competencia\">"+text+" - Bachillerato</div><div class=\"borrar-competencia\" data-id=\""+valor_elemento+"-3\" onclick=\"deleteitem(this)\">X</div><br>";
						var div = "<div class=\"numero-competencia\">"+(ids.length+2)+"</div><div class=\"valor-competencia\">"+text+" - Universidadº</div><div class=\"borrar-competencia\" data-id=\""+valor_elemento+"-4\" onclick=\"deleteitem(this)\">X</div><br>";
						var div = "<div class=\"numero-competencia\">"+(ids.length+3)+"</div><div class=\"valor-competencia\">"+text+" - Otro</div><div class=\"borrar-competencia\" data-id=\""+valor_elemento+"-5\" onclick=\"deleteitem(this)\">X</div><br>";

					}else{
						var div = "<div class=\"numero-competencia\">&nbsp;"+(ids.length + 1)+".&nbsp;</div><div class=\"valor-competencia\">"+text+" - "+levelname+"</div><div class=\"borrar-competencia\" data-id=\""+valor_elemento+"\" data-level=\""+level+"\" onclick=\"deleteCompetition(this)\">X</div><br>";
					}
					$("#areas-wrapper").append(div);
				});
			}else
				swal("Error!", texto_error, "error");
		}
	})
	
	$(".btn_agregar_experiencia").click(function() {
		var experience = {
			institution:$("#add_empresa").val(),
			title:$("#add_titulo").val(),
			address:$("#add_ubicacion").val(),
			from:$("#add_anio_desde").val()+"-"+$("#add_mes_desde").val()+"-01",
			to:$("#add_anio_hasta").val()+"-"+$("#add_mes_hasta").val()+"-01",
			description:$("#actividad_exper").val(),
			additional:"",
			type:0
		}
		$.post(base_url+"perfil/experiencia/"+id_user,experience,function(rta){
			var div = "<div class=\"form-group exp-profesor\">"+
						"<div class='grid-exp'>Institución: </div><div class='grid-exp exp-var'>"+experience.institution+"</div><br>"+
						"<div class='grid-exp'>Titulo: </div><div class='grid-exp exp-var'>"+experience.title+"</div><br>"+
						"<div class='grid-exp'>Año: </div><div class='grid-exp exp-var'>"+experience.from.split("-")[0]+"-"+
										experience.from.split("-")[1]+
								" hasta "+experience.to.split("-")[0]+"-"+
										experience.to.split("-")[1]+
								"</div><br>"+
						"<span class=\"glyphicon glyphicon-remove-circle delete-group exp\" aria-hidden='true' data-id=\""+rta+"\" onclick=\"deleteitem(this)\"></span>"+
						"<div class=\"amigas-separator\"></div>"+
				  "</div>";

			$("#exp-wrapper-pro").append(div);
			$('#hide_experiencias').toggle("fast");
		});
	})

	$(".btn_agregar_estudios").mousedown(function() {
		var experience = {
			institution:$("#add_universidad").val(),
			title:$("#add_titulo_obtenido").val(),
			address:$("#add_ubicacion").val(),
			from:$("#add_anio_estu_desde").val()+"-01-01",
			to:$("#add_anio_estu_hasta").val()+"-01-01",
			description:$("#add_descripcion_estu").val(),
			additional:$("#add_actividades_estu").val(),
			type:1
		}
		$.post(base_url+"perfil/experiencia/"+id_user,experience,function(rta){
			var div = "<div class=\"form-group textarea exp-profesor\">"+
						"<div class='grid-exp'>Institución: </div><div class='grid-exp exp-var'>"+experience.institution+"</div><br>"+
						"<div class='grid-exp'>Titulo: </div><div class='grid-exp exp-var'>"+experience.title+"</div><br>"+
						"<div class='grid-exp'>Año: </div><div class='grid-exp exp-var'>"+experience.from.split("-")[0]+" hasta "+experience.to.split("-")[0]+"</div><br>"+
						"<span class=\" glyphicon glyphicon-remove-circle delete-group exp\" data-id=\""+rta+"\" onclick=\"deleteitem(this)\"></span>"+
						"<div class=\"amigas-separator\"></div>"+
				  "</div>";
			$("#exp-wrapper-est").append(div);
			$('#hide_estudios').toggle("fast");
		});
	});


	$(".btn_agregar_referencias_pro").click(function() {
		var reference = {
			name:$("#add_nombre_ref_pro").val(),
			title:$("#add_role_ref_pro").val(),
			phone:$("#add_telef_ref_pro").val(),
			address:$("#add_direccion_ref_pro").val(),
			type:0
		}
		$.post(base_url+"perfil/referencia/"+id_user,reference,function(rta){
			var div = "<div class=\"form-group\" class=\"col-xs-3\">"+
						"<h5>Nombre: <b>"+reference.name+"</b></h5>"+
						"<h5>Cargo: <b>"+reference.title+"</b></h5>"+
						"<h5>Teléfono: <b>"+reference.phone+"</b></h5>"+
						"<h5>Dirección: <b>"+reference.address+"</b></h5>"+
						"<div class=\"delete-group ref\" data-id=\""+rta+"\"></div>"+
						"<div class=\"amigas-separator\"></div>"+
				  "</div>";
			$("#ref-wrapper-pro").append(div);
			$("#hide_referencias").toggle("fast");
		});
	});
	$(".btn_agregar_referencias_per").mousedown(function() {
		var reference = {
			name:$("#add_nombre_ref_per").val(),
			title:$("#add_role_ref_per").val(),
			phone:$("#add_telef_ref_per").val(),
			address:$("#add_direccion_ref_per").val(),
			type:1
		}
		$.post(base_url+"perfil/referencia/"+id_user,reference,function(rta){
			var div = "<div class=\"form-group\" class=\"col-xs-3\">"+
						"<h5>Nombre: <b>"+reference.name+"</b></h5>"+
						"<h5>Parentezco: <b>"+reference.title+"</b></h5>"+
						"<h5>Teléfono: <b>"+reference.phone+"</b></h5>"+
						"<h5>Dirección: <b>"+reference.address+"</b></h5>"+
						"<div class=\"delete-group ref\" data-id=\""+rta+"\"></div>"+
						"<div class=\"amigas-separator\"></div>"+
				  "</div>";
			$("#ref-wrapper-per").append(div);
			$("#hide_referenciasper").toggle("fast");
		});
	});
	$(".btn_agregar_video").click(function() {
		$(".modal-header h1").html("Cargando video.");
		$(".modal-body").html('<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');
		$("#pleaseWaitDialog").modal();
		link = $(".link_youtube").val();
		$(".link_youtube").val("");
		link = link.replace("watch?","");
		link = link.replace("=","/");
		//$("#video").val(link);
	   
	   link = link.replace("?", "/");
	   link = link.replace("=", "/");
	   
		$("iframe#video_profe").attr("src",link);
		$.post(base_url+"perfil/insertarVideo/"+id_user,{youtube:link},function(msg){
			
			$("#pleaseWaitDialog").modal("hide");
			
			swal("Listo!", "Tu video fue añadido con éxito.", "success");
			
			$(".container-videos").append('<div class="col-md-4"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe data-id=' + msg + ' src=' + link + ' frameborder="0" allowfullscreen></iframe></div></div>');
			
		})
	})
	$(".btn_agregar_precio_hora").mousedown(function() {
		valor = $("#precio_hora").val()
		$("#valor_hora").val(valor)
	})
	
	$(".datepicker").datepicker({format:"dd-mm-yyyy",viewMode:"years"});
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
	xhr.open('POST', base_url + "perfil/savePicture", true);
	xhr.onload = function() {
		document.getElementById("texto_foto").innerHTML = "Subir foto";
		
		response = JSON.parse(this.response);
		if(response.success)
		{
			$(".img-profile").attr("src",response.success);
		}
		else if(response.error)
		{
			switch(response.error){
				case "<p>The filetype you are attempting to upload is not allowed.</p>":
						swal({
							title: "Error!",
							text: "El tipo de archivo que intentas cargar no es permitido. Las extensiones permitidas son gif, jpg y png.",
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
				case "<p>The image you are attempting to upload exceedes the maximum height or width.</p>":
						swal({
							title: "Error!",
							text: "Las dimensiones de la imagen supera los límites permitidos, Las dimensiones máximas son 1024 x 768 px.",
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
				case "<p>The file you are attempting to upload is larger than the permitted size.</p>":
						swal({
							title: "Error!",
							text: "El tamaño del archivo que intentas cargar supera los límites permitidos. El tamaño máximo son 20 MB.",
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
				default:
						swal({
							title: "Error!!!",
							text: response.error,
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
			}
		}
		else
		{
			swal({
				title: "Error!",
				text: this.response,
				type: "error",
				confirmButtonText: "Aceptar" },
				function(){
					
			});
		}
	};
	xhr.send(fd);
	event.preventDefault();
}