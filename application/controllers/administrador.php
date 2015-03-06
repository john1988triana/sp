<?php
/* title: administrador
 * Clase administrador .
 *
 * Author: Juan Camilo.
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
// Función de comparación
function profccSort(&$a, &$b) {
	if ($a["doc_number"] == $b["doc_number"]) {
		return 0;
	}
	return ($a["doc_number"] < $b["doc_number"]) ? -1 : 1;
}
function profactiveSort(&$a,&$b){
	if ($a["active"] == $b["active"]) {
		return 0;
	}
	return ($a["active"] < $b["active"]) ? -1 : 1;
}
function classProffSort(&$a,&$b){
	if ($a["pFName"] == $b["pFName"]) {
		return 0;
	}
	return ($a["pFName"] < $b["pFName"]) ? -1 : 1;
}
class Administrador extends CI_Controller {
	/* function: __construct
     * Constructor del control login carga el modelo login_model desde el principio para realizar validaciones correspondientes. */
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
           	
           	if($_SERVER['HTTP_HOST']=='superprofe.co')         
                    $config['upload_path'] = '/home/buscop/public_html/sp/assets/img/uploads/';
            else if($_SERVER['HTTP_HOST']=='amigaslive.net')
            		$config['upload_path'] = '/home/amigas/public_html/superprofe/application/uploads/';

            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '20000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            
            $this->load->library('upload', $config);
		}
	}
	public function index($id = null){$this->checkPermission();redirect(base_url("administrador/clases/nueva"));}
	public function checkPermission($area = ""){
		if($this->session->userdata("sIdUser")){
			$role = $this->model_superprofe->adminRole($this->session->userdata("sIdUser"));
			if($role!= 1){
				redirect(base_url(""));
			}else{
				
			}
		}else{
			redirect(base_url("administrador/ingreso"));
		}
	}
	
	public function test(){
		$email = "diego.castellanos@jci.com";
		$data = json_decode($this->aulasamigas->getUserByEmail($email));
		echo json_encode($data);
	}
	
	public function clases($subsection = "nueva",$params=""){
		$this->checkPermission();
		switch($subsection){
			case "nueva":
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/new_class_admin");
				
				$email = $this->input->get("email");
				if(!empty($email)){
					$data = json_decode($this->aulasamigas->getUserByEmail($email));
					if(empty($data)){
						$data = new StdClass;
						$this->load->view("panel_administrativo/students_create");
						
					}else{
						//echo "amigas: ". json_encode($data);
						$data = $this->model_superprofe->loadUser($data[0]->IdUser);
						//echo json_encode($data);
						if($data["isTeacher"]){
							echo "es profe";
						
						}else{
							$data["areas"] = $this->aulasamigas->getAreasByContent('768');
							$data["cities"] = $this->aulasamigas->getCitiesByCountry('COL');
							$data['countries'] = $this->aulasamigas->getCountriesInfo();
							$data["levels"] = $this->model_superprofe->getLevels();
							$data['document_type'] = json_decode($this->aulasamigas->getDocumentTypes(), true);
							$data["errors"] = array("area"=>"","city"=>"","topic"=>"","address"=>"","date"=>"","level"=>"","time"=>"","phone"=>"","error"=>false);
							//echo json_encode($data);
							$this->load->view("panel_administrativo/new_class_results",$data);
						}
					}					
				}
			break;
			case "detalles":
				$class=$this->model_superprofe->getRequest($params);
				$class["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$class["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$class["levels"] = $this->model_superprofe->getLevels();
				$class["editable"] = true;
				$data["editable_status"] = true;
				$class["states"] = array(
					array("id"=>"1","name"=>"En proceso de solicitud"),
					array("id"=>"2","name"=>"Solicitada sin profe"),
					array("id"=>"3","name"=>"Solicitada"),
					array("id"=>"4","name"=>"Programada"),
					array("id"=>"5","name"=>"Cancelada"));
					
				$class["teachers"] = $this->model_superprofe->getMatches($class["id_area"],$class["topic"],$class["id_level"],
																		$class["city"],$class["address"],$class["start"],NULL);
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/class_detail",$class);
			break;
			case "solicitadas":
				$data["title"] = "Clases Solicitadas";
				$data["editable"] = true;
				$data["editable_status"] = true;
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["class"]=$this->model_superprofe->getClassByStatus(array(1,2,3));
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$data["states"] = array(
					array("id"=>"1","name"=>"En proceso de solicitud"),
					array("id"=>"2","name"=>"Solicitada sin profe"),
					array("id"=>"3","name"=>"Solicitada"),
					array("id"=>"4","name"=>"Programada"),
					array("id"=>"5","name"=>"Cancelada")
				);//$this->model_superprofe->getStatus();
				
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
			case "programadas":
				$data["title"] = "Clases Programadas";
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["editable"] = true;
				$data["editable_status"] = true;
				$data["states"] = array(
					array("id"=>"1","name"=>"En proceso de solicitud"),
					array("id"=>"2","name"=>"Solicitada sin profe"),
					array("id"=>"3","name"=>"Solicitada"),
					array("id"=>"4","name"=>"Programada"),
					array("id"=>"5","name"=>"Cancelada")
				);
				$data["class"]=$this->model_superprofe->getClassByStatus(array(4));
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
			case "finalizadas":
				$data["title"] = "Clases Finalizadas";
				$data["editable"] = false;
				$data["editable_status"] = true;
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["states"] = array(
					array("id"=>"6","name"=>"Finalizada"),
					array("id"=>"7","name"=>"Pagada")
				);//$data["states"] = $this->model_superprofe->getStatus();
				$data["class"]=$this->model_superprofe->getClassByStatus(array(6));
				$params ="profesor";
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
			case "pagadas":
				$data["title"] = "Clases Finalizadas";
				$data["editable"] = false;
				$data["editable_status"] = true;
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["states"] = $this->model_superprofe->getStatus();
				$data["class"]=$this->model_superprofe->getClassByStatus(array(7));
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
			case "seguimiento":
				$data["title"] = "Seguimiento";
				$data["editable"] = false;
				$data["editable_status"] = true;
				$data["rateable"] = true;
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["states"] = $this->model_superprofe->getStatus();
				$data["class"]=$this->model_superprofe->getClassByStatus(array(6,7,8));
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
			case "canceladas":
				$data["title"] = "Clases Canceladas";
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["editable"] = true;
				$data["editable_status"] = true;
				$data["states"] = array(
					array("id"=>"1","name"=>"En proceso de solicitud"),
					array("id"=>"2","name"=>"Solicitada sin profe"),
					array("id"=>"3","name"=>"Solicitada"),
					array("id"=>"4","name"=>"Programada"),
					array("id"=>"5","name"=>"Cancelada")
				);
				$data["class"]=$this->model_superprofe->getClassByStatus(array(5));
				if(!empty($params)){
					if($params == "profesor"){
						uasort($data["class"],'classProffSort');
					}
				}
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/requested_class",$data);
			break;
		}
	}
	public function profesores($subsection ="proceso",$sort="id"){
		$this->checkPermission();
		switch($subsection){
			case "proceso":
				$data["title"] = "Profesores en Proceso";
				$data["editable"] = true;
				$professors=$this->model_superprofe->getPendingProfessors();
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/professors_in_process",$data);
			break;
			case "agendados":
				$data["title"] = "Profesores Agendados";
				$data["editable"] = false;
				$professors=$this->model_superprofe->getActualClassesProfessors();
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/professors_profile",$data);
			break;
			case "perfiles":
				$data["title"] = "Profesores Perfiles";
				$data["editable"] = true;
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$professors=$this->model_superprofe->getFullProfessorList();
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/professors_profile",$data);
			break;
			case "seguimiento":
				$data["title"] = "Profesores Seguimiento";
				$data["editable"] = false;
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$professors=$this->model_superprofe->getFullProfessorList();
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/professors_follow",$data);
			break;
			case "detalles":
			//$id = $this->input->get("id");
			$data = $this->model_superprofe->loadUser($sort);
			$data["levels"] = $this->model_superprofe->getLevels();
			$this->load->view("header");
			$data["unique"]="";
			if($data["isTeacher"]==1){
				$datos["levels"][] = array("id"=>"-1","name"=>"Todos (Primaria,Bachillerato,Universidad,Otros)");
				$this->load->view("perfiles/profile_professor",$data);
			}else{
				$this->load->view("perfiles/profile_student",$data);
			}
			$this->load->view("footer");
			break;
		}
	}
	public function estudiantes($subsection ="perfiles",$sort="id"){
		$this->checkPermission();
		switch($subsection){
			case "perfiles":
				$data["title"] = "Estudiantes";
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$professors=$this->model_superprofe->getFullStudentList();
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/students_profile",$data);
			break;
			case "existe":
				echo $this->aulasamigas->getUserByEmail($this->input->get("email"));
			break;
			case "crear":
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
				$pass =  substr(str_shuffle($chars),0,10);
				$result = json_decode($this->aulasamigas->addUser(
					$this->input->post('name'), $this->input->post('fname'), $this->input->post('email'), 
					$_SERVER['REMOTE_ADDR'], $pass, 'h', 0, 0, '768')
				);
				$this->load->model('model_superprofe');
				if($result->mySQL == 1){
					$aInfoUser = $this->aulasamigas->whoAmI($result->id_user);
					$user = $this->model_superprofe->checkUser($this->input->post('name'),
													$this->input->post('fname'),
													$result->id_user,$aInfoUser[0]["isTeacher"]);
					$template = file_get_contents(base_url("application/views/mail/new_account.html"));
					$template = str_replace("{{HOST}}",base_url(),$template);
					$template = str_replace("{{STUDENT NAME}}",$this->input->post('name')." ".$this->input->post('fname'),$template);
					$template = str_replace("{{EMAIL}}",$this->input->post("email"),$template);
					$template = str_replace("{{PASSWORD}}",$pass,$template);
					$config['mailtype'] = "html";
					$this->load->library('email');
					$this->email->initialize($config);
					
					
					$this->email->from('hola@superprofe.co', 'Superprofe');
					$this->email->to($this->input->post("email")); 
					$this->email->cc('hola@superprofe.co'); 
					$this->email->subject('Superprofe.co - Bienvenido a SuperProfe ');
					$this->email->message($template);  
					
					$this->email->send();
				}
			break;
		}
	}
	public function facturacion($subsection ="cobrar"){
		$this->checkPermission();
		switch($subsection){
			case "cobrar":
				$data["professors"] = $this->model_superprofe->getPayableProfessors(array(6));
				$data["title"] = "Cuentas por cobrar";
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/view_accounts_receivable",$data);
			break;
		}
	}
	public function estadisticas($subsection = ""){}
	public function csv($section){
		$this->checkPermission();
		if($section == "estudiantes"){
			$cities = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$professors=$this->model_superprofe->getFullStudentList();
			
			$headers =  array_keys($professors[0]);
			$headers[] = "city";
			$headers[] = "area";
			$fp = fopen('php://output', 'w');
			if ($fp) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="estudiantes.csv"');
				header('Pragma: no-cache');
				header('Expires: 0');
				fputcsv($fp, $headers);
				foreach($professors as &$p){
					foreach($cities as $city){if($city->ID == $p["id_city"])$p["city"]=$city->Name;break;}
					fputcsv($fp, array_values($p));
				}
				die;
			}
		}
		if($section == "profesores"){
			$cities = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
			$professors=$this->model_superprofe->getFullProfessorList(false);
			
			$headers =  array_keys($professors[0]);
			$headers[] = "city";
			$headers[] = "area";
			$fp = fopen('php://output', 'w');
			if ($fp) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="profesores.csv"');
				header('Pragma: no-cache');
				header('Expires: 0');
				fputcsv($fp, $headers);
				foreach($professors as &$p){
					foreach($cities as $city){if($city->ID == $p["id_city"])$p["city"]=$city->Name;break;}
					$p["area"]="";
					$as = explode(",",$p["areas"]);
					foreach($areas as $area){foreach($as as $a){if($a == $area->IdArea){
									$p["area"].=$area->Name.",";break;}}}
					fputcsv($fp, array_values($p));
				}
				die;
			}
		}
		if($section == "clases"){
			$classes=$this->model_superprofe->getClassByStatus(array(1,2,3,4,5,6,7,8,9));
			$states = $this->model_superprofe->getStatus();
			$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
			$headers =  array_keys($classes[0]);
			$headers[] = "area";
			$fp = fopen('php://output', 'w');
			if ($fp) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="clases.csv"');
				header('Pragma: no-cache');
				header('Expires: 0');
				fputcsv($fp, $headers);
				foreach($classes as &$p){
					foreach($areas as $area){
							if($p["id_area"] == $area->IdArea){
									$p["area"]=$area->Name;break;}}
					foreach($states as $state){
							if($p["status"] == $state["name"]){
									$p["status"]=$state["name"];break;}}
					fputcsv($fp, array_values($p));
				}
				die;
			}
		}
	}
	
	public function promociones($subsection = "nueva",$params=""){
		$this->checkPermission();
		switch($subsection){
			case "nueva":	$this->load->view("panel_administrativo/header");
							$this->load->view("panel_administrativo/promotional_code_new");
							break;
			case "lista":	$query = $this->model_superprofe->getAllPromoCodes();
							$data["promo_list"] = $query;
							
							$this->load->view("panel_administrativo/header");
							$this->load->view("panel_administrativo/promotional_code_list", $data);
							break;
		}
	}
	
	public function eliminarPromoPorId($id){
		$this->checkPermission();
		if($id) {
			
		}
	}
	
	
	public function actualizar($subsection){
		$this->checkPermission();
		switch($subsection){
			case "clase":
				$class = $this->input->post("cls");
				$this->model_superprofe->updateRequest($class["hash"],$class);
				echo json_encode(true);
			break;
			case "professor":
				$this->model_superprofe->updateProfessor($this->input->post("pfs"));
				echo json_encode(true);
			break;
			case "estudiante":
				$this->model_superprofe->updateOrCreateStudent($this->input->post("std"));
				echo json_encode(true);
			break;
		}
	}
	public function agendar(){
		$this->checkPermission();
		$result = false;
		$email = $this->input->post("student_email");
		$user = json_decode($this->aulasamigas->getUserByEmail($email));
		$user = $user[0];
		$data["id_student"] = $user->IdUser;
		$data["phone"] = $this->input->post("phone");
		$data["address"] = $this->input->post("address");
		$data["topic"] = $this->input->post("topic");
		$data["city"] = $this->input->post("city");
		$data["id_level"] = $this->input->post("level");
		$data["id_area"] = $this->input->post("id_area");
		$data["start"] = $this->input->post("start");
		$data["end"] = $this->input->post("end");
		$datetime1 = new DateTime($data["start"]);
		$datetime2 = new DateTime($data["end"]);
		$interval = $datetime1->diff($datetime2);
		$hours = $interval->format("%h");
		$data["price_public"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"public")*$hours;
		$data["price_sp"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"sp")*$hours;
		$data["id_professor"] = $this->input->post("id_professor");
		$data["status"] = 4;
		
		$this->model_superprofe->createRequest($data);
		
		$teacher = json_decode($this->aulasamigas->getUsersInfo(array($data["id_professor"])));
		$teacher = $teacher[0];
		
		/** notify teacher, and student
		*/
		$template = file_get_contents(base_url("application/views/mail/confirmation.html"));
		$template = str_replace("{{HOST}}",base_url(),$template);
		$template = str_replace("{{AREA}}",$data["area"],$template);
		$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
		$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
		$template = str_replace("{{ADDRESS}}",$data["address"],$template);
		$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
		$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
		$template = str_replace("{{TEACHER EMAIL}}",$teacher->Email,$template);
		$template = str_replace("{{TEACHER PHONE}}",$teacher->Phone,$template);
		$template = str_replace("{{PRICE}}",($data["price_public"]+$data["price_sp"]),$template);
		
		$config['mailtype'] = "html";
		$this->load->library('email');
		$this->email->initialize($config);
		
		
		$this->email->from('hola@superprofe.co', 'Superprofe');
		$this->email->to($user->Email.", ".$teacher->Email); 
		$this->email->cc('hola@superprofe.co'); 
		$this->email->subject('Superprofe.co - Confirmacion de clase.');
		$this->email->message($template);  
		
		$this->email->send();
		echo json_encode(true);
	}
	public function buscar(){
		$this->checkPermission();
		$area = $this->input->post("area");
		$topic =  $this->input->post("topic");
		$level =  $this->input->post("level");
		$city = $this->input->post("city");
		$address = $this->input->post("address");
		$date = $this->input->post("date");
		$time = $this->input->post("time");
		$phone = $this->input->post("phone");
		
		$results = $this->model_superprofe->getMatches($area,$topic,$level,$city,$address,$date,$time);
		echo json_encode($results);
	}
	public function ingreso(){
		$datos = array("message" => "");
		$this->form_validation->set_rules('txtEmail', $this->lang->line('Email'), 'trim|required|max_length[45]|xss_clean');
		$this->form_validation->set_rules('txtPassword', $this->lang->line('Password'), 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
		}else{				
			$result = $this->aulasamigas->loginUser(
				$this->input->post('txtEmail'), $this->input->post('txtPassword')
			);
			if (!empty($result)) {					
				$aRespuesta = json_decode($result);
				if($aRespuesta->mySQL==1){
					//INICIO DE SESSION DEL USUARIO
					$aSessionUser = array('bLoginIn' => TRUE,'sIdUser' => $aRespuesta->id_user,'id_content' => '768');
					$this->session->set_userdata($aSessionUser);
					$datos["message"]="<div class=\"msj2 alert alert-warning alert-danger\" role=\"alert\" id=\"alert\"><strong>Hola administrador. Bienvendio</strong></div>";
					redirect(base_url("administrador/clases/nueva"));
				}else{
					$datos["message"]="<div class=\"msj2 alert alert-warning alert-danger\" role=\"alert\" id=\"alert\"><strong>Usuario o clave incorrectos</strong></div>";
				}
				
			}
		}
		if(!$this->input->post('txtEmail') && !$this->input->post('txtPassword'))
			$this->load->view("panel_administrativo/admin_login_view",$datos);
	}
}