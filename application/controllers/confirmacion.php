<?php



if (!defined('BASEPATH'))

	exit('No direct script access allowed');



class Confirmacion extends CI_Controller {



	private $campos;
	private $bd_content;
	private $resultados;



	public function __construct() {

		parent::__construct();


		$this->load->database('superpro', TRUE);
		$this->load->model('model_superprofe');
		$this->load->library('form_validation');
		$this->load->library('aulasamigas');		

	}

	public function index()

	{


	}



    public function logout_fb(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        //redirect();

    }



	public function confir($id_us,$mail,$sufijo,$clase)

	{

		$this->logout_fb();
		$this->session->sess_destroy();
		//redirect();

		if (!$id_us) {

			redirect('index');

		}else

			$this->clase_cfr($id_us,$mail,$sufijo,$clase);

	}

	public function clase_cfr($id_us,$mail,$sufijo,$clase)

	{

		$info = array("mensaje" => "");
		$mail_completo = $mail."@".$sufijo;
		$separo = array("estado_clase" => "");

		if($this->input->post("valor_confirm") !="" && $this->input->post("valor_confirm")){

			$clase = str_replace("-", " ", $clase);
			$datos_profe = $this->aulasamigas->whoAmI($id_us);
			$datos_estud = json_decode($this->aulasamigas->getUserByEmail($mail_completo),true);
			$nombre_estudiante = $datos_estud[0]["FirstName"]." ".$datos_estud[0]["FamilyName"];
			

			$contenido = "<body>
							<table width=500 border=0 cellpadding=0 cellspacing=0 bgcolor=#fff>
							  <tbody>
							    <tr>
							   	  <td colspan=2 align=right><img src=".(base_url('assets/img/logo.png'))." width=250 height=47 alt=logo Superprofe/></td>
							    </tr>
							    <tr>
							      <td colspan=2 width=500><img src=".(base_url('assets/img/niños.png'))." width=500 height=146 alt=Niños Superprofe/></td>
							    </tr>
							    <table width=500 border=0 cellspacing=0 cellpadding=30>
							    <tr>
							      <td colspan=2 bgcolor=#033 width=500>
							      <font color=#FFF size=+3 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>Hola ".$nombre_estudiante."</font><font color=#30A173 size=+1 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif><br> Recibe un cordial saludo del equipo de Superprofe.co</font></td>
							    </tr>
							    </table>";



					//var_dump($info);

							    

			if($this->input->post("valor_confirm")=="aceptado"){

			//var_dump($datos_profe);

					$contenido .= "<table width=500 border=0 cellspacing=0 cellpadding=20>
									    <tr>
									      <td colspan=2><font color=#666 size=-1 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>El profesor ".$datos_profe[0]["FirstName"]." ".$datos_profe[0]["FamilyName"]." acaba de confirmar tu clase de ".urldecode($clase).", estos son los datos del profesor para que puedas ponerte en contacto con él:</font></td>
									    </tr>
									</table>";

					$separo["estado_clase"] = "aceptada";
					$info["mensaje"] = "La clase quedo aceptada";

									#La clase de ".urldecode($clase)." que solicitaste con el profesor ".$datos_profe[0]["FirstName"]." ".$datos_profe[0]["FamilyName"]." fue aceptada";


			}else{



					$contenido .= "<table width=500 border=0 cellspacing=0 cellpadding=20>
									    <tr>
									      <td colspan=2><font color=#666 size=-1 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>El profesor ".$datos_profe[0]["FirstName"]." ".$datos_profe[0]["FamilyName"]." acaba de rechazar tu clase de ".urldecode($clase).", estos son los datos del profesor para que puedas ponerte en contacto con él:</font></td>
									    </tr>
									</table>";

					$separo["estado_clase"] = "rechazada";
					$info["mensaje"] = "La clase quedo rechazada";

			}

			$contenido .= "<table width=500 border=0 cellspacing=0 cellpadding=0>
							    <tr>
							    <td><img src=".(base_url('assets/img/contacto.png'))." width=250 height=150 alt=contacto/></td>
							      <td><font color=#033 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif><strong>Nombre:</strong> ".$datos_profe[0]["FirstName"]." ".$datos_profe[0]["FamilyName"]."<br><strong>Correo electrónico:</strong> ".$datos_profe[0]["Email"]."<br></font></td>
							    </tr>
							    </table>   
							    
							    <table width=500 border=0 cellspacing=0 cellpadding=20>
							    <tr>
							      <td bgcolor=#30A173><font color=#fff size=-1 face='Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>Queremos que no te preocupes nunca más por conseguir Profesor Particular, así que si necesitas otro Profesor o conoces a algún que lo pueda necesitar no dudes en contactarnos.</font></td>
							    </tr>
							    </table>
							   <table width=500 border=0 cellspacing=0 cellpadding=10>
							    <tr>
							    <td width=230></td>
							      <td><font color=#033 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>Que tengas un excelente día!<br>
							Seguimos en contacto,
							<br><strong>Nadezda Vera</strong></font></td>
							    </tr>
							    </table>   
							  </tbody>
                                     <img src=".(base_url('assets/img/logo.png'))." width=250 height=47 alt=logo Superprofe/><br>
                                    <font color=#000 size=-1 face='Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>¡Nuestros profesores son súper héroes del conocimiento!<br>
                                    Tel.:+57 (1)3105513   Cel.  (+57) 301 470 5463 <br>
                                    Dir.: Calle 69 11 A - 33 Bogotá , Colombia.<br>
                                    E-mail:  hola@superprofe.co <br>
                                    Visite nuestra web: www.superprofe.co<br>
                                    Skype: super-profe<br>
                                    Twitter: @superprofecol</font>
							</table>
							</body>";

			//var_dump($this->input->post("nombre_despues"));

			//$this->model_superprofe->set_info_tablas("tbl_programacion_clases",$datos_separacion);

	        
			//$this->aulasamigas->sendByMandrill($mail_completo, $nombre_estudiante, $contenido, "Superprofe.co - Confirmacion de clase");

		}//aceptado

		$this->load->view("confirmacion/view_confirmacion_clase",$info);

	}

}