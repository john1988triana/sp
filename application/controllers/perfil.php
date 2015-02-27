<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
function reqStatusSort(&$a, &$b) {
	if ($a["status"] == $b["status"]) {
		return 0;
	}
	return ($a["status"] < $b["status"]) ? -1 : 1;
}
class Perfil extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('aulasamigas');
		$this->load->model('model_superprofe');
	}
	public function index(){
		$data = $this->model_superprofe->loadUser($this->session->userdata('sIdUser'));
		$data["levels"] = $this->model_superprofe->getLevels();
		$this->load->view("header");
		if($data["isTeacher"]==1){
			$data["videos"] = $this->model_superprofe->getVideosByUser($this->session->userdata('sIdUser'));
			$datos["levels"][] = array("id"=>"-1","name"=>"Todos (Primaria,Bachillerato,Universidad,Otros)");
			$data["unique"]="";
			$this->load->view("perfiles/profile_professor",$data);
		}else{
			$this->load->view("perfiles/profile_student",$data);
		}
		$this->load->view("footer");
	}
	public function agenda(){
		$data = $this->model_superprofe->loadUser($this->session->userdata('sIdUser'));
		$this->load->view("header");
		$this->load->view("perfiles/calendar",$data);
		$this->load->view("footer");
	}
	public function clases(){
		$data["classes"] = $this->model_superprofe->getRangeClasses($this->session->userdata('sIdUser'),"1970-01-01 00:00:00","3000-01-01 23:59:59",$this->session->userdata('isTeacher'),array(3,4,6,7));
		$data["states"] = $this->model_superprofe->getStatus();
		uasort($data["classes"],'reqStatusSort');
		$this->load->view("header");
		$this->load->view("perfiles/clases",$data);
		$this->load->view("footer");
	}
	public function facturacion(){
		$id = $this->session->userdata('sIdUser');
		$data["title"] = "Clases Finalizadas";
		$data["editable"] = false;
		$data["editable_status"] = false;
		$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
		$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
		$data["levels"] = $this->model_superprofe->getLevels();
		$data["states"] = array(
			array("id"=>"6","name"=>"Finalizada"),
			array("id"=>"7","name"=>"Pagada")
		);//$data["states"] = $this->model_superprofe->getStatus();
		if($this->session->userdata('isTeacher')== 0){
			$data["states"][1] = array("id"=>"7","name"=>"Finalizada");
		}
		$data["class"] = $this->model_superprofe->getRangeClasses($this->session->userdata('sIdUser'),"1970-01-01 00:00:00","3000-01-01 23:59:59",$this->session->userdata('isTeacher'),array(6,7));
		$this->load->view("header");
		$this->load->view("perfiles/profile_payable",$data);
		$this->load->view("footer");
	}
	public function ajaxClases($id,$date,$range="week",$type=1){
		if($range == "week"){
			$start = date("w",$date) != 1 ? date('Y-m-d', strtotime('last monday',$date))." 00:00:00":date("Y-m-d",$date)." 00:00:00";
			$end = date("w",$date) != 0 ? date('Y-m-d', strtotime('next sunday',$date))." 23:59:59":date("Y-m-d",$date)." 23:59:59";
			echo json_encode($this->model_superprofe->getRangeClasses($id,$start,$end,$type)); //id amigas
		}
		else if($range == "month"){
			$start = date('Y-m-d', strtotime('first day of this month',$date))." 00:00:00";
			$end = date('Y-m-d', strtotime('last day of this month',$date))." 23:59:59";			
			echo json_encode($this->model_superprofe->getRangeClasses($id,$start,$end,$type)); //id amigas
		}
		else if($range == "year"){
			$start = date('Y-m-d', strtotime('first day of this year',$date))." 00:00:00";
			$end = date('Y-m-d', strtotime('last day of this year',$date))." 23:59:59";			
			echo json_encode($this->model_superprofe->getRangeClasses($id,$start,$end,$type)); //id amigas
		}
	}
	
	public function disponibilidad($id=NULL){
		$user = $this->session->userdata('sIdUser');
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'POST'){
			if($id!=NULL){
				if($id != $user){
					$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
					if($role!=1){
						echo "FORBIDEN";
					}else{
						$this->model_superprofe->updateAvailable($id,$_POST["events"]);
					}
				}else{
					$this->model_superprofe->updateAvailable($user,$_POST["events"]);
				}
			}else{
				$this->model_superprofe->updateAvailable($user,$_POST["events"]);
			}
		}else if($method == 'GET'){
			if($id != NULL){
			echo $this->model_superprofe->getAvailable($id); //id superprofe database
			}else{
			echo $this->model_superprofe->getAvailable($user); // id amigas
			}
		}
	}
	
	public function insertarVideo($id=NULL) {
		$user = $this->session->userdata('sIdUser');
		echo $this->model_superprofe->insertvideo($id,$_POST);
	}
	
	public function obtenerVideosPorId($id=NULL) {
		echo $this->model_superprofe->getVideosByUser($id); //id superprofe database
	}
	
	//public function actualizar($id){
	public function actualizar($id = null){
		$user = $this->session->userdata('sIdUser');
		$amigas = array();
		if(isset($_POST["dayBorn"])){
			$amigas['DayBorn'] = $this->input->post("dayBorn");
			unset($_POST["dayBorn"]);
		}
		if(isset($_POST["monthBorn"])){
			$amigas['MonthBorn'] = $this->input->post("monthBorn");
			unset($_POST["monthBorn"]);
		}
		if(isset($_POST["yearBorn"])){
			$amigas['YearBorn'] = $this->input->post("yearBorn");
			unset($_POST["yearBorn"]);
		}
		if(isset($_POST["phone"])){
			$amigas['Phone'] = $this->input->post("phone");
			unset($_POST["phone"]);
		}
		if(isset($_POST["address"])){
			$amigas['Address'] = $this->input->post("address");
			unset($_POST["address"]);
		}
		if(count($amigas)){
			$amigas["Email"] = $this->session->userdata('sEmail');
			$this->aulasamigas->updateContactUserInfo($amigas);
		}
		
		echo json_encode($this->input->post("dayBorn"));
		
		if(count($_POST)){
			
			
			
			if($id!=NULL){
				
				
				
				if($id != $user){
					$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
					if($role!=1){
						echo "FORBIDEN";
						return;
					}else{						
						$user = $id;
					}
				}
			}
			$amigas = json_decode($this->aulasamigas->getUsersInfo(array($id)), true);
			$amigas = $amigas[0];
			$this->model_superprofe->update($user,$_POST,$amigas["isTeacher"]);
		}
		return true;
	}
	public function referencia($id,$id_ref = NULL){
		$user = $this->session->userdata('sIdUser');
		if($id!=NULL){
			if($id != $user){
				$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
				if($role!=1){
					echo "FORBIDEN";
					return;
				}else{
					$user = $id;
				}
			}
		}
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'POST'){
			echo $this->model_superprofe->addReference($user,$_POST);
			return;
		}else if($method == 'DELETE'){
			$this->model_superprofe->removeReference($user,$id_ref);
		}else if($method == 'GET'){
			echo $this->model_superprofe->getReference($id_ref);
			return;
		}
		echo true;
	}
	public function estudios($id_st = NULL){
		$id = $id_st;
		$user = $this->session->userdata('sIdUser');
		if($id!=NULL){
			if($id != $user){
				$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
				if($role!=1){
					echo "FORBIDEN";
					return;
				}else{
					$user = $id;
				}
			}
		}
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'POST'){
			echo $this->model_superprofe->addStudies($user,$_POST);
			return;
		}else if($method == 'DELETE'){
			//echo $user . ", post: " . json_encode($_GET);
			$this->model_superprofe->removeStudies($_GET["id_user"],$_GET["exp_id"]);
		}else if($method == 'GET'){
			echo $this->model_superprofe->getStudies($id_st);
			return;
		}
		echo true;
	}
	public function experiencia($id,$id_exp = NULL){
		$user = $this->session->userdata('sIdUser');
		
			if($id != $user){
				$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
				if($role!=1){
					echo "FORBIDEN";
					return;
				}else{
					$user = $id;
				}
			}
		
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'POST'){
			echo $this->model_superprofe->addExperience($user,$_POST);
			return;
		}else if($method == 'DELETE'){
			$this->model_superprofe->removeExperience($user,$id_exp);
		}else if($method == 'GET'){
			echo $this->model_superprofe->getExperience($user);
			return;
		}
		echo true;
	}
	public function info($id){
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'GET'){
			echo $this->model_superprofe->getProfile($id);
			return;
		}
	}
	public function savePicture($id = NULL){
		if($_SERVER['HTTP_HOST'] == 'superprofe.co' || $_SERVER['HTTP_HOST'] == 'www.superprofe.co')        
			$config['upload_path'] = '/home/buscop/public_html/sp/application/uploads/';
		else if($_SERVER['HTTP_HOST']=='amigaslive.net')
			$config['upload_path'] = '/home/amigas/public_html/superprofe/application/uploads/';
		else
			$config['upload_path'] = "application/uploads/";

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '20000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		//echo $this->upload->do_upload();
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
			return;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$user["picture"] = "application/uploads/".$data["upload_data"]["file_name"];
			$d = $this->session->userdata('sIdUser');
			if($id!=NULL){
				if($id != $d){
					$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
					if($role!=1){
						echo "FORBIDEN";
						return;
					}else{
						$d = $id;
					}
				}else{
					$this->session->set_userdata('sImageUrl', $user["picture"]);
				}
			}
			else
			{
				$id = $d;
			}
			$amigas = json_decode($this->aulasamigas->getUsersInfo(array($id)), true);
			$amigas = $amigas[0];
			$this->model_superprofe->update($d,$user,$amigas["isTeacher"]);
			echo '{"success": "' . base_url($user["picture"]) . '"}';
		}
		
	}
	public function competencia($id,$id_comp,$level = NULL){
		$user = $this->session->userdata('sIdUser');
		if($id!=NULL){
			if($id != $user){
				$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
				if($role!=1){
					echo "FORBIDEN";
					return;
				}else{
					$user = $id;
				}
			}
		}
		$method= $_SERVER['REQUEST_METHOD'];
		if($method == 'POST'){
			if($level == -1){
				$this->model_superprofe->addCompentence($user,$id_comp,2);
				$this->model_superprofe->addCompentence($user,$id_comp,3);
				$this->model_superprofe->addCompentence($user,$id_comp,4);
				$this->model_superprofe->addCompentence($user,$id_comp,5);
			}else{
				$this->model_superprofe->addCompentence($user,$id_comp,$level);
			}
		}else if($method == 'DELETE'){
			$this->model_superprofe->removeCompentence($user,$id_comp,$level);
		}
		echo true;
	}
}