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
			
			if(count($data) > 0)
			{
				$data["levels"] = $this->model_superprofe->getLevels();
				$this->load->view("header");
				if($data["isTeacher"]==1){
					$data["videos"] = $this->model_superprofe->getVideosByUser($this->session->userdata('sIdUser'));
					$datos["levels"][] = array("id"=>"-1","name"=>"Todos (Primaria,Bachillerato,Universidad,Otros)");
					$data["unique"]="";
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
	
	protected function displayPageNotFound() {
        $this->output->set_status_header('404');
        $this->load->view('page_not_found');
    }
	
}