<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
function reqStatusSort(&$a, &$b) {
	if ($a["status"] == $b["status"]) {
		return 0;
	}
	return ($a["status"] < $b["status"]) ? -1 : 1;
}
class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('aulasamigas');
		$this->load->model('model_superprofe');
	}
	public function index(){
		
		$userprofile = $this->uri->segment(1);

        if (empty($userprofile)) {
            $this->displayPageNotFound();
        }
		else {
			
			$data = $this->model_superprofe->loadUserbyUserProfile($userprofile);
			
			//$test = $this->model_superprofe->getValidationByUser(12,4,2);
			
			//echo json_encode($test);
			//return;
			
			
			
			if(count($data) > 0)
			{
				$data["levels"] = $this->model_superprofe->getLevels();
				$data["cities"] = $this->aulasamigas->getCitiesByCountry('COL');
				$this->load->view("header");
				
				//Peticion de la Url a aulas amigas para iniciar session con Google
				$this->sUrlGoogle = $this->aulasamigas->urlGoogle(
					base_url('login/login_google/'), FALSE, $this->input->ip_address(), FALSE
				);
				///Peticion de la url para uniciar con facebook
				$data['sLoginFacebook'] = $this->login_fb();
				$data['sLoginGoogle'] = json_decode($this->sUrlGoogle);
				
				if($data["isTeacher"]==1){
					$data["videos"] = $this->model_superprofe->getVideosByUser($data["IdUser"]);
					$datos["levels"][] = array("id"=>"-1","name"=>"Todos (Primaria,Bachillerato,Universidad,Otros)");
					$data["unique"]="";
					$data["comments"] = $this->model_superprofe->getCommentsByTeacher($data["id"]);
					
					$this->load->view("perfiles/profile_professor_public",$data);
				}else{
					 $this->displayPageNotFound();
				}
				$this->load->view("footer");
			}
			else
			{
				 $this->displayPageNotFound();
			}		
		}
	}
	
	public function checkUserLogged(){
		if($this->session->userdata("sIdUser")){
			$result = true;
		}else{
			$result = false;
		}
		
		echo $result;
	}
	
	public function addValidation(){
		
		$id_professor = $this->input->get("id_professor");
		$id_area = $this->input->get("id_area");
		$id_level = $this->input->get("id_level");
		
		$data = $this->model_superprofe->setValidation($id_professor, $id_area, $id_level);
		echo json_encode($data);
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
	
	
	protected function displayPageNotFound() {
        $this->output->set_status_header('404');
        $this->load->view('page_not_found');
    }
	
}