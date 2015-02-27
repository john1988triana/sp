var eventList = []
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
	$.get(base_url+"perfil/disponibilidad/"+id_user,function(resp){
		eventList = JSON.parse(resp);
		for(var i = 0 ; i < eventList.length ;i++){
			var sday = eventList[i].start_day == 0 ? 7: eventList[i].start_day;
			var eday = eventList[i].end_day == 0 ? 7: eventList[i].end_day;
			eventList[i].id = i;
			eventList[i].title = "Disponible";
			eventList[i].start = new moment({years:2014,months:11,day:sday,hours:eventList[i].start_time});
			eventList[i].end = new moment({years:2014,months:11,day:eday,hours:eventList[i].end_time});
		}
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
			columnFormat:{week: 'ddd'},
			defaultView: 'agendaWeek',
			defaultDate: '2014-12-01',
			allDayText: "Todo el día",
			allDaySlot: false,
			eventColor:"#003333",
			selectable: true,
			selectHelper: true,
			editable: true,
			events:eventList,
			select: function(start, end) {
				var title = "Disponible";
				var eventData;
				if (title) {
					eventData = {
						id:eventList.length,
						title: title,
						start: start,
						end: end
					};
					eventList.push(eventData);
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');
			},
			eventResize: function(calEvent, delta, revertFunc) {				
				for(var i in eventList){
					if(eventList[i].id == calEvent.id){
						eventList[i].end = calEvent.end;
					}
				}
			},
			eventClick: function(calEvent, jsEvent, view) {
				
				swal({
					title: "¿Está seguro?",
					text: "Se borrará este espacio",
					type: "warning",
					showCancelButton: true,
					cancelButtonText: "No",
					confirmButtonText: "Si. eliminalo!" ,
					closeOnConfirm: false,   
					closeOnCancel: true
					},
					function(isConfirm){
						if (isConfirm) {
							for(var i in eventList){
								if(eventList[i].id == calEvent.id){
									eventList.splice(i,1);
								}
							}
							$('#calendar').fullCalendar('removeEvents', calEvent.id); // stick? = true
							swal("Eliminado!", "El espacio seleccionado fue eliminado.", "success");
						}
				});
				
				
			},
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
						url:base_url+"perfil/experiencia/"+id_user+"/"+$(this).attr("data-id"),
						type:"DELETE"});
						$(this).parent().remove();
				
						swal("Eliminada!", "La experiencia seleccionada fue eliminada.", "success");
					}
			});
			
		}else if($(this).hasClass("ref")){
			
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
							url:base_url+"perfil/referencia/"+id_user+"/"+$(this).attr("data-id"),
							type:"DELETE"});
							$(this).parent().remove();
				
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
				case "<p>The filetype you are attempting to upload is not allowed.</p><p>The filetype you are attempting to upload is not allowed.</p>":
						swal({
							title: "Error!",
							text: "El tipo de archivo que intentas cargar no es permitido. Las extensiones permitidas son gif, jpg y png.",
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
				case "<p>The image you are attempting to upload exceedes the maximum height or width.</p><p>The image you are attempting to upload exceedes the maximum height or width.</p>":
						swal({
							title: "Error!",
							text: "Las dimensiones de la imagen supera los límites permitidos, Las dimensiones máximas son 1024 x 768 px.",
							type: "error",
							confirmButtonText: "Aceptar" },
							function(){
								
						});
						break;
				case "<p>The file you are attempting to upload is larger than the permitted size.</p><p>The file you are attempting to upload is larger than the permitted size.</p>":
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
							title: "Error!",
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