<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	private $campos;
	private $bd_content;
	private $resultados;
	private $sUrlGoogle; 

	public function __construct() {
		parent::__construct();
		$this->load->database('superpro', TRUE);
		$this->load->model('model_superprofe');
		$this->load->library('form_validation');
		$this->load->library('aulasamigas');
	}
	public function index(){
		$area = $this->input->get("area");
		$topic =  $this->input->get("topic");
		$level =  $this->input->get("level");
		$city = $this->input->get("city");
		$address = $this->input->get("address");
		$date = $this->input->get("date");
		$time = $this->input->get("time");
		$phone = $this->input->get("phone");
		$datos = array(
			"areas" => $this->aulasamigas->getAreasByContent('768'),
			"cities" => $this->aulasamigas->getCitiesByCountry('COL'),
			"levels" => $this->model_superprofe->getLevels(),
			"area" => $area,
			"topic" => $topic,
			"city" => $city,
			"address" => $address,
			"date" => $date,
			"time" => $time,
			"level" => $level,
			"phone"=> $phone,
			"message" => "");
		
		$error = array("area"=>"","city"=>"","topic"=>"","address"=>"","date"=>"","level"=>"","time"=>"","phone"=>"","error"=>false);
		//
		if(isset($_GET["area"]) && empty($area)){
			$error["area"] ="Debes escoger un área";
			$error["error"]=true;
		}
		if(isset($_GET["city"]) && empty($city)){
			$error["city"] ="Debes escoger una ciudad";
			$error["error"]=true;
		}
		if(isset($_GET["level"]) && empty($level)){
			$error["level"] ="Debes escoger un nivel para la clase";
			$error["error"]=true;
		}
		if(isset($_GET["topic"]) && empty($topic)){
			$error["topic"] ="Debes escribir un tema";
			$error["error"]=true;
		}
		if(isset($_GET["address"]) && empty($address)){
			$error["address"] ="Debes escribir tu dirección";
			$error["error"]=true;
		}
		if(isset($_GET["date"]) && empty($date)){
			$error["date"] ="Debes escoger una fecha para tu clase";
			$error["error"]=true;
		}
		if(isset($_GET["time"]) && empty($time)){
			$error["time"] ="Debes escoger una hora para tu clase";
			$error["error"]=true;
		}
		if(isset($_GET["phone"]) && empty($phone)){
			$error["phone"] ="Debes escribir tu teléfono";
			$error["error"]=true;
		}
		$datos["errors"] = $error;
		if(!empty($area) && $error["error"] == false){
			$results = $this->model_superprofe->getMatches($area,$topic,$level,$city,$address,$date,$time);
			$request = array(
				"id_area" => $area,
				"topic"=>$topic,
				"id_level"=>$level,
				"city"=>$city,
				"address"=>$address,
				"start"=>date('Y-m-d', strtotime($date))." ".$time.":00:00",
				"phone"=>$phone,
				"status"=>1,
				"results"=>1
			);
			if($this->session->userdata("sIdUser")){
				$request["id_student"] = $this->session->userdata("sIdUser");
			}
			if(count($results)==0){
				$auto = "true";
				$results = $this->model_superprofe->getMatches($area,$topic,$level,$city,$address,$date,NULL);
				if(count($results)==0){
					$results = $this->model_superprofe->getMatches($area,$topic,$level,$city,$address,date('m/d/Y', strtotime($date. ' + 1 days')),NULL);
					if(count($results)==0){
						$results = $this->model_superprofe->getMatches($area,$topic,$level,$city,$address,date('m/d/Y', strtotime($date. ' + 2 days')),NULL);
						if(count($results)==0){
							$request["results"]=3;
							$request["status"]=2;
							$req_id = $this->session->userdata("req_id");
							if(empty($req_id)){
								$req_id = $this->model_superprofe->createRequest($request);
								$this->session->set_userdata("req_id",$req_id);
							}else{
								$this->model_superprofe->updateRequest($req_id,$request);
							}
							redirect(base_url("clase/solicitar/".$req_id));
						}else{
							$request["results"]=2;
							$request["start"] = date('Y-m-d', strtotime($date. ' + 2 days'));
							$datos["message"] = "Revisa los siguientes perfiles, tienen disponibilidad con horario cercano al que necesitas para que programes tu clase";
						}
					}else{
						$request["results"]=2;
						$request["start"] = date('Y-m-d', strtotime($date. ' + 1 days'));
						$datos["message"] = "Revisa los siguientes perfiles, tienen disponibilidad con horario cercano al que necesitas para que programes tu clase";
					}
				}else{
					$request["results"]=2;
					$datos["message"] = "Revisa los siguientes perfiles, tienen disponibilidad con horario cercano al que necesitas para que programes tu clase";
				}
			}else{
				$auto = "false";
				$datos["message"] = "Selecciona el Profesor con el Perfil que Mejor se Acomode a tus Necesidades";
			}
			$datos["req_id"] = $this->session->userdata("req_id");
			if(empty($datos["req_id"])){
				$datos["req_id"] = $this->model_superprofe->createRequest($request);
				$this->session->set_userdata("req_id",$datos["req_id"]);
			}else{
				$this->model_superprofe->updateRequest($datos["req_id"],$request);
			}
			//Peticion de la Url a aulas amigas para iniciar session con Google
			$this->sUrlGoogle = $this->aulasamigas->urlGoogle(
				base_url('login/login_google/'), FALSE, $this->input->ip_address(), FALSE
			);
			///Peticion de la url para uniciar con facebook
			$datos['sLoginFacebook'] = $this->login_fb();
			$datos['sLoginGoogle'] = json_decode($this->sUrlGoogle);
			$datos["auto"] = $auto;
			$datos["results"] = $results;
		}
		
		$this->load->view('header');
		$this->load->view('busqueda/view_buscar_profe', $datos);
		if(!empty($area) && $error["error"]==false){
			$datos["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
			$datos["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$this->load->view('busqueda/view_results', $datos);
		}
		$this->load->view('footer');
	}
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
				$this->validate_view();
			}
			
        }else{
	        return ($data_fb['login_url']);
        }
    }
	public function guardar(){
		$result = false;
		$reqid = $this->input->post("id");
		$data["start"] = $this->input->post("start");
		$data["end"] = $this->input->post("end");
		$data["id_professor"] = $this->input->post("id_professor");
		if($data["id_professor"]!="-1"){
			$datetime1 = new DateTime($data["start"]);
			$datetime2 = new DateTime($data["end"]);
			$interval = $datetime1->diff($datetime2);
			$hours = $interval->format("%h");
		
			$data["price_public"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"public")*$hours;
			$data["price_sp"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"sp")*$hours;
			$data["status"] = 2;
		}else{
			$data["status"] = 3;
		}
		if($this->session->userdata("sIdUser")){
			$data["id_student"] = $this->session->userdata("sIdUser");
			$result = true;
		}else{
			$this->session->set_userdata("redirect_on_login",true);
		}
		$this->model_superprofe->updateRequest($reqid,$data);
		echo json_encode($result);
	}
}
/* Location: ./application/controllers/busqueda.php */