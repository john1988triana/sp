<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Registro extends CI_Controller {
	private $circles='';
    private $message ='';
	public function __construct() {
		parent::__construct();
		$this->load->library('aulasamigas');
		$this->load->model('model_superprofe');
		$this->load->library('form_validation');
	}

	/**
	*	PUNTOS DE ENTRADA
	*/
	//Index
	public function index(){
		$this->load->view("header");
		$this->load->view("registro/view_inicio_registro");
		$this->load->view("footer");
	}
	//Registro Alumnos
	public function alumno(){
		
		$isTeacher = array('isTeacher' => 0);
		$this->session->set_userdata($isTeacher);
		
		$sUrlGoogle = $this->aulasamigas->urlGoogle(base_url() . 'login/login_google', FALSE, $this->input->ip_address(), FALSE);
		$urlFacebook = $this->login_fb();
		$arr_send_data = array('sLoginGoogle' => json_decode($sUrlGoogle),
       						'sLoginFacebook' => $urlFacebook,
       						'circles' => $this->circles,
       						'message' => $this->message,
							'user_type'=> '');    
		$this->load->view('header');   											            				
		$this->load->view('registro/register', $arr_send_data);
		$this->load->view('footer');
	}
	/****************************************************login con facebook****************************************************/
    public function login_fb() {
		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$user_fb = $this->facebook->getUser();
		if ($user_fb) {
			try {
				$data_fb['user_profile'] = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				$user_fb = null;
			}
		}else {
			$this->facebook->destroySession();
		}

		if ($user_fb) {

            $data_fb['logout_url'] = site_url('login/logout_fb'); // Logs off application
            // OR 
            // Logs off FB!
             $data_fb['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
        	$data_fb['login_url'] = $this->facebook->getLoginUrl(array(
        		'redirect_uri' => site_url('login/login_fb'), 
                'scope' => array("email") // permissions here
                ));
        }
        if(!empty($data_fb['user_profile'])){
	        $user_profile = ($data_fb['user_profile']);  
	        $user_profile = $this->aulasamigas->user_fb($user_profile['id'], $user_profile['email'], $user_profile['first_name'], $user_profile['last_name'], $user_profile['gender'], $this->input->ip_address(), $this->input->get('code'));
	        $data_user = json_decode($user_profile, true);
	       if (!empty($data_user[0]['IdUser'])) {
	       		$user = $this->model_superprofe->checkUser($data_user[0]['FirstName'],
												$data_user[0]['FamilyName'],
												$data_user[0]['IdUser'],
												$data_user[0]["isTeacher"]);
			//INICIO DE SESSION DEL USUARIO
				$aSessionUser = array(
					'bLoginIn' => TRUE,
					'sIdUser' => $data_user[0]['IdUser'],
					'sFirstName' => $data_user[0]['FirstName'],
					'sEmail' => $data_user[0]['Email'],
					'isTeacher' => $data_user[0]["isTeacher"],
					 'id_content' => '768',
					'sImageUrl' => $data_user[0]['ImageUrl'],
					'bAdmin' => TRUE,
					'isFacebookUser' => TRUE
				);
				$this->session->set_userdata($aSessionUser);
				redirect('login/validate_view');
			}	
        }else{
	        return ($data_fb['login_url']);
        }
    }
	public function profesor(){
		//aquí todo el código para el registro de usuarios//
        $isTeacher = array('isTeacher' => 1);
		$this->session->set_userdata($isTeacher);
		
		$sUrlGoogle = $this->aulasamigas->urlGoogle(
			base_url() . 'login/login_google', FALSE, $this->input->ip_address(), FALSE
		);
		
		$urlFacebook = $this->login_fb();
		
		$arr_send_data = array(
			'sLoginGoogle' => json_decode($sUrlGoogle),
			'sLoginFacebook' => $urlFacebook,
			'message' => $this->message,
			'step'=> 0,
			'circles' =>1
			);    
        
		$this->load->view('header');	
		$this->load->view('registro/register_teacher', $arr_send_data);
		$this->load->view('footer');
	}
	public function datos_personales(){
		if($this->session->userdata('isTeacher')== 0){
			redirect(base_url());
		}
		$data_user['data_user'] = json_decode($this->aulasamigas->getUsersInfo(array($this->session->userdata('sIdUser'))), true);
		$data_user['countries'] = $this->aulasamigas->getCountriesInfo();
		$country = $data_user["data_user"][0]["Country"];
		foreach($data_user['countries'] as $count){
			if($count["IdCountry"] == $country){
				$country = $count["Code"];
				break;
			}
		}
		$data_user["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry($country))->cities);
		$data_user['document_type'] = json_decode($this->aulasamigas->getDocumentTypes(), true);
		
		$this->load->view('header');
		$this->load->view('registro/circles', array("circles"=>2));
		$this->load->view('registro/completeprofile', $data_user);
		$this->load->view('footer');
	}
	public function crea_pagina(){
		if($this->session->userdata('isTeacher')== 0){
			redirect(base_url());
		}
		$datos = $this->model_superprofe->loadUser($this->session->userdata('sIdUser'));
		$datos["levels"] = $this->model_superprofe->getLevels();
		$datos["levels"][] = array("id"=>"-1","name"=>"Todos (Primaria,Bachillerato,Universidad,Otros)");
		if($this->input->get("error") == "terms"){
			$datos["error"] = "Debes aceptar los terminos y condiciones al final de esta página.";
		}else{
			$datos["error"] = "";
		}
		$this->load->view('header');
		$this->load->view('registro/circles', array("circles"=>3));
		$this->load->view('perfiles/profile_professor',$datos);
		$this->load->view('footer');
	}
	
	public function validacion(){
		if($this->session->userdata('isTeacher')== 0){
			redirect(base_url());
		}
		//$resultados_validacion = $this->model_superprofe->get_validacion_pasos_profe($this->session->userdata('sIdUser'));
		$datos = $this->model_superprofe->loadUser($this->session->userdata('sIdUser'));
		
		if($datos["validation_background"] == 1 &&
			$datos["validation_professional_ref"] == 1 &&
			$datos["validation_personal_ref"] == 1 &&
			$datos["validation_interview"] == 1 &&
			$datos["validation_personal_test"] == 1 &&
			$datos["validation_agreement"] == 1 ){
			redirect(base_url("perfil"));
		}
		
		
		$this->load->view('header');
		$this->load->view('registro/circles', array("circles"=>4));
		$this->load->view('registro/view_ultimo_paso',$datos);
		$this->load->view('footer');
		
		if($datos["instructions_sent"]==0){
			$config['mailtype'] = "html";
			$this->load->library('email');
			$this->email->initialize($config);
					
			$this->email->from('hola@superprofe.co', 'Superprofe');
			$this->email->to($datos["Email"]); 
			$this->email->cc('nadezda@superprofe.co'); 
			$this->email->subject('Superprofe.co - Agenda tu entrevista para convertirte en SuperProfe.');
			$this->email->message('<div><div>Hola</div><div><br></div><div>Recibe un cordial saludo!</div><div><br></div><div>Mi nombre es Nadezda Vera, soy Directora de <a href="http://superprofe.co" target="_blank">superprofe.co</a> y estoy muy entusiasmada por entrevistarte lo más pronto posible.</div><div><br></div><div>Te pido que por favor ingreses a la siguiente enlace: <a href="https://calendly.com/nadezda" target="_blank">https://calendly.com/nadezda</a> &nbsp;y des clic en "Entrevista para ser un SúperProfe", selecciona el día y luego la hora para agendar tu entrevista.</div><div><br></div><div>En el siguiente enlace encontrarás como es el procedimiento para convertirte en un SúperProfe <a href="http://bit.ly/1yctyNQ" target="_blank">http://bit.ly/1yctyNQ</a></div><div><br></div><div>Adicionalmente te envío este video para que conozcas un poco más de nosotros</div><div><a href="https://www.youtube.com/watch?v=x97biL1lKBE" target="_blank">https://www.youtube.com/watch?<wbr>v=x97biL1lKBE</a>&nbsp;</div><div><br></div><div>La entrevista la realizaremos en la sede de SuperProfe ubicada en la Calle 69 No. 11 A - 33 es una casa con el nombre de Aulas Amigas, solo si estás en otra ciudad que no es Bogotá la realizaremos por skype a través de la cuenta nadezda.vera</div><div><br></div><div>Si tienes alguna inquietud no dudes en escribirme a <a href="mailto:nadezda@superprofe.co" target="_blank">nadezda@superprofe.co</a></div><div><br></div><div><br></div><div>Nadezda Vera</div><div>Directora Latam</div><div><br></div><div>¡Nuestros profesores son súper héroes del conocimiento!</div><div><br></div><div>Tel.:<a href="tel:%2B57%20%281%293105513" value="+5713105513" target="_blank">+57 (1)3105513</a> &nbsp; Cel. &nbsp;(+57) 301 470 5463&nbsp;</div><div>Dir.: Calle 69 11 A - 33 Bogotá , Colombia.</div><div>E-mail: &nbsp;<a href="mailto:hola@superprofe.co" target="_blank">hola@superprofe.co</a>&nbsp;</div><div>Visite nuestra web: <a href="http://www.superprofe.co" target="_blank">www.superprofe.co</a></div><div>Skype: super-profe</div><div>Twitter: @superprofecol</div></div>');  
			
			$this->email->send();
			
			$data = array("instructions_sent"=>1);
			$this->model_superprofe->update($this->session->userdata('sIdUser'),$data,$this->session->userdata('isTeacher'));
		}
	}
	/* Function: ajaxGetCities
	* Obtiene la lista de ciudades correspondientes a un país idendentificado por su id.
	* 
	*
	* Parameter:
	* 
	*
	* Return:
	*    $aUserInfo - Array con la información del usuario.
	*    
	*/
	public function ajaxCities()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Code', 'Id del país', 'trim|required');
		//valido si los datos requeridos existen.
		if ($this->form_validation->run() == FALSE)
		{
			$aReturn = array(
				'cod'   =>  0,
				'messa' =>  $this->lang->line('contactCitiesError')
			);
		  echo json_encode($aReturn);
		}
		else
		{
		   $Code  =  $this->input->post('Code');
		   $this->load->library('aulasamigas');
		   $ob = json_decode(json_decode($this->aulasamigas->getCitiesByCountry($Code))->cities);
		   $this->utf8_decode_deep($ob);
		   echo json_encode($ob);
		}
	}
	private function utf8_decode_deep(&$input) {
		if (is_string($input)) {
			$input = utf8_decode($input);
		} else if (is_array($input)) {
			foreach ($input as &$value) {
				$this->utf8_decode_deep($value);
			}
			
			unset($value);
		} else if (is_object($input)) {
			$vars = array_keys(get_object_vars($input));
			
			foreach ($vars as $var) {
				$this->utf8_decode_deep($input->$var);
			}
		}
	}
	public function register($ajax = false) {
		if ($this->session->userdata('bLoginIn')) {
			redirect("index");
		}
		
		//echo "test..... " . json_encode($this->input->post());
		//return;
		
		$this->load->library('aulasamigas');
		//Verifica si los datos llegan por Get llamada token
		if ($this->input->get_post('code')) {$this->_loginGoogle();redirect('login');}
		//Peticion de la Url a aulas amigas para iniciar session con Google
		$sUrlGoogle = $this->aulasamigas->urlGoogle(base_url(), FALSE, $this->input->ip_address(), FALSE);
		///Peticion de la url para uniciar con facebook
		$urlFacebook = $this->login_fb();
		
		if( $this->input->post('tipo_usuario') == "acudiente"){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtName', 'Nombre Acudiente', 'required|max_length[45]');
			$this->form_validation->set_rules('txtLast', 'Apellido Acudiente', 'required|max_length[45]');
			$this->form_validation->set_rules('txtEmailNew', 'Correo', 'trim|required|valid_email|max_length[45]');
			$this->form_validation->set_rules('txtPassword', 'Contraseña', 'required|matches[txtPasswordConfirm]|min_length[6]');
			$this->form_validation->set_rules('txtPasswordConfirm', 'Confirmar contraseña', 'required|min_length[6]');
			$this->form_validation->set_rules('txtNameStudent', 'Nombre Estudiante', 'required|max_length[45]');
			$this->form_validation->set_rules('txtLastStudent', 'Apellido Estudiante', 'required|max_length[45]');
			$this->form_validation->set_rules('txtPhoneTutor', 'Teléfono acudiente', 'required|min_length[7]');
			$contents['sLoginGoogle'] = json_decode($sUrlGoogle);
			$contents['sLoginFacebook'] = $urlFacebook;
			if ($this->form_validation->run() ) {
				$this->load->library('aulasamigas');
				//Agregar el nuevo usuario al sistema de AulasAmigas
				
				$result = json_decode($this->aulasamigas->addUser(
					$this->input->post('txtName'), $this->input->post('txtLast'), $this->input->post('txtEmailNew'), 
					$_SERVER['REMOTE_ADDR'], $this->input->post('txtPassword'), 'h', 
					$this->session->userdata('isTeacher'), 0, '768'));
				
				$this->load->model('model_superprofe');
				
				//echo json_encode($result);
				
				if($result->mySQL == 1){
					$aInfoUser = $this->aulasamigas->whoAmI($result->id_user);
					$user = $this->model_superprofe->checkUser($this->input->post('txtNameStudent'),
													$this->input->post('txtLastStudent'),
													$result->id_user,
													$aInfoUser[0]["isTeacher"],
													$this->input->post('txtName'),
													$this->input->post('txtLast'),
													$this->input->post('txtPhoneTutor'),
													1);
													
					if($this->input->post('txtEmail')){
						$email_temp = $this->input->post('txtEmail');
					}else if($this->input->post('txtEmailNew')){
						$email_temp = $this->input->post('txtEmailNew');
					}
					//INICIO DE SESSION DEL USUARIO
					$aSessionUser = array(
						'bLoginIn' => TRUE,
						'sIdUser' => $result->id_user,
						'sFirstName' => $this->input->post('txtNameStudent'),
						'sLastName'	=> $this->input->post('txtLastStudent'),
						'sEmail' => $email_temp,
						'isTeacher' => $aInfoUser[0]["isTeacher"],
						'id_content' => '768',
						'sImageUrl' => $user["picture"]
					);
					$this->session->set_userdata($aSessionUser);
					$this->_setConnectionHistory();
					
					if($ajax){
						echo json_decode(true);
						return;
					}
					if($aInfoUser[0]["isTeacher"] == 0){
						$reqid = $this->session->userdata("req_id");
						if(!empty($reqid)){
							$data = array("id_student"=>$aSessionUser["sIdUser"]);
							$this->model_superprofe->updateRequest($reqid,$data);
							redirect(base_url("clase/solicitar/".$reqid));
						}else{
							redirect('login/validate_view');
						}
					}else{
						redirect('login/validate_view');
					}
				}else if($result->mySQL == 5){
					if($ajax){
						echo json_decode(false);
						return;
					}
					$arr_send_data = array(
					'sLoginGoogle' => json_decode($sUrlGoogle),
					'sLoginFacebook' => $urlFacebook,
					'circles' => $this->circles,
					'message' => '<div class="col-md-12">
							<div class="alert alert-danger" role="alert">
								<p>El usuario ya existe.</p>
							</div>
						</div>',
					'name' => $this->input->post('txtName'),
					'firstname' => $this->input->post('txtLast'),
					'reg_email' => $this->input->post('txtEmailNew'),
					'user_type' => $this->input->post('tipo_usuario'),
					'fname_student' => $this->input->post('txtNameStudent'),
					'lname_student' => $this->input->post('txtLastStudent'),
					'phone_tutor' => $this->input->post('txtPhoneTutor'),
					);
					
				}
			}else {
				if($ajax){
					echo json_decode(false);
					return;
				}
				$arr_send_data = array(
					'sLoginGoogle' => json_decode($sUrlGoogle),
					'sLoginFacebook' => $urlFacebook,
					'circles' => $this->circles,
					'message' => '<div class="col-md-12">
							<div class="alert alert-danger" role="alert">
								<p>Todos los datos son obligatorios.</p>
								<p>La contraseña debe contener mínimo 6 caracteres.</p>
								<p>El número de teléfono debe contener mínimo 7 dígitos.</p>
							</div>
						</div>',
					'name' => $this->input->post('txtName'),
					'firstname' => $this->input->post('txtLast'),
					'reg_email' => $this->input->post('txtEmailNew'),
					'user_type' => $this->input->post('tipo_usuario'),
					'fname_student' => $this->input->post('txtNameStudent'),
					'lname_student' => $this->input->post('txtLastStudent'),
					'phone_tutor' => $this->input->post('txtPhoneTutor'),
					);
			}
		}
		else {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtName', 'Nombre', 'required|max_length[45]');
			$this->form_validation->set_rules('txtLast', 'Apellido', 'required|max_length[45]');
			$this->form_validation->set_rules('txtEmailNew', 'Correo', 'trim|required|valid_email|max_length[45]');
			$this->form_validation->set_rules('txtPassword', 'Contraseña', 'required|matches[txtPasswordConfirm]|min_length[6]');
			$this->form_validation->set_rules('txtPasswordConfirm', 'Confirmar contraseña', 'required|min_length[6]');
			$contents['sLoginGoogle'] = json_decode($sUrlGoogle);
			$contents['sLoginFacebook'] = $urlFacebook;
			if ($this->form_validation->run() ) {
				$this->load->library('aulasamigas');
				//Agregar el nuevo usuario al sistema de AulasAmigas
				
				$result = json_decode($this->aulasamigas->addUser(
					$this->input->post('txtName'), $this->input->post('txtLast'), $this->input->post('txtEmailNew'), 
					$_SERVER['REMOTE_ADDR'], $this->input->post('txtPassword'), 'h', 
					$this->session->userdata('isTeacher'), 0, '768'));
				
				$this->load->model('model_superprofe');
				
				//echo json_encode($result);
				
				if($result->mySQL == 1){
					$aInfoUser = $this->aulasamigas->whoAmI($result->id_user);
					$user = $this->model_superprofe->checkUser($this->input->post('txtName'),
													$this->input->post('txtLast'),
													$result->id_user,
													$aInfoUser[0]["isTeacher"]);
													
					if($this->session->userdata('isTeacher') == 1) {
						$this->createUserProfileName($user);
					}
					
					if($this->input->post('txtEmail')){
						$email_temp = $this->input->post('txtEmail');
					}else if($this->input->post('txtEmailNew')){
						$email_temp = $this->input->post('txtEmailNew');
					}
					//INICIO DE SESSION DEL USUARIO
					$aSessionUser = array(
						'bLoginIn' => TRUE,
						'sIdUser' => $result->id_user,
						'sFirstName' => $this->input->post('txtName'),
						'sLastName'	=> $this->input->post('txtLast'),
						'sEmail' => $email_temp,
						'isTeacher' => $aInfoUser[0]["isTeacher"],
						 'id_content' => '768',
						'sImageUrl' => $user["picture"]
					);
					$this->session->set_userdata($aSessionUser);
					$this->_setConnectionHistory();
					
					if($ajax){
						echo json_decode(true);
						return;
					}
					if($aInfoUser[0]["isTeacher"] == 0){
						$reqid = $this->session->userdata("req_id");
						if(!empty($reqid)){
							$data = array("id_student"=>$aSessionUser["sIdUser"]);
							$this->model_superprofe->updateRequest($reqid,$data);
							redirect(base_url("clase/solicitar/".$reqid));
						}else{
							redirect('login/validate_view');
						}
					}else{
						redirect('login/validate_view');
					}
				}else if($result->mySQL == 5){
					if($ajax){
						echo json_decode(false);
						return;
					}
					$arr_send_data = array(
					'sLoginGoogle' => json_decode($sUrlGoogle),
					'sLoginFacebook' => $urlFacebook,
					'circles' => $this->circles,
					'message' => '<div class="col-md-12">
							<div class="alert alert-danger" role="alert">
								<p>El usuario ya existe.</p>
							</div>
						</div>',
					'name' => $this->input->post('txtName'),
					'firstname' => $this->input->post('txtLast'),
					'reg_email' => $this->input->post('txtEmailNew'),
					'user_type' => $this->input->post('tipo_usuario')
					);
					
				}
			}else {
				if($ajax){
					echo json_decode(false);
					return;
				}
				$arr_send_data = array(
					'sLoginGoogle' => json_decode($sUrlGoogle),
					'sLoginFacebook' => $urlFacebook,
					'circles' => $this->circles,
					'message' => '<div class="col-md-12">
							<div class="alert alert-danger" role="alert">
								<p>Todos los datos son obligatorios.</p>
								<p>La contraseña debe contener mínimo 6 caracteres.</p>
							</div>
						</div>',
					'name' => $this->input->post('txtName'),
					'firstname' => $this->input->post('txtLast'),
					'reg_email' => $this->input->post('txtEmailNew'),
					'user_type' => $this->input->post('tipo_usuario'),
					);
			}
		}
		
		
		$this->load->view('header');
		
		if($this->session->userdata('isTeacher') == 1){
			$this->load->view('registro/register_teacher', $arr_send_data);
		}
		else {
			$this->load->view('registro/register', $arr_send_data);
		}
		
		
		
		
		
		$this->load->view('footer');
	}
	
	public function validatePage(){
		if($this->input->post("terms")=="on"){
			$this->model_superprofe->update_professor_data(2);
			redirect('login/validate_view');
		}else{
			redirect('registro/crea_pagina?error=terms');
		}
	}
	
	
	protected function createUserProfileName($teacher, $number = 0) {
		
		//echo "try: " .$number;
		$fname = str_replace("ñ", "n", $teacher["firstName"]);
		$fname = str_replace("Ñ", "n", $fname);
		$fname = str_replace("á", "a", $fname);
		$fname = str_replace("Á", "a", $fname);
		$fname = str_replace("é", "e", $fname);
		$fname = str_replace("í", "i", $fname);
		$fname = str_replace("Í", "i", $fname);
		$fname = str_replace("ó", "o", $fname);
		$fname = str_replace("Ó", "o", $fname);
		$fname = str_replace("ú", "u", $fname);
		$fname = str_replace("Ú", "u", $fname);
		$fname = str_replace(" ", ".", $fname);
		
		$lname = str_replace("ñ", "n", $teacher["lastName"]);
		$lname = str_replace("Ñ", "n", $lname);
		$lname = str_replace("á", "a", $lname);
		$lname = str_replace("Á", "a", $lname);
		$lname = str_replace("é", "e", $lname);
		$lname = str_replace("í", "i", $lname);
		$lname = str_replace("Í", "i", $lname);
		$lname = str_replace("ó", "o", $lname);
		$lname = str_replace("Ó", "o", $lname);
		$lname = str_replace("ú", "u", $lname);
		$lname = str_replace("Ú", "u", $lname);
		$lname = str_replace(" ", ".", $lname);
		
		
		
		if($number > 0){
			$userProfilename = strtolower($fname) . "." . strtolower($lname) . $number;
			
		}
		else {
			$userProfilename = strtolower($fname) . "." . strtolower($lname);
		}
		
		$data = $this->model_superprofe->checkUserProfileName($userProfilename);
		
		
		
		if($data == true){
			$teacher["userprofile"] = $userProfilename;
			$id_user = $teacher["id_user"];
			$this->model_superprofe->update($id_user,$teacher,1);
			//echo "ready!";
			return $userProfilename;
		}
		else {
			$number++;
			$this->createUserProfileName($teacher, $number);
		}
		
	}
	
	/************************************************** OLD IMPLEMENTAION ***************************************************************/
	public function validateCompleteProfile(){
		if ($this->input->post('btnCompleteProfile')){
			$this->form_validation->set_rules('cpNumDateTime', 'Fecha de nacimiento', 'trim|required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('cpTypeDocument', 'Tipo de documento', 'trim|required|min_length[1]|max_length[3]|xss_clean');
			$this->form_validation->set_rules('cpNumDoc', 'Numero de documento', 'trim|required|min_length[1]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('cpNumPhone', 'Numero de celular', 'trim|required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('cpAddressTeacher', 'Dirección de residencia', 'trim|required|min_length[5]|max_length[60]|xss_clean');
			$this->form_validation->set_rules('cbo_country', 'País de residencia', 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('cbo_city', 'Ciudad de residencia', 'trim|required|min_length[3]|max_length[30]|xss_clean');
			
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->load->model('model_superprofe');
			
			if ($this->form_validation->run() != FALSE) {
				$cpNumDateTime = $this->input->post('cpNumDateTime');
				$cpNumDateTime =explode("-", $cpNumDateTime);
				$data_user_send = array(
									'Email' => $this->session->userdata('sEmail'),
									'DayBorn' => $cpNumDateTime[0],
									'MonthBorn' => $cpNumDateTime[1],
									'YearBorn' => $cpNumDateTime[2],
									'DocType' => $this->input->post('cpTypeDocument'),
									'DocNumber' => $this->input->post('cpNumDoc'),
									'Phone' => $this->input->post('cpNumPhone'),
									'Address' => $this->input->post('cpAddressTeacher'),
									'Country' => $this->input->post('cbo_country'),
									'City' => $this->input->post('cbo_city')															
								);
				$result = ($this->aulasamigas->updateContactUserInfo($data_user_send));
				$result = json_decode($result, true);
				if($result['result']['mySQL'] == 1){
					$this->model_superprofe->update_professor_data(1);
					redirect('login/validate_view');
				}
			}else{
		     	 $result = $this->model_superprofe->update_professor_data(1);
		     	 switch ($result['status']) {
				    case 1:
				    	$data_user['data_user'] = json_decode($this->aulasamigas->getUsersInfo(array($this->session->userdata('sIdUser'))), true);
				    	$cpNumDateTime = $this->input->post('cpNumDateTime');
						$cpNumDateTime =explode("-", $cpNumDateTime);
						
						$data_user['data_user'][0]['DocType'] = $this->input->post('cpTypeDocument');
				    	$data_user['data_user'][0]['DayBorn'] = $cpNumDateTime[0];
				    	$data_user['data_user'][0]['MonthBorn'] = $cpNumDateTime[1];
				    	$data_user['data_user'][0]['YearBorn'] = $cpNumDateTime[2];
				    	$data_user['data_user'][0]['DocNumber'] = $this->input->post('cpNumDoc');
			    		$data_user['data_user'][0]['Phone'] = $this->input->post('cpNumPhone');			    	
					    $data_user['document_type'] = json_decode($this->aulasamigas->getDocumentTypes(), true);	
				    	$data_user['countries'] = $this->aulasamigas->getCountriesInfo();

						$this->load->view('header');
				    	$this->load->view('registro/completeprofile', $data_user);
						$this->load->view('footer');
					break;
				}
			}
		}
	}
	/* funcion creada por Esneyder Pena para registro de inicio de sesion en el historial de conexion */
	/* function: _setConnectionHistory
     * Funcion para actualizar el historial de conexion, identificandose por plataforma a la que ingresa.
     *
     * Parameter:
     *      void.
     *
     * Return:
     *      $session - Boolean FALSE or TRUE
     *
     */

	private function _setConnectionHistory() {
		$this->load->library('aulasamigas');
		$this->aulasamigas->cHistoryByPlataform($this->session->userdata('sIdUser'), $_SERVER['REMOTE_ADDR'], $this->session->userdata('id_content'));
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */