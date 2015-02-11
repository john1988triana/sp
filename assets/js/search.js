var constants = new Array();
constants.ROOT  = '';
constants.STRING  = "string";
constants.JSON   = "json";
constants.OBJECT  = "object";


$(document).on('ready', init_search);

function init_search(){

	//$("#cbo_tema").addAttr("disabled");

	if (!window.location.origin) {
		window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
	}

	if (window.location.origin == 'http://amigaslive.net') {
		constants.ROOT  = 'http://amigaslive.net/superprofe/';
	} else if(window.location.origin == 'http://cursos.aulasamigas.com'){
		constants.ROOT  = 'http://cursos.aulasamigas/';
	} else if(window.location.origin == 'http://pruebascursos.aulasamigas.com'){
		constants.ROOT  = 'http://amigaslive.net/ciudadano_digital/';
	}

	$("select#area").change(function(){
		//get_tema();
	});
}

/*function get_tema(){
	$("#cbo_tema").empty();
	var idArea = $("select#area option:selected").attr("value");

	$.post(constants.ROOT+'busqueda/get_tema', {'id_area': idArea}, function(data)
	{
		load_area(JSON.parse(data));
	});
}*/

function load_area(data){

	var areas = '';

	if(data.length > 0)
	{
		$.each(data, function(key, value)
		{       
			areas += '<option value="' + value.id_topic + '">' + value.topicName + '</option>';                  
		});
		$("#cbo_tema").empty().removeAttr("disabled");
		$("#cbo_tema").append(areas);
	}
}