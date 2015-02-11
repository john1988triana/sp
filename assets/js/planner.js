var Planner = function(id, selector, width, height, idioma) {
	
	try{

		if(isNaN(id) || id==undefined) throw "Error, id de calendario invalido!";
		if(isNaN(width) || width==undefined) throw "Error, ancho de calendario invalido!";
		if(isNaN(height) || height==undefined) throw "Error, altura de calendario invalido!";
		if(!isNaN(selector) || selector=="") throw "Error, selector de jQuery invalido";
		if(!isNaN(idioma) || idioma=="") throw "Error, idioma invalido";

		this.id = id;
		var hoy = new Date();
		this.anio = hoy.getFullYear();
		this.mes = hoy.getMonth();
		this.fecha = hoy.getDate();
		this.dia = hoy.getDay();
		this.primerdia = 0;
		this.diasmes = 0;
		this.selectorjquery = selector;
		this.width = width;
		this.height = height;
		this.height_mes_anio = 35;
		this.height_guia_dias = 22;
		this.borde_radio = 1;
		this.width_dias = 29.5;
		this.height_dias = 26;
		this.font_titulo = 15;
		this.font_titulo_planner = 15;
		this.font = 14;
		this.font_dias = 12;
		this.font_eventos = 12;
		this.padding_dias = "11.5px 3.5px 10.5px 3.5px";
		this.color_borde_dias = "darkgray";
		this.color_futuro = "darkgray";
		this.height_semana = 35;
		this.json = "";
		this.idioma = idioma;
		this.eventos = false;
		this.planner = false;
		this.semana = 0;
		this.tipo_input = "text";
		this.id_input = "";
		this.datos_planner = [];
		this.dia_seleccionado = 0;
		this.fechas_planner = "";
		this.dia_inicial_recuadro = 0;
		this.mes_planner = 0;	
		this.disponiblidad = []
		this.inhabilitacion_planner = false;
		this.inhabilitar_pasado_planner = true;
		this.hora_estudiante = false;
		this.fecha_estudiante = "";
		this.html = "";

		this.Mes = {
						 "ESP":{
							  0:["Enero",31],
	 						  1:["Febrero",28],
	 						  2:["Marzo",31],
	 						  3:["Abril",30],
	 						  4:["Mayo",31],
	 						  5:["Junio",30],
	 						  6:["Julio",31],
	 						  7:["Agosto",31],
	 						  8:["Septiembre",30],
	 						  9:["Octubre",31],
	 						  10:["Noviembre",30],
	 						  11:["Diciembre",31]
 						  },
 						  "ENG":{
							  0:["January",31],
	 						  1:["February",28],
	 						  2:["March",31],
	 						  3:["April",30],
	 						  4:["May",31],
	 						  5:["June",30],
	 						  6:["July",31],
	 						  7:["August",31],
	 						  8:["September",30],
	 						  9:["October",31],
	 						  10:["November",30],
	 						  11:["December",31]
 						  },
 						  "DEU":{
							  0:["Januar",31],
	 						  1:["Februar",28],
	 						  2:["M&aumlrz",31],
	 						  3:["April",30],
	 						  4:["Mai",31],
	 						  5:["Juni",30],
	 						  6:["Juli",31],
	 						  7:["August",31],
	 						  8:["September",30],
	 						  9:["Oktober",31],
	 						  10:["November",30],
	 						  11:["Dezember",31]
 						  }

					};
		this.Dias = {
						"ESP":["Dom","Lun","Mar","Mie","Jue","Vie","Sab"],
						"ENG":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
						"DEU":["Son","Mon","Die","Mit","Don","Fre","Sam"]
		}

	}catch(error){
		alert(error)
	}

};
Planner.prototype.construccionEstiloPlanner = function() {

		document.getElementById('contenido-planner-j').style.width = this.width+"px";
		document.getElementById('contenido-planner-j').style.height = this.height+"px";
		//document.getElementById('contenido-planner-j').style.background = "linear-gradient(#FFF, #B9CDCD)";
		document.getElementById('contenido-planner-j').style.background = "#F6F6EC";
		document.getElementById('contenido-planner-j').style.borderWidth = "1px";
		document.getElementById('contenido-planner-j').style.borderRadius = this.borde_radio+"px";
		//document.getElementById('contenido-planner-j').style.display = "none";
	/*Cabeza*/
		/*document.getElementById('mes_vuelta_planner').style.height = (this.height_mes_anio - 12)+"px";
		document.getElementById('mes_vuelta_planner').style.background = "#B5B5B5";
		document.getElementById('mes_vuelta_planner').style.color = "#FFF";
		document.getElementById('mes_vuelta_planner').style.textAlign = "center";
		document.getElementById('mes_vuelta_planner').style.borderTopRightRadius = this.borde_radio+"px";
		document.getElementById('mes_vuelta_planner').style.borderTopLeftRadius = this.borde_radio+"px";
		document.getElementById('mes_vuelta_planner').style.fontWeight = "bold";
		document.getElementById('mes_vuelta_planner').style.cursor = "pointer";
		document.getElementById('mes_vuelta_planner').style.height = (this.height_mes_anio - 12)+"px";
		
		document.getElementById('mes_vuelta_planner').style.background = "#F6F6EC";
		document.getElementById('mes_vuelta_planner').style.color = "#6B6B6B";
		document.getElementById('mes_vuelta_planner').style.textAlign = "center";
		/*document.getElementById('mes_ida_planner').style.borderTopRightRadius = this.borde_radio+"px";
		document.getElementById('mes_ida_planner').style.borderTopLeftRadius = this.borde_radio+"px";
		document.getElementById('mes_vuelta_planner').style.fontWeight = "bold";
		document.getElementById('mes_vuelta_planner').style.cursor = "pointer";
		document.getElementById('dia_vuelta_planner').style.display = "inline-block";
		document.getElementById('dia_vuelta_planner').style.width = "70px";
		document.getElementById('dia_vuelta_planner').style.borderRadius = "2px";
		document.getElementById('dia_vuelta_planner').style.background = "#B5B5B5";
		document.getElementById('dia_vuelta_planner').style.color = "#FFF";
		document.getElementById('mes_vuelta_plann').style.display = "inline-block";
		document.getElementById('mes_vuelta_plann').style.width = "70px";
		document.getElementById('mes_vuelta_plann').style.borderRadius = "2px";*/
		//document.getElementById('dia_ida_planner').style.height = "26px";
		/*document.getElementById('mes_anio_planner').style.width = (this.width + 15)+"px";
		document.getElementById('mes_anio_planner').style.height = (this.height_mes_anio - 12)+"px";
		document.getElementById('mes_anio_planner').style.marginLeft = "20px"
		document.getElementById('mes_anio_planner').style.borderTopRightRadius = this.borde_radio+"px";
		document.getElementById('mes_anio_planner').style.borderTopLeftRadius = this.borde_radio+"px";
		document.getElementById('mes_anio_planner').style.fontFamily = "'Helvetica',sans-serif";
		document.getElementById('mes_anio_planner').style.textAlign = "center";
		document.getElementById('mes_anio_planner').style.background = "#F6F6EC";
		document.getElementById('mes_anio_planner').style.color = "#6B6B6B";
		document.getElementById('mes_anio_planner').style.paddingTop = "1%";

		var textos = document.getElementsByClassName("texto-mes_anio_planner");

		for (var t = 0; t < textos.length; t++){

		    textos[t].style.display = "inline";
			textos[t].style.fontSize = this.font_titulo_planner+"px";
			//textos[t].style.cursor = "pointer";

		}*/
		
		/*document.getElementById('s_anterior').style.float = "left";
		//document.getElementById('f_anterior').style.padding = "1%";
		document.getElementById('s_anterior').style.width = "0";
		document.getElementById('s_anterior').style.height = "0";
		document.getElementById('s_anterior').style.borderTop = "10px solid transparent";
		document.getElementById('s_anterior').style.borderRight = "20px solid #6B6B6B";
		document.getElementById('s_anterior').style.borderBottom = "10px solid transparent";
		//document.getElementById('f_anterior').style.fontWeight = "bold";
		document.getElementById('s_anterior').style.cursor = "pointer";

		document.getElementById('s_posterior').style.float = "right";
		document.getElementById('s_posterior').style.width = "0";
		document.getElementById('s_posterior').style.height = "0";
		document.getElementById('s_posterior').style.borderTop = "10px solid transparent";
		document.getElementById('s_posterior').style.borderLeft = "20px solid #6B6B6B";
		document.getElementById('s_posterior').style.borderBottom = "10px solid transparent";*/
		/*document.getElementById('f_posterior').style.padding = "1%";
		document.getElementById('f_posterior').style.fontWeight = "bold";
		document.getElementById('s_posterior').style.cursor = "pointer";


	/*Guia de los dias*/
		document.getElementById('guia_dias_planner').style.width = (this.width - 60)+"px";
		document.getElementById('guia_dias_planner').style.height = "25px";
		document.getElementById('guia_dias_planner').style.marginLeft = "42px";
		document.getElementById('guia_dias_planner').style.marginRight = "10px"
		document.getElementById('guia_dias_planner').style.background = "#F6F6EC";
		document.getElementById('guia_dias_planner').style.color = "#B5B5B5"
		//document.getElementById('guia_dias_planner').style.fontFamily = "'Helvetica',sans-serif";
		document.getElementById('guia_dias_planner').style.fontSize = (this.font - 6)+"px";
		document.getElementById('guia_dias_planner').style.float = "left";

	/*Dias*/
		var dia = document.getElementsByClassName("dia_planner");

		for (var d = 0; d < dia.length; d++){

		    dia[d].style.display = "inline";
		    dia[d].style.paddingLeft = "3px";
		    dia[d].style.paddingRight = "5px";
		    dia[d].style.width = (this.width_dias + 5)+"px";

		}

		var dias = document.getElementsByClassName("dias_planner");

		for (var d = 0; d < dias.length; d++){

			dias[d].style.width = (this.width_dias - 5)+"px";
			dias[d].style.height = "16px";
		    //dias[d].style.fontSize = "8px";
		    dias[d].style.display = "inline-block";
		    dias[d].style.textAlign = "center";
		    dias[d].style.transition = "0.3s";
		    dias[d].style.borderStyle = "solid"
		    //dias[d].style.padding = "3.5px 3.1px 3.5px 3.1px";
		    dias[d].style.borderWidth = "1px";
		    dias[d].style.borderColor = this.color_borde_dias;

		}
		var horas = document.getElementsByClassName("horas_planner");

		for (var h = 0; h < horas.length; h++){

		    horas[h].style.borderWidth = "0px";
		    //horas[h].style.padding = "3.1px 3.1px 1px 3.1px";
		    horas[h].style.textAlign = "left";
		    horas[h].style.float = "left";
		    horas[h].style.width = (this.width_dias - 18)+"px"
		    horas[h].style.height = "18px";
		    horas[h].style.fontSize = "10px";


		}
		for (var i = 15; i > 0; i--) {
			
			document.getElementById('franja_'+i+'_planner').style.width = this.width
			document.getElementById('franja_'+i+'_planner').style.height = "16px";
			document.getElementById('franja_'+i+'_planner').style.background = "transparent";
			document.getElementById('franja_'+i+'_planner').style.float = "left";
			document.getElementById('franja_'+i+'_planner').style.cursor = "pointer";
			document.getElementById('franja_'+i+'_planner').style.marginLeft = "10px";
			//document.getElementById('franja_'+i+'_planner').style.fontFamily = "'Helvetica',sans-serif";

		};
};
Planner.prototype.crearPlaner = function() {

	try{
			if (this.eventos) throw "Error, Eventos y planner no se pueden cargar al mismo tiempo";
		
			this.planner = true;
			elemento = this;
			semana= elemento.semana
			var html = "", cabeza = "", fechas = "", dias = "", selector = this.selectorjquery;
			var diaslocales = [];
			var horas_planner = ["7-8","8-9","9-10","10-11","11-12","12-13","13-14","14-15","15-16","16-17","17-18","18-19","19-20","20-21","21-22"]

			var sobreHora = function() {

				$(this).css("color","#FFF")
				$(this).css("background","#A6B8B8")

			};
			var fueraHora = function() {

				$(this).css("color","#000")
				$(this).css("background","none")

			};
			var asignarOremoverHora = function() {

//255 102 0
				fondo = $(this).css("background").indexOf("rgb(48, 48, 48)");
				console.log(fondo)				
				if(fondo!=-1 && !elemento.inhabilitacion_planner){

					$(this).css("background","#A6B8B8")
					$(this).bind("mouseover",sobreHora)
					$(this).bind("mouseout",fueraHora)
					var dia_l = $(this).attr("dia");
					var hora_l = $(this).attr("hora");
					var semana_l = $(this).attr("semana");
					var mes_l = $(this).attr("mes");
					var anio_l = elemento.anio;
					semana_l = elemento.semana
					fecha_l = elemento.fechas_planner[dia_l];
					var horas = hora_l.split("-");
					var ind = elemento.datos_planner.indexOf(hora_l+" "+dia_l)
					elemento.datos_planner.splice(ind,1)

				}else if(fondo==-1 && !elemento.inhabilitacion_planner){

					$(this).css("background","#303030")
					$(this).unbind("mouseover",sobreHora)
					$(this).unbind("mouseout",fueraHora)
					var dia_l = $(this).attr("dia");
					var hora_l = $(this).attr("hora");
					var semana_l = $(this).attr("semana");
					var mes_l = $(this).attr("mes");
					var anio_l = elemento.anio;
					semana_l = elemento.semana;
					fecha_l = elemento.fechas_planner[dia_l];
					//alert(mes_l)
					var horas = hora_l.split("-");
					elemento.datos_planner.push(hora_l+" "+dia_l)
 
				}

				$(elemento.id_input+"[type="+elemento.tipo_input+"]").val(elemento.datos_planner)
				
			}

			cabeza ="<div id=\"contenido-planner-j\">"+
						/*"<div id=\"mes_anio_planner\">"+
						"<div class=\"texto-mes_anio\" id=\"s_anterior\"><</div>"+
						"<div class=\"texto-mes_anio_planner\">"+this.Mes[this.idioma][this.mes][0]+" - Semana "+(semana + 1)+"</div>"+
						"<div class=\"texto-mes_anio\" id=\"s_posterior\">></div>"+
						"</div>"+*/
						"<div id=\"guia_dias_planner\">";

			html += cabeza;

			for (var i = 0; i < 7; i++)
				html += "<div class=\"dia_planner\">"+this.Dias[this.idioma][i]+"</div>";

			html += "</div>";

			for (var s = 0; s < 15; s++) {

				html += "<div id=\"franja_"+(s+1)+"_planner\" class=\"franjas\">"+
							"<div class=\"horas_planner\">"+horas_planner[s]+"</div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"0\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"1\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"2\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"3\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"4\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"5\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
							"<div class=\"dias_planner\" hora=\""+horas_planner[s]+"\" dia=\"6\" semana=\""+(semana)+"\"  mes=\""+this.mes+"\" anio=\""+this.anio+"\" > </div>"+
						"</div>";

			}
			html += "</div>";
			this.html = html
			//console.log(html)
			$("#contenido-planner-j").css("height",(this.height + 10)+"px")
			$("#contenido-planner-j").css("width",(this.width + 15)+"px")
			//$("#contenido-planner-j").html(html)
			this.vertirEnDom();
			//this.construccionEstiloPlanner();

			/*if(arguments.length > 0)
				this.disponiblidad = arguments[0].split(",")
				
			/*$("div.dias_planner").bind("mouseover",sobreHora)
			$("div.dias_planner").bind("mouseout",fueraHora)*/
			
			$("div.dias_planner").bind("mousedown",asignarOremoverHora)
			
			

	}catch(error){
		alert(error)
	}
};
Planner.prototype.vertirEnDom = function() {
	
	$(this.selectorjquery).html(this.html);
}
Planner.prototype.inicalizacionYnavegacionPlanner = function() {
	/*Evento interno de la navegacion en el planner*/
	elemento = this;
	if(arguments[0])
		elemento.inhabilitacion_planner = true;

	$("div#mes_ida_planner").css("display","block")

	if($(elemento.id_input).val()!="")
		elemento.datos_planner = $(elemento.id_input).val().split(",");
	
};
Planner.prototype.eventosNavegacion = function() {
	
	/*Eventos de la navegacion*/
	elemento = this;

	$("div#f_posterior").mousedown(function(evento) {
		/*Si avanza, los parametros de la funcion de construccion interna, se transforman en 1 para el primero y 0 para el segundo*/
		if(evento.which==1){
			elemento.construccionInterna(1,0);
			elemento.pintarDias();
		}

	});

	$("div#f_anterior").mousedown(function(evento) {
		/*Si avanza, los parametros de la funcion de construccion interna, se transforman en 0 para el primero y 1 para el segundo*/
		if(evento.which==1){
			elemento.construccionInterna(0,-1);
			elemento.pintarDias();
		}

	});

};
