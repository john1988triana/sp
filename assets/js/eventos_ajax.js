$(document).ready(function(){

	$(".ver_perfil").mousedown(function() {
		
		clase = $(this).attr("name")
		var inc = $(this).hasClass("incompleto")
		datos_nombre = $( "input[type='hidden'][class="+clase+"]").val();
		datos_nombre = datos_nombre.split("correo:");
		area = $("input#nombre_area").val();
		if(inc){
			fecha_selec = "";
		}else{
			fecha_selec = $("#fecha_sel").val();
			fecha_selec = fecha_selec.split("/");
			fecha_selec = fecha_selec[2]+" "+fecha_selec[0]+" "+parseInt(fecha_selec[1])+" "+$("#hora_sel").val();
		}
//cbo_hora
		nombre = datos_nombre[0];
		correo = datos_nombre[1];
		
		$.post("../assets/js/contenido_perfil.php",
			{prop:clase, nom: nombre, corr: correo, area: area, fecha_sel: fecha_selec},
			function(data,status) {
				
				top1 = $("#perfil_html").offset().top;
				
				$("html,body").animate({scrollTop:top1},880);
				$("#perfil_html").html(data);
		        $(".redondo").css("border-radius","10px")


			})
    
            
        
	})


})