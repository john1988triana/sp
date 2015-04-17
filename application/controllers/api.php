<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Api extends CI_Controller {

	
	public function __construct() {
		parent::__construct();

		$this->load->database('superpro', TRUE);
		$this->load->model('model_superprofe');
		$this->load->library('form_validation');
		$this->load->library('aulasamigas');	
        date_default_timezone_set("America/Bogota");	
	}

	public function index(){
	}

	/*Funcion: */
	/*Function: separar_clase
		funcion para la separacion de la clase
		Paremetros: NA
		return: NA

	*/
	public function separar_clase()
	{
		$anio = date("Y");
        $mes = date("m");
        $dia = date("d");
        $hora = date("H");
        $comision = $this->input->post("precio_profe") * 0.2;
		$datos_separacion = array(
									"fecha_solicitud" => $anio."-".$mes."-".$dia,
									"hora_solicitud" => $hora.":00:00",
									"id_estudiante" => $this->session->userdata('sIdUser'),
									"ciudad_clase" => $this->input->post('ciudad_p'),
									"direccion_clase" => $this->input->post('direccion_clase'),
									"presencial" => 1,
									"fecha" => $this->input->post('input_date'),
                    				"hora" => $this->input->post('cbo_hora'),
                    				"cantidad_clases" => "1",
                    				"id_area" => $this->input->post('area'),
                    				"id_tematica" => $this->input->post('cbo_tema'),
                    				"como_se_entero" => "N/A",
                    				"acepto_terminos" => 1,
                    				"observaciones" => "prueba",
                    				"valor_clase" => $this->input->post("precio_profe"),
                    				"comision_super_profe" => $comision,
                    				"estado_clase" => "solicitada",
                    				"codigo_promocion" => "NA",
                    				"tbl_perfiles_usuarios_id_usuario" => $this->input->post("id_us")
								 );
	
    	$fecha = "";$tfecha="";$horas = array();$hora_in = array();$hora_fin = array();$imagen = "";$franja = "";$valor_hora ="";

		$partes = $this->input->post('dispon');
		$disp = explode(',', $this->input->post('dispon'));
		
		$tfecha = explode(' ', $disp[0]);

		if(strlen($tfecha[5])==1) {$dia = "0".$tfecha[5];} else {$dia = $tfecha[5];};
		
		$fecha = $tfecha[4]."-".($tfecha[3] + 1)."-".$dia;
        $apunta = explode(' ', $disp[0]);
        $horas = explode('-',$apunta[1]);
        $hora_in[0] = $horas[0].":00:00";
        
        if((6 <=  (int)$horas[0]) && (12 > (int)$horas[0]))
                $franja .= "manana";
        else if((12 <=  (int)$horas[0]) && (18 > (int)$horas[0]))
                $franja .= "tarde";
        else if((18 <=  (int)$horas[0]) && (22 > (int)$horas[0]))
                $franja .= "noche";
        
        for ($n = 1, $h = 0; $n < count($disp); $n++){

            $apunta = explode(' ', $disp[$n - 1]);
            $apunta2 = explode(' ', $disp[$n]);
            $horas = explode('-',$apunta[1]);
            $horas2 = explode('-',$apunta2[1]);
            
            //if($horas2[0] - $horas[1] > 0){
                
            $hora_fin[$h] = $horas[1].":00:00"; 
            $h++; 
            $hora_in[$h] = $horas2[0].":00:00";
        	$tfecha = explode(' ', $disp[$n]);
        	
        	if(strlen($tfecha[5])==1) {$dia = "0".$tfecha[5];} else {$dia = $tfecha[5];};
        	$fecha .=",".$tfecha[4]."-".($tfecha[3] + 1)."-".$dia;

			if((6 <=  (int)$horas2[0]) && (12 > (int)$horas2[0]))
				$franja .= ",manana";
			else if((12 <=  (int)$horas2[0]) && (18 > (int)$horas2[0]))
				$franja .= ",tarde";
			else if((18 <=  (int)$horas2[0]) && (22 > (int)$horas2[0]))
				$franja .= ",noche";

            //}
            
        }
        $apunta = explode(' ', $disp[count($disp) - 1]);
        $horas = explode('-',$apunta[1]);
        $hora_fin[count($hora_fin)] = $horas[1].":00:00";
        $hora_fin = implode("-",$hora_fin);
        $hora_in = implode("-",$hora_in);

        $datos_disponibilidades = array(
									   		'hora_inicio' => $hora_in,
									   		'hora_fin' => $hora_fin,
							                'fecha' => $fecha,
									   		'franja_horaria' => $franja,
									   		'texto_disp'=>$partes
									   	);
        
		$this->model_superprofe->update_info_tablas("tbl_disponibilidades",$datos_disponibilidades,array('tbl_perfiles_usuarios_id_usuario' => md5($this->input->post("id_us"))));
		$this->model_superprofe->set_info_tablas("tbl_programacion_clases",$datos_separacion);
		$contenido_area = $this->aulasamigas->getAreasByContent($this->input->post('area'));
		$ciudades = $this->aulasamigas->getCitiesByCountry('COL');
		$ciudades = json_decode($ciudades, true);
        $ciudades = json_decode($ciudades['cities'], true);
        $ciudad_sel = "";

        foreach ($ciudades as $key => $value) {
        	
        	if($value['ID']==$this->input->post('ciudad_p'))
        		{
        			$ciudad_sel=$value['Name'];
        			break;
        		}

        }

        if($_SERVER['HTTP_HOST']=='superprofe.co')         
                $url = "http://superprofe.co/sp/confirmacion/confir/";
        else if($_SERVER['HTTP_HOST']=='amigaslive.net')
                $url = "http://amigaslive.net/superprofe/confirmacion/confir/";
        
        $correo = $this->input->post("e-mail-est");
        $correo = explode("@", $correo);
		/*$contenido = '<b>Hola Profesor '.$this->input->post("nombre_despues").'</b><br>
						El estudiante '.$this->session->userdata('sFirstName').' acaba de programar la siguiente clase:<br>
						Clase de '.$this->input->post('nombre_area').' sobre '.$this->input->post('tema_sel').' en '.$ciudad_sel.' 
						y quiere tomarla el próximo '.$this->input->post('fecha_sel').' a las '.$this->input->post('hora_sel').' en la dirección.'.$this->input->post('direccion_clase').'
						Cliquea el siguiente vinculo para confirmar la clase: <a href=http://amigaslive.net/superprofe/confirmacion/confir/'.md5($this->input->post("id_us")).'/'.$correo[0].'/'.$correo[1].'/'.$this->input->post('nombre_area').'-sobre-'.$this->input->post('tema_sel').'>Click aqui.</a>';*/
              $contenido = "<body>
                            <div >
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
                              <font color=#FFF size=+3 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>Hola ".$this->input->post("nombre_despues")."</font><font color=#30A173 size=+1 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif><br> Recibe un cordial saludo del equipo de Superprofe.co</font></td>
                            </tr>
                            </table>
                            <table width=500 border=0 cellspacing=0 cellpadding=20>
                                    <tr>
                                      <td colspan=2><font color=#666 size=-1 face=Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>El estudiante ".$this->session->userdata('sFirstName')." acaba de programar la siguiente clase: ".$this->input->post('nombre_area')." sobre ".$this->input->post('tema_sel')." en ".$ciudad_sel."y quiere tomarla el próximo ".$this->input->post('fecha_sel')." a las ".$this->input->post('hora_sel')." horas en la ".$this->input->post('direccion_clase').".<br>
                                      Cliquea el siguiente vinculo para confirmar la clase: <a href=".$url.md5($this->input->post("id_us"))."/".$correo[0]."/".$correo[1]."/".$this->input->post('nombre_area')."-sobre-".$this->input->post('tema_sel').">Click aqui.</a></font></td>
                                    </tr>
                                    </table> 
                              <table width=500 border=0 cellspacing=0 cellpadding=0>
                                    <tr>
                                    <td><img src=".(base_url('assets/img/contacto.png'))." width=250 height=150 alt=contacto/></td>
                                      
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

                                     <img src=".(base_url('assets/img/logo.png'))." width=250 height=47 alt=logo Superprofe/><br>
                                    <font color=#000 size=-1 face='Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif>¡Nuestros profesores son súper héroes del conocimiento!<br>
                                    Tel.:+57 (1)3105513   Cel.  (+57) 301 470 5463 <br>
                                    Dir.: Calle 69 11 A - 33 Bogotá , Colombia.<br>
                                    E-mail:  hola@superprofe.co <br>
                                    Visite nuestra web: www.superprofe.co<br>
                                    Skype: super-profe<br>
                                    Twitter: @superprofecol</font>
                                  </tbody>
                                </table>
                                </div>
                                </body>";
        //var_dump($contenido);

        $config['mailtype'] = "html";

        $this->load->library('email');
        $this->email->initialize($config);
        //var_dump($config);
        $this->email->from('hola@superprofe.co', 'Superprofe');
        $this->email->to($this->input->post("correo_p")); 
        $this->email->cc('hola@superprofe.co'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Superprofe.co - Separacion clase.');
        $this->email->message($contenido);  

        $this->email->send();
		//$this->aulasamigas->sendByMandrill($this->input->post("correo_p"), $this->input->post("nombre_despues"), $contenido, "Superprofe.co - Separacion clase");
		$this->load->view('busqueda/view_notif_clase');
	}
}
/* Location: ./application/controllers/busqueda.php */