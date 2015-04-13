<?php
/* title: login
 * Clase login .
 *
 * Author: Alejandro sossa - Yeisson Ibarra.
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {
	/* function: __construct
     * Constructor del control login carga el modelo login_model desde el principio para realizar validaciones correspondientes. */
    private $sUrlGoogle; 
    private $circles='';
    private $message ='';
    
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('user_agent');
		if (($this->agent->browser() == 'Internet Explorer' and $this->agent->version() < 9)
			OR ( $this->agent->browser() == 'Chrome' and $this->agent->version() < 26.0)
			OR ( $this->agent->browser() == 'Firefox' and $this->agent->version() < 21.0)
			OR ( $this->agent->browser() == 'Safari' and $this->agent->version() < 5.0)) {
			redirect('update_browser');
		} else {
			/* carga de la libreria de validacion para formularios. */
			$this->load->library('form_validation');
			$this->load->model('model_process_login');
			$this->load->model('model_superprofe');
			$this->load->library('aulasamigas');
           	
           	if($_SERVER['HTTP_HOST'] == 'superprofe.co' || $_SERVER['HTTP_HOST'] == 'www.superprofe.co')        
                    $config['upload_path'] = '/home/superprofecom/public_html/assets/img/uploads/';
            else if($_SERVER['HTTP_HOST']=='amigaslive.net')
            		$config['upload_path'] = '/home/amigas/public_html/superprofe/application/uploads/';

            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '20000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            
            $this->load->library('upload', $config);
		}
	}

	/* function: index
     * Retorna una vista de login y registro natural o con google.
     *
     * parameter:
     *      void.
     *
     * return:
     *      $sLoginGoogle - A la vista View_login
     */

	public function index() {
		$this->load_view_login(FALSE);
	}
	
	/* function: load_view_login
     * Funcion de retorno con los datos de google.
     *
     *
     * parameter:
     *      $parameter validador si va a cargar vista con error de usuario o la de inicio
     *
     * return:
     *
     */
	public function load_view_login($parameter){
		//Peticion de la Url a aulas amigas para iniciar session con Google
		$this->sUrlGoogle = $this->aulasamigas->urlGoogle(
			base_url('login/login_google'), FALSE, $this->input->ip_address(), FALSE
		);
		///Peticion de la url para uniciar con facebook
		$urlFacebook = $this->login_fb();
		//valido si se desea añadir una cuenta de Google
		if ($this->input->get_post('checkReg') AND $this->input->get_post('checkReg') == "1") {
			$this->_asocGoogleAccount();
		}
		
		$contents['sLoginGoogle'] = json_decode($this->sUrlGoogle);
		$contents['sLoginFacebook'] = $urlFacebook;
		$contents['message'] = '';
		
		
		if (is_array($contents) AND ! empty($contents)) {
			if($parameter == FALSE){
				$this->load->view('header');
				$this->load->view('login/login_view', $contents);
				$this->load->view('footer');
			}else{
				$contents['message'] = '<div class="col-md-12">
                                                            <div class="alert alert-danger" role="alert" id="alert">
                                                                <p>Usuario o contraseña incorrecta</p>
                                                            </div>
                                                        </div>';
				$this->load->view('header');									 
				$this->load->view('login/login_view', $contents);
				$this->load->view('footer');
			}
			
		}
		
		$id_user = $this->session->userdata('sIdUser');
		
		if (!empty($id_user) AND $id_user != NULL) {
			$my_contents['id_user'] = $id_user;

			//Valido términos y condicionesz
			if ($this->_checkTermsAgreements() == TRUE) {
				$this->validate_view();
			} else {
				$this->load->view('login/terms_and_conditions');
			}
		}

	}
	
	/* function: login_google
     * Funcion de retorno con los datos de google.
     *
     *
     * parameter:
     *      void.
     *
     * return:
     *
     */
     public function login_google(){
	     //Verifica si los datos llegan por Get llamada code
		if ($this->input->get_post('code')) {
			$this->_loginGoogle();	
		}

		$id_user = $this->session->userdata('sIdUser');

		if (!empty($id_user) AND $id_user != NULL) {
			$my_contents['id_user'] = $id_user;

			//Valido términos y condicionesz
			if ($this->_checkTermsAgreements() == TRUE) {
				$this->validate_view();
			} else {
				$this->load->view('login/terms_and_conditions');
			}
		}

     }

	/* function: validate_view
     * Funcion para validar cual es la vista que va a cargar.
     *
     *
     * parameter:
     *      void.
     *
     * return:
     *
     */
     
     public function validate_view(){
	    if (!$this->session->userdata('sIdUser')) {
			redirect('index');
		}
	     if($this->session->userdata('isTeacher') == 1){
			$status = $this->model_superprofe->getProfessorStatus($this->session->userdata('sIdUser'));
	     	switch ($status) {
				case 0:
					redirect("registro/datos_personales");
					break;
			    case 1:
					redirect("registro/crea_pagina");
					break;
			    case 2:
					redirect("registro/validacion");
					break;
				case 3:
					redirect("superprofe");
					break;
			}
	     }else{
		     redirect('busqueda');
	     }	          	 
	}
	
		/* Function: ok_condiciones
  * Funcion para aceptas las pliticas y condiciones.
  * 
  *
  * Parameter:
  * 
  *
  * Return:
  *    void.
  *    
  */
	public function ok_condiciones(){
	
		$terms = json_decode($this->aulasamigas->get_terms_and_agreements(), true);
		//alido si ya se aceptaron los términos, o si debo mostrar el cuao modal.
		$result = json_decode($this->aulasamigas->updateTermsAgreements($terms['agreements'][0]['Id'], $terms['terms'][0]['Id'], $this->session->userdata('sIdUser')), true);
					
		if($result[0]['mySQL'] == 1){
			$this->validate_view();
		}else{
			redirect('login/logout');
		}
	}

	/* function: login_in
     * Funcion para iniciar session en ETEST recibe el correo y contraseña del usuario.
     *
     *
     * parameter:
     *      void.
     *
     * return:
     *
     */

	public function log_in() {
		$this->form_validation->set_rules('txtEmail', $this->lang->line('Email'), 'trim|required|valid_email|max_length[45]|xss_clean');
		$this->form_validation->set_rules('txtPassword', $this->lang->line('Password'), 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect();
		} else {
			$result = $this->aulasamigas->loginUser(
				$this->input->post('txtEmail'), $this->input->post('txtPassword')
			);
			if (!empty($result)) {
				$aRespuesta = json_decode($result);
				try {
					if (isset($aRespuesta->mySQL) and $aRespuesta->mySQL == 1) {
						$aInfoUser = $this->aulasamigas->whoAmI($aRespuesta->id_user);
						$user = $this->model_superprofe->checkUser($aInfoUser[0]["FirstName"],
												$aInfoUser[0]["FamilyName"],
												$aInfoUser[0]["IdUser"],
												$aInfoUser[0]["isTeacher"]);
						
						//INICIO DE SESSION DEL USUARIO
						$aSessionUser = array(
							'bLoginIn' => TRUE,
							'sIdUser' => $aRespuesta->id_user,
							'sFirstName' => $aInfoUser[0]["FirstName"],
							'sFamilyName' => $aInfoUser[0]["FamilyName"],
							'sEmail' => $aInfoUser[0]["Email"],
							'sImageUrl' => $user["picture"],
							'isTeacher'=>$aInfoUser[0]["isTeacher"],
							'sPhone' => $aInfoUser[0]["Phone"],
							'sMovil' => $aInfoUser[0]["Movil"],
							'sCountry' => $aInfoUser[0]["Country"],
							'sCity' => $aInfoUser[0]["City"],
							'id_content' => 768,
							'bAdmin' => $aInfoUser[0]["admin"]
						);						
						
						$this->session->set_userdata($aSessionUser);
						$this->_setConnectionHistory();
						if($aInfoUser[0]["isTeacher"] == 0){
							$reqid = $this->session->userdata("req_id");
							$pending = $this->session->userdata("redirect_on_login");
							if(!empty($reqid) && $pending){
								$data = array("id_student"=>$aSessionUser["sIdUser"]);
								$this->model_superprofe->updateRequest($reqid,$data);
								redirect(base_url("clase/solicitar/".$reqid));
							}else{
								
								if($this->input->post('userprofile')){
									redirect(base_url("/" . $this->input->post('userprofile') ."?div=div_agenda" ));
								}
								else{
									$this->validate_view();
								}
							}
						}else{
							if($this->input->post('userprofile')){
								redirect(base_url("/" . $this->input->post('userprofile') ."?div=div_agenda" ));
							}
							else{
								$this->validate_view();
							}
						}
					}else{
						$this->load_view_login(TRUE);
					}
				} catch (Exception $e) {
					var_dump($aRespuesta);
				}
			} else {
			if($ajax){
				echo json_decode(false);
				return;
			}
			}
		}
	}

	/* function: logout
     * Funcion para cerrar la session del usuario de Etest
     *
     *
     * parameter:
     *      void.
     *
     * return:
     *      void.
     */

	public function logout() {
		
		if (!$this->_loginIn())
			redirect();
			
		$this->logout_fb();
			
		$this->session->sess_destroy();
		redirect();
	}

	/*     * ***************************************Funciones hechas por Edwin************************************************ */
	/* function: updateUserEmail
     * Funcion para actualizar el email del usuario. Adicionalmente envía correo de comprobación de Email.
     *
     * parameter:
     *      Se recibe por POST  en nombre del nuevo email.
     *
     * return:
     *
     */

	public function update_user_email() {
		$new_email = $this->input->post('new_email');

		if ($new_email != NULL || !empty($new_email)) {
			$this->load->library('aulasamigas');

			$result_data = json_decode($this->aulasamigas->updateUserEmail($this->session->userdata('sIdUser'), $new_email), true);


			if ($result_data[0]['status'] == 'sent') {
				$this->session->set_userdata(array('sEmail' => $new_email));
				echo json_encode(array('code' => 1, 'message' => 'Email cambiado y enviado para verificar', 'email' => $new_email));
			} else {
				echo json_encode(array('code' => 0, 'message' => 'Email no cambiado'));
			}
		} else {
			echo json_encode(array('code' => 702, 'message' => 'Error en el nuevo Email'));
		}
	}

	/*Funciones creadas por Edwin Gutiérrez*/
	/* function: register
 	 * Función asociada al registro mediante la cuenta de google.
  	 *
  	 * Author: Edwin Gutierrez
 	 *
 	 */
	public function register() {

		$sUrlGoogle = $this->aulasamigas->urlGoogle(
			base_url() . 'login', FALSE, $this->input->ip_address(), FALSE
		);
		
		///Peticion de la url para uniciar con facebook
		$urlFacebook = $this->login_fb();
		
		$this->load->view('registro/register', array('sLoginGoogle' => json_decode($sUrlGoogle), 'sLoginFacebook' => $urlFacebook));
	}

	public function resetPassword(){
		$this->load->view('header');
		$this->load->view('login/view_reset_password');
		$this->load->view('footer');
	}

	/* function: crearUsuario
     * Prepara las variables de la vista del registro en caso de ingresar como profesos.
     *
     * parameter:
     *      void.
     *
     * return:
     *      void.
     */
	public function crearUsuario() {
        //aquí todo el código para el registro de usuarios//
 				 				
        		$isTeacher = array(
									'isTeacher' => 1
								  );
				
				$this->session->set_userdata($isTeacher);
				
				
                $this->circles = '<div class="col-md-12" id="circles">
                    <div class="col-md-3">
                        <img src="../assets/img/btn1.png" alt="">
                        <p class="text-center">Regístrate</p>
                    </div>
                    <div class="col-md-3">
                        <img src="../assets/img/btn2.png" alt="">
                        <p class="text-center">Completa tus datos</p> 
                    </div>
                    <div class="col-md-3">
                        <img src="../assets/img/btn3.png" alt="">
                        <p class="text-center">Crea tu página</p>
                    </div>
                    <div class="col-md-3">
                        <img src="../assets/img/btn4.png" alt="">
                        <p class="text-center">Estamos validando tu cuenta</p>
                    </div>	
        		</div>';
        		
        		$this->load_crear_usuario();
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
			if($user_profile==6){
				$this->facebook->destroySession();
				redirect(base_url("login"));
			}
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
					'sImageUrl' => $user["picture"],
					'bAdmin' => TRUE,
					'isFacebookUser' => TRUE
				);
				
				$this->session->set_userdata($aSessionUser);
				if($data_user[0]["isTeacher"] == 0){
					$reqid = $this->session->userdata("req_id");
					$pending = $this->session->userdata("redirect_on_login");
					if(!empty($reqid) && $pending){
						$data = array("id_student"=>$aSessionUser["sIdUser"]);
						$this->model_superprofe->updateRequest($reqid,$data);
						redirect(base_url("clase/solicitar/".$reqid));
					}else{
						$this->validate_view();
					}
				}else{
					$this->validate_view();
				}
			}
        }else{
	        return ($data_fb['login_url']);
        }
        
    }
    
    public function logout_fb(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        //redirect();
    }

    
	/* function: checkEmail
     * Verificar si el email existe.
     *
     * parameters:
     *      $email - String email del usuario recibido por post al cual se le enviará el acceso para restaurar contraseña.
     *
     * return:
     *
     */

	public function checkEmail() {

		//valido si los datos requeridos existen.
		
			$email = $this->input->post('Email');
			$this->load->library('aulasamigas');
			$result = $this->aulasamigas->checkEmail($email);
			echo $result;
		
	}

	/* function: sendEmail
     * Envía email para restablecer contraseña.
     *
     * parameters:
     *      $email - String email del usuario recibido por post al cual se le enviará el acceso para restaurar contraseña.
     *
     * return:
     *
     */

	public function sendEmail() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('Email', 'email del usuario', 'trim|required');
		//valido si los datos requeridos existen.
		if ($this->form_validation->run() == FALSE) {
			$aReturn = array(
				'cod' => 0,
				'messa' => $this->lang->line('Es necesario que envíe un email válido.')
			);
			echo json_encode($aReturn);
		} else {
			$email = $this->input->post('Email');
			$this->load->library('aulasamigas');
			$result = $this->aulasamigas->sendEmail($email, '768');
			echo $result;
		}
	}

	/* function: rememberMe
     * Función para recordar los datos de ingreso del usuario.
     *
     * parameters:
     *      $email - String email del usuario recibido por post.
     *      $pass - String contraseña del usuario recibida por post.
     * return:
     *
     */

	public function rememberMe() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('Email', 'email del usuario', 'trim|required');
		$this->form_validation->set_rules('Pass', 'password del usuario', 'trim|required');
		$this->form_validation->set_rules('option', 'option del usuario', 'trim|required');
		//valido si los datos requeridos existen.
		if ($this->form_validation->run() == FALSE) {
			$aReturn = array(
				'cod' => 0,
				'messa' => $this->lang->line('Datos de sesión incompletos.')
			);
			echo json_encode($aReturn);
		} else {
			$email = $this->input->post('Email');
			$pass = $this->input->post('Pass');
			$option = $this->input->post('option');
			//Cargo helper para usar cookies.
			$this->load->helper('cookie');
			if ($option == 1) {
				$this->input->set_cookie(array('name' => 'my_email', 'value' => $email, 'expire' => 60 * 60 * 24 * 365));
				$this->input->set_cookie(array('name' => 'my_pass', 'value' => $pass, 'expire' => 60 * 60 * 24 * 365));
				echo 1;
			} else {
				delete_cookie("my_email");
				delete_cookie("my_pass");
				echo 0;
			}
		}
	}

	/* function: getGoogleState
     * Función para obtener información de una cuenta Google, como si ésta se asoció correctamente, o si actualmente
     * Se está en sesión con una.
     *
     * parameters:
     *
     * return:
     *
     */

	public function getGoogleState() {
		//Carga la libreria de Aulas amigas para realizar las conexiones de usuario
		$this->load->library('aulasamigas');

		//Verifico si la sesión actual es con una cuenta Google, o si ya hay una cuenta de Google asociada.
		if ($this->session->userdata('isGoogleUser') OR $this->aulasamigas->checkAsociateUserGoogle($this->session->userdata('sIdUser')) == 1) {
			if ($this->session->userdata('ascGInfo')) {
				echo json_encode(array('code' => 1, 'ascGInfo' => $this->session->userdata('ascGInfo'), 'isGoogleUser' => TRUE));
			} else
				echo json_encode(array('code' => 0, 'isGoogleUser' => TRUE));
		}else {
			//Peticion de la Url a aulas amigas para iniciar session con Google
			$sUrlGoogle = $this->aulasamigas->urlGoogle(
				base_url() . 'controller_login', FALSE, $this->input->ip_address(), FALSE
			);
			
			///Peticion de la url para uniciar con facebook
			$urlFacebook = $this->login_fb();
			
			if ($this->session->userdata('ascGInfo')) {
				echo json_encode(array('code' => 3, 'ascGInfo' => $this->session->userdata('ascGInfo'), 'urlGoogle' => json_decode(str_replace('controller_login', 'controller_login?checkReg=1', $sUrlGoogle))));
			} else
				echo json_encode(array('code' => 2, 'urlGoogle' => json_decode(str_replace('controller_login', 'controller_login?checkReg=1', $sUrlGoogle))));
		}
	}

	public function unsetGoogleInfo() {
		$this->session->unset_userdata('ascGInfo');
	}

	//////////////////////////////////////////////////////////////
	//  FUNCIONES PRIVADAS
	/* ------------------------------------------------- Conjunto de funciones privadas del control login --------------------------------------------------------- */
	/* function: _loginGoogle
     * Retorna la session del usuario iniciada con google
     *
     * parameter:
     *
     * return:
     *
     */
	private function _loginGoogle() {
		
		$aDataUser = $this->aulasamigas->urlGoogle(
			base_url('login/login_google'), FALSE, $this->input->ip_address(), $this->input->get_post('code')
		);
		
		
		$aDataUser = json_decode($aDataUser, true);
		
		if (isset($aDataUser[0]['IdUser'])) {
			$user = $this->model_superprofe->checkUser($aDataUser[0]['FirstName'],
												$aDataUser[0]['FamilyName'],
												$aDataUser[0]['IdUser'],
												$aDataUser[0]["isTeacher"]);
			//INICIO DE SESSION DEL USUARIO
			$aSessionUser = array(
				'bLoginIn' => TRUE,
				'sIdUser' => $aDataUser[0]['IdUser'],
				'sFirstName' => $aDataUser[0]['FirstName'],
				'sEmail' => $aDataUser[0]['Email'],
			    'isTeacher' => $aDataUser[0]["isTeacher"],
			    'id_content' => '768',
				'sImageUrl' => $aDataUser[0]['ImageUrl'],
				'bAdmin' => TRUE,
				'isGoogleUser' => TRUE
			);
			$this->session->set_userdata($aSessionUser);
			if($aDataUser[0]["isTeacher"] == 0){
				$reqid = $this->session->userdata("req_id");
				$pending = $this->session->userdata("redirect_on_login");
				if(!empty($reqid) && $pending){
					$data = array("id_student"=>$aSessionUser["sIdUser"]);
					$this->model_superprofe->updateRequest($reqid,$data);
					redirect(base_url("clase/solicitar/".$reqid));
				}else{
					$this->validate_view();
				}
			}else{
				$this->validate_view();
			}
		}
	}

	/* function: _setPermissionUser
     * Cuando el usuario se conecta por primera vez al sistema despues de registrarse en amigas por invitacion se pasan los permisos a su cuenta oficial y se borra el correo de los permisos temporales
     *
     *
     * Parameter:
     *
     *
     * Return:
     *
     *
     */
	private function _setPermissionUser() {
		if ($this->session->userdata('sEmail')) {
			$aTempoPermissionUser = $this->login_model->getPermissionTemp($this->session->userdata('sEmail'));
			if (!empty($aTempoPermissionUser)) {
				$aBatchPermission = array();
				foreach ($aTempoPermissionUser as $key) {
					array_push($aBatchPermission, array(
						'id_section' => $key->id_section,
						'id_user' => $this->session->userdata('sIdUser'),
						'enabled' => $key->enabled
					)
							  );
				}
				$this->login_model->insertBatchPermissionUser($aBatchPermission);
				$this->login_model->updatePermissionTempUser($this->session->userdata('sEmail'));
			}
		}
	}

	/* function: _loginIn
     * Retorna el estado de la session del usuario
     *
     *
     * parameter:
     *      void.
     *
     * return:
     *      $session - Boolean FALSE or TRUE
     *
     */
	private function _loginIn() {
		return $this->session->userdata('bLoginIn');
	}

	/* funcion creada por Esneyder Pena para registro de inicio de sesion en el historial de conexion */
	/* function: _setConnectionHistory
     * Funcion para actualizar el historial de conexion, identificandose por plataforma a la que ingresa.
     *
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

	/* function: _checkTermsAgreements
     * Funcion para verificar si el usuario aceptó los términos y condiciones actuales
     *
     *
     * Parameter:
     *      void.
     *
     * Return:
     *      $session - Boolean FALSE or TRUE
     *
     */

	private function _checkTermsAgreements() {
		$this->load->library('aulasamigas');
		//Obtengo términos y condiciones
		$terms = json_decode($this->aulasamigas->get_terms_and_agreements(), true);
		//alido si ya se aceptaron los términos, o si debo mostrar el cuao modal.
		$state = json_decode($this->aulasamigas->checkTermsAgreements($terms['agreements'][0]['Id'], $terms['terms'][0]['Id'], $this->session->userdata('sIdUser')));

		if (!empty($state->state)){
			if($state->state){
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}

	/* function: _asocGoogleAccount
     * Asocia una cuenta de google a la cuenta AM3 del usuario, si ésta no tiene una asociada.
     *
     * parameter:
     *
     * return:
     *
     */

	private function _asocGoogleAccount() {
		//Carga la libreria de Aulas amigas para realizar las conexiones de usuario
		$this->load->library('aulasamigas');

		//intento asociar cuenta
		$aDataUser = $this->aulasamigas->asocGoogleAccount($this->session->userdata('sIdUser'), $this->input->get_post('code'));
		$jDataUser = json_decode($aDataUser, true);

		if ($jDataUser['code'] == 1) {
			//Algunos datos de sesión
			$aSessionUser = array(
				'isGoogleUser' => TRUE,
				'ascGInfo' => $aDataUser
			);
			$this->session->set_userdata($aSessionUser);
		} else {
			//Cargo mensaje de error al asociar la cuenta.
			$this->session->set_userdata(array('ascGInfo' => $aDataUser));
		}
		redirect('controller_main');
	}

 

   
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */