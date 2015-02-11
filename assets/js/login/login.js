/* title: my_contents
 * Eventos pagina de inicio de mis cursos, carga de terminos, anadir PIN para registrar
 * un contenido o ruta, recarga de pagina.
 *
 * Author: Yeisson Ibarra - yeissonibarra@gmail.com.
 * Date: 6 de Octubre de 2013.
 */


/* variable: element_pin
 * Identificar el id del contenido. */
var element_pin = null;

/* variable: ajaxConection
 * Ruta del ajaxConection.php. */
var ajaxConection = null;

var idUser = null;

/* inicializar el documento. */
$(document).ready(function() {
    initApp();

    if (!window.location.origin) {
			window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
		}

		if (window.location.origin == 'http://pruebascursos.aulasamigas.com') {
			ajaxConection = 'http://pruebasapp.aulasamigas.com/class/AjaxConection.php';
		} else if (window.location.origin == 'http://amigaslive.net') {
			ajaxConection = 'http://amigaslive.net/aulasamigas/class/AjaxConection.php';
		} else if (window.location.origin == 'http://cursos.aulasamigas.com') {
			ajaxConection = 'http://app.aulasamigas.com/class/AjaxConection.php';
		}

    /* terminos y condiciones, iniciar funcion. */
    get_terms();

   /*Evento click al rechazar términos y condiciones */
   $("a.termsP").click(function(event){
      $("li#poliP").removeClass("active");
      $("li#termsP").addClass("active");
   });

   /*Evento click al rechazar términos y condiciones */
   $("a.poliP").click(function(event){
      $("li#termsP").removeClass("active");
      $("li#poliP").addClass("active");
   });

   /*Evento click al rechazar términos y condiciones */
   $("a#forgotPass").click(function(event){
      $('#email_check').val('');
      $('#email_check_lb').empty();
   });

   //Restaurar contraseña.
    $('#reset_password').click(function(event) {
        event.preventDefault();
        resetPass();
    });

    /**
    * Restaurar contraseña.
    */
    $('#email_check').keypress(function (e) {
      if (e.which == 13) {
        event.preventDefault();
        resetPass();
      }
    });

    /**
    * Resetear checkbox.
    */
    $('#txtPassword').keypress(function (e) {
      $('#rememberMe').attr('checked', false);
    });

    /**
    * Enter pin.
    */
    $('#txt_new_pin').keypress(function (e) {
      if (e.which == 13) {
        event.preventDefault();
        add_pin();
      }
    });

    //Restaurar contraseña.
    $('#rememberMe').click(function(event) {
        if($(this).is(':checked')) {
            rememberMe(1);
        } else {
            rememberMe(0);
        }
    });

    /*Evento click al rechazar términos y condiciones dando click fuera de la ventana modal */
    $(".modal-backdrop").click(function(evento)
    {
        termsAndCondictionsEv(0);
    });

    /*Evento click al rechazar términos y condiciones dando click en la X*/
    $(".close").click(function(evento)
    {
        termsAndCondictionsEv(0);
    });

    /*Evento click al rechazar términos y condiciones */
    $("#declineTerm").click(function(evento)
    {
        termsAndCondictionsEv(0);
    });

    /*Evento click al aceptar términos y condiciones */
    $("#acceptTerm").click(function(evento)
    {
        termsAndCondictionsEv(1);
    });

    /* registrar un nuevo usuario */
    $("#btn_sub_reg").click(function(evento) {
        evento.preventDefault();

        var datos_formulario = $('#formRegUser').serialize();

        /* validar campos */
        if(datos_formulario != '' && is_email($('#email').val()) == true && valid_string('name') == true && valid_string('fname')) {
            if (valid_email() && valid_pass()) {

                $('#formRegUser').submit();
            }

            return true;
        } else {
            valid_string('name'); valid_string('fname'); valid_email('email'); valid_pass('pass');

            //KeyUp
            $('#name').keyup(function() {
                valid_string('name');
            });

            $('#fname').keyup(function() {
                valid_string('fname');
            });

            $('#email').keyup(function() {
                valid_email('email');
            });

            $('#pass').keyup(function() {
                valid_pass('pass');
            });

            return false;
        }

        valid_string('name'); valid_string('fname'); valid_email('email'); valid_pass('pass');

        //KeyUp
        $('#name').keyup(function() {
            valid_string('name');
        });

        $('#fname').keyup(function() {
            valid_string('fname');
        });

        $('#email').keyup(function() {
            valid_email('email');
        });

        $('#pass').keyup(function() {
            valid_pass('pass');
        });

        return false;
    });
});

/* function: resetPass
 * Función para restaurar contraseña.
 *
 * parameter:
 *      void.
 *
 * return:
 *      void.
 */
function resetPass() {
    $('#email_check_lb').empty();
    console.log($('#email_check').val());
        //Validar email para el restablecimiento de la contraseña.
        if ($('#email_check').val() != undefined && $('#email_check').val() != '') {
            checkEmail($('#email_check').val());
        } else {
            $('#email_check_lb').fadeIn('slow', function() {
                //To do: Alejo
                $('#email_check_lb').append('<div class="UI-alert_block UI-alert_block-Error"><p>Por favor corrige tu E-mail.</p></div>');
            });
        }
}

/* Function: isEmail
 * Validar el email.
 *
 * Parameter:
 *      email - String email del usuario.
 *
 * Return:
 *      email - Boolean verdadero si la cadena no contiene caracteres especiales de lo contrario false.
 */
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

/* function: checkEmail
 * Valida si el email existe
 *
 * parameters:
 *      email - string email que se verificará
 *
 * return:
 *      void.
 */
function checkEmail(Email)
{
	console.log(base_url + 'login/checkEmail');
    $.post(base_url + 'login/checkEmail', {'Email': Email}, function(data){
        console.log(JSON.stringify(data));
        data = JSON.parse(data);
        $('#email_check_lb').empty();

        if (data != undefined && data[0].mySQL == 1) {
            sendEmail(Email);
        } else {
            //To do: Alejo
            $('#email_check_lb').fadeIn();
            $('#email_check_lb').append('<div class="alert alert-block fade in alert-error" style=""><p>El correo electrónico no existe, por favor verifícalo e intenta nuevamente.</p></div>');
        }
    });
}
/* Function: sendEmail
 * Enviar Email para la restauracion de la contraseña.
 *
 * Paremeter:
 *      email - String Email del usuario.
 *
 * Return:
 *      void.
 */
function sendEmail(Email) {
    $.post(base_url + 'login/sendEmail', {'Email': Email}, function(data){

        data = JSON.parse(data);
        $('#email_check_lb').empty();

        if (data != undefined && data == 1) {
            $('#reset_password').fadeOut('slow');

            $('#email_check').remove();
            $('#btn_reset').remove();

            $('#email_check_lb').append('<div class="alert alert-block fade in alert-success"><p>Por favor revisa tu correo electrónico.</p></div>');
            $('#email_check_lb').fadeIn();

        } else {
            //To do: Alejo
            $('#email_check_lb').fadeIn();
            $('#email_check_lb').append('<div class="alert alert-block fade in alert-error" style=""><p>&iexcl;No se ha podido enviar el código a su correo electrónico, por favor intentalo de nuevo.</p></div>');
        }
    });
}

/* function: initApp
 * constructor de funciones definidas.
 *
 * parameter:
 *      void.
 *
 * return:
 *      void.
 */
function initApp() {
    $('#div_alert_pin').fadeOut('fast');
    $('#div_alert_pin').addClass('out');

    /* determinar el sexo del usuario en el registro. */
    $(".btn-group button").on('click', function() {
        $('input[name="txtGenero"]').val($(this).data('gender'));
    });

    /* evento enter agregar PIN. */
    $('body').keyup(function(event) {
        if($('#enter-pin-modal').hasClass('in') && event.keyCode == 13) {
            add_pin();
        }
    });
}


/* function: open_modal_pin
 * Abrir modal con el id del contenido.
 *
 * parameter:
 *      event - Object elemento para ingresar el PIN.
 *
 * return:
 *      void.
 */
function open_modal_pin(event) {
    var element = $(event.currentTarget).context;
    element_pin = $(element).prop('id');
}


/* function: add_pin
 * Añadir PIN
 *
 * parameter:
 *      void.
 *
 * return:
 *      void.
 */
function add_pin() {
    var pin = $('#txt_new_pin');
    var value_content = element_pin.split('_');
    /*$.ajax({
    	url: base_url + 'controller_login/sendcorreo',
        type: 'POST',
        dataType: 'json',
        success: function(result_query) {
        	console.log(result_query);
        }
    });*/
    $.ajax({
        url: base_url + 'login/add_pin',
        type: 'POST',
        data: 'pin=' + pin.val() + '&content=' + value_content,
        dataType: 'json',
        success: function(result_query) {

        	console.log(result_query);

            if(result_query.code == 701) {
                location.reload();
            } else if (result_query.code == 702) {
            	idUser = result_query.idUser;
            	$('#enter-pin-modal').modal('hide');

            	$('#alert_send_email').empty();
                $('#alert_send_email').append('<div style="display: block" class="alert alert-block">\n\
                													<p>Para poder activar cualquier curso, es necesario que confirmes tu cuenta de <strong>Aulas AMIGAS®</strong>. Te enviaremos un correo a <strong>'+result_query.email+'</strong> para que realices la confirmación.</p>\n\
															        <a class="btn" onclick="send_email_confimation();">Reenviar confirmación</a>\n\
															        <a href="#change_email" data-toggle="modal" >Cambiar dirección de correo</a>\n\
															      </div>');
            } else {
	            $('#div_alert_pin').fadeIn('fast');
                $('#div_alert_pin').addClass('in');
                $('#div_alert_pin').removeClass('out');
                $('#txt_new_pin').val('');
            }
        }, error: function(error) {
            console.log('Ah ocurrido un error: ' + error.message + ', por favor acuda al admin.');
        }
    });
}


/* function: close_pin
 * Cerrar modal de ingresar PIN
 *
 * parameters:
 *      void.
 *
 * return:
 *      void.
 */
function close_pin() {
    $('#div_alert_pin').fadeOut('fast');
    $('#div_alert_pin').addClass('out');
    $('#txt_new_pin').val('');
}


/* function: get_terms
 * Listar los terminos y condiciones.
 *
 * parameters:
 *      void.
 *
 * return:
 *      void.
 */
function get_terms() {
    $.ajax({
        type: 'POST',
        url: base_url + 'login/terms_and_condictions',
        dataType: 'json',
        success: function(data) {
            if(data.code == 601 || data.code == 702) {
                //console.log('Ah ocurrido un error: Terminos y Condiciones');
            } else {
                $('#content_agreements').prop('src', (data.agreements[0].Text).toString());
                $('#content_terms').prop('src', (data.terms[0].Text).toString());
                $( "#legal-trigger" ).trigger( "click" );
            }
        }, error: function(error) {
            console.log('Ah ocurrido un error: ' + error + ', por favor acuda al admin.');
        }
    });
}

/* function: termsAndCondictionsEv
 * Listar los terminos y condiciones.
 *
 * parameters:
 *      state - Int Valor numérico que indica respuesta del usuario. 0 ó 1
 *
 * return:
 *      void.
 */
function termsAndCondictionsEv(state)
{
    $.post(base_url + 'login/update_terms_and_condictions', {'state': state}, function(data){
        console.log(JSON.stringify(data));
        if(data == 2)
            window.location = base_url + 'login/logout';
        else
        {
            if(data == 1)
                window.location = base_url;
        }
    });
}

/* function: rememberMe
 * Listar los terminos y condiciones.
 *
 * parameters:
 *      state - Int Valor numérico que indica respuesta del usuario. 0 ó 1
 *
 * return:
 *      void.
 */
function rememberMe(state)
{
    $.post(base_url + 'login/rememberMe', {'option': state, 'Email': $("#txtEmail").val(), 'Pass': $("#txtPassword").val()}, function(data){
        if(state == 0)
            $("#txtPassword").val('');
    });
}


/* function: valid_string
 * validacion de string para caracteres especiales.
 *
 * parameter:
 *      id - String cadena, sea nombre, apellido, etc...
 *
 * returns:
 *      false - Boolean falso la cadena contiene caracteres especiales.
 *      true - Boolean verdadero la cadena cumple.
 */
function valid_string(id) {
    var pattern = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑ /s]+$/;
    var input_text = $('#' + id);

    /* validar cadena con expresion regular! */
    if (input_text.val().match(pattern) && input_text.val() != '') {
        /* si la contrasena cumple los requerimientos */
        input_text.css({ borderColor: "#00FF00" });

        $('#'+id+'_lb').fadeOut('fast', function(){
            $('#'+id+'_lb').empty();
        });

        return true;
    } else {
        /* si la contrasena no cumple los requerimientos */
        input_text.css({ borderColor: "#FF3300" });
        $('#'+id+'_lb').fadeIn('slow', function() {
            $('#'+id+'_lb').empty();
            //To do: Alejo
            $('#'+id+'_lb').append('<div style="margin:10px 5px; padding:0; background-color:#da4f49; text-align:center; color:white;"><p>Por favor verifique los datos, 3 car&aacute;cteres m&iacute;nimo.</p></div>');
        });

        return false;
    }
}


/* function: validar_email
 * Se valida que los email coincidan para el registro de una cuenta AA.
 *
 * returns:
 *      true - Boolean verdadero, coinciden los emails.
 *      false - Boolean false, no coinciden los emails.
 */
function valid_email(email) {
    var check_email = $('#' + email);

    if(!is_email(check_email.val())) {
        check_email.css({ borderColor: "#FF3300" });

        $('#'+email+'_lb').fadeIn('slow', function(){
            $('#'+email+'_lb').empty();
            //To do: Alejo
            $('#'+email+'_lb').append('<div class="container alert alert-warning alert-danger" role="alert"><p>Por favor verifique su correo el&eacute;ctronico.</p></div>');
        });
    } else {
        check_email.css({ borderColor: "#00FF00" });

        $('email_lb'+email+'_lb').fadeOut(function() {
            $('email_lb'+email+'_lb').empty();
        });
    }

    return true;
}


/* function: is_email
 * validar el email.
 *
 * parameter:
 *      email - String email del usuario.
 *
 * return:
 *      email - Boolean verdadero si la cadena no contiene caracteres especiales de lo contrario false.
 */
function is_email(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


/* function: validar_pass
 * valida que el password tenga almenos un digito y un alfanumerico, ademas que tenga una longitud de 8 a 15 caracteres.
 *
 * return:
 *      true - Boolean contraseÒa correcta.
 *      false - Boolean contraseÒa incorrecta.
 */
function valid_pass() {
    var pass_txt = $('#pass'), RegExPattern = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,15})$/;

    if ((pass_txt.val().match(RegExPattern)) && (pass_txt.attr("value") != '')) {
        //si la contrase√±a cumple los requerimientos
        pass_txt.css({ borderColor: "#00FF00" });

        $('#pass_lb').fadeOut(function() {
            $('#pass_lb').empty();
        });

        return true;
    } else {
        if (pass_txt.attr("value") != '') {
            //si la contrase√±a no cumple los requerimientos
            pass_txt.css({ borderColor: "#FF3300" });
            $('#pass_lb').fadeIn('slow', function(){
                $('#pass_lb').empty();
                //To do: Alejo
                $('#pass_lb').append('<div class="container alert alert-warning alert-danger" role="alert"><p>Ingresa una contrase&ntilde;a entre 8 y 15 caracteres, debe contener por lo menos un n&uacute;mero y una letra.</p></div>');
            });

            return false;
        }
    }
}

/* function: send_email_confimation
 * Envía el email al usuario para que confirme su correo.
 *
 * return:
 *      void.
 */
function send_email_confimation() {
	$.ajax({
        url: ajaxConection,
        type: 'POST',
        data: 'case=93&txtId='+idUser,
        dataType: 'json',
        success: function(result_query) {

        	$('#alert_send_email').empty();
            $('#alert_send_email').append('<div style="display: block" class="alert alert-block">\n\
                													<p>Se ha enviado un correo a tu cuenta.</p>\n\
															      </div>');
        }, error: function(error) {
            console.log('Ah ocurrido un error: ' + error + ', por favor acuda al admin.');
        }
    });
}

/* function: change_email
 * Funcion para el cambio de correo.
 *
 * return:
 *      void.
 */
function change_email() {
	$.ajax({
        url: base_url + 'login/update_user_email',
        type: 'POST',
        data: 'new_email='+$('#txt_new_email').val(),
        dataType: 'json',
        success: function(result_query) {

        	if(result_query.code == 1){
	        	$('#change_email').modal('hide');
	        	$('#alert_send_email').empty();
                $('#alert_send_email').append('<div style="display: block" class="alert alert-block">\n\
                													<p>Se ha enviado un correo a <strong>'+result_query.email+'</strong> para que realices la confirmación.</p>\n\
															      </div>');
        	}else{
	        	$('#change_email').modal('hide');
	        	$('#alert_send_email').empty();
                $('#alert_send_email').append('<div style="display: block" class="alert alert-block">\n\
                													<p>Error al intentar cambiar el correo electrónico del usuario.</p>\n\
															      </div>');
        	}


        	console.log(result_query);
        }, error: function(error) {
            console.log('Ah ocurrido un error: ' + error + ', por favor acuda al admin.');
        }
    });
}
