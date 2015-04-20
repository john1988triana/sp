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
            	$config['upload_path'] = '/home/superprofecom/public_html/assets/img/uploads/';
            else if($_SERVER['HTTP_HOST']=='amigaslive.net')
            	$config['upload_path'] = '/home/amigas/public_html/superprofe/application/uploads/';
			else {
				$config['upload_path'] = "application/uploads/";
			}
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size']	= '20000';
            
            $this->load->library('upload', $config);
		}
		date_default_timezone_set("America/Bogota");
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
		//$email = "diego.castellanos@jci.com";
		//$data = json_decode($this->aulasamigas->getUserByEmail($email));
		//echo json_encode($data);
        $template = "Testing email system!!!";
        $config['mailtype'] = "html";
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('hola@superprofe.co', 'Superprofe');
        $this->email->to('edgar@toro-labs.com'); 
        $this->email->cc('estudiantesuperprofe@gmail.com'); 
        $this->email->subject('Superprofe.co - Bienvenido a SuperProfe ');
        $this->email->message($template);  

        $this->email->send();
        
        echo "testing email...";
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
							$data["areas"] = $this->aulasamigas->getAreasByContent('768');
							$data["cities"] = $this->aulasamigas->getCitiesByCountry('COL');
							$data['countries'] = $this->aulasamigas->getCountriesInfo();
							$data["levels"] = $this->model_superprofe->getLevels();
							$data['document_type'] = json_decode($this->aulasamigas->getDocumentTypes(), true);
							$data["errors"] = array("area"=>"","city"=>"","topic"=>"","address"=>"","date"=>"","level"=>"","time"=>"","phone"=>"","error"=>false);
							//echo json_encode($data);
							$this->load->view("panel_administrativo/new_class_results",$data);
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
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
				$data["levels"] = $this->model_superprofe->getLevels();
				$professors=$this->model_superprofe->getPendingProfessors();
				$professorsf=$this->model_superprofe;
				if($sort != "id"){
					if($sort == "cc"){
						uasort($professors,'profccSort');
					}
					if($sort == "active"){
						uasort($professors,'profactiveSort');
					}
				}
				$data["professors"] = $professors;
				$data["professorsf"] = $professorsf;
				$this->load->view("panel_administrativo/header",$data);
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
				$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
				$data["areas"] = json_decode($this->aulasamigas->getAreasByContent('768'));
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
			$data["cities"] = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$data['countries'] = $this->aulasamigas->getCountriesInfo();
			$this->load->view("header");
			$data["unique"]="";
			if($data["isTeacher"]==1){
				$data["videos"] = $this->model_superprofe->getVideosByUser($this->session->userdata('sIdUser'));
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
					$template = str_replace("{{STUDENT_NAME}}",$this->input->post('name')." ".$this->input->post('fname'),$template);
					$template = str_replace("{{EMAIL}}",$this->input->post("email"),$template);
					$template = str_replace("{{PASSWORD}}",$pass,$template);
					$config['mailtype'] = "html";
					$this->load->library('email');
					$this->email->initialize($config);
					
					
					$this->email->from('hola@superprofe.co', 'Superprofe');
					$this->email->to($this->input->post("email")); 
					$this->email->cc('estudiantesuperprofe@gmail.com'); 
					$this->email->subject('Superprofe.co - Bienvenido a SuperProfe ');
					$this->email->message($template);  
					
					$this->email->send();
				}
			break;
		}
	}
	public function facturacion($subsection ="cobrar", $error = NULL){
		$this->checkPermission();
		switch($subsection){
			case "cobrar":
				$data["professors"] = $this->model_superprofe->getPayableProfessors(array(6));
				$data["title"] = "Cuentas por cobrar";
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/view_accounts_receivable",$data);
			break;
			case "detalle":
				$data["details"] = $this->model_superprofe->getDetailsPayments($this->input->get("id"));
				$this->load->view("panel_administrativo/header");
				//echo json_encode($data["details"]);
				$this->load->view("panel_administrativo/view_accounts_detail",$data);
			break;
			case "savedetail":
				$data["state"] = $this->input->post("state");
				$this->model_superprofe->updatePayment($this->input->post("id"), $data);
				echo "true";
			break;
			case "pago_detalle":
				if($error != NULL) {
					$data["error"] = $error;
				}
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
				$data["class"] = $this->model_superprofe->getRangeClasses($this->input->get("id"),"1970-01-01 00:00:00","3000-01-01 23:59:59",1,array(6),1);
				//echo json_encode($data);
				//return;
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/view_profile_payable",$data);
			break;
		}
	}
	
	public function uploadClassPay($error = NULL) {
		if($_SERVER['HTTP_HOST'] == 'superprofe.co' || $_SERVER['HTTP_HOST'] == 'www.superprofe.co')  {
			$config['upload_path'] = '/home/buscop/public_html/application/uploads/';  
		}
		else if($_SERVER['HTTP_HOST']=='amigaslive.net'){
			$config['upload_path'] = '/home/amigas/public_html/superprofe/application/uploads/';
		}
		else {
			$config['upload_path'] = "application/uploads/";
		}

		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']	= '20000';
		
		$config['file_name'] = md5(time());
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		//echo $this->upload->do_upload();
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->facturacion("pago_detalle", $error);
			return;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$element["url"] = "application/uploads/".$data["upload_data"]["file_name"];
			$this->model_superprofe->doUploadPayment($this->input->post("form_value"), $element["url"], json_decode($this->input->post("form_array")), 1);
		}
		
		//$this->load->view("header");
		//$this->load->view("perfiles/upload_result");
		redirect(base_url('administrador/facturacion/cobrar'));
	}
	
	public function estadisticas($subsection = ""){
		$this->checkPermission();
		switch ($subsection){
			case 'clases':
				$data["Todos"] = $this->model_superprofe->getclassprogram(4);
				$this->load->view("panel_administrativo/header");
				$this->load->view("panel_administrativo/statistics_class",$data);
						
			break;
			
			default:
				
			break;
		}
	}
	public function statisticClass(){
			$start = date('Y-m-d', strtotime('first day of this year',$date))." 00:00:00";
			$end = date('Y-m-d', strtotime('last day of this year',$date))." 23:59:59";			
			echo json_encode($this->model_superprofe->getclassprogram(1)); //id amigas
	}

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
			case "nueva":	if($this->input->post("create_action")){
								$checking = $this->model_superprofe->checkCode($this->input->post("code"));
								if($checking == "0"){
									$data["vig_from"] = date("Y-m-d" , strtotime($this->input->post("from")));
									$data["vig_to"] = date("Y-m-d" , strtotime($this->input->post("to")));
									$data["value"] = $this->input->post("valor");
									$data["value"] = str_replace("$ ","", $data["value"]);
									$data["value"] = str_replace(".", "", $data["value"]);
									$data["max_uses"] = $this->input->post("uses");
									$data["code_number"] = $this->input->post("code");
									$data["uses"] = 0;
									
									$this->model_superprofe->createCode($data);
									
									$this->load->view("panel_administrativo/header");
									$this->load->view("panel_administrativo/promotional_code_result", $data);
								}
								else{
									$data["error"] = "El código ya existe. Verifica e intenta con otro";
									$data["type_code"] = $this->input->post("type_code");
									$data["from"] = $this->input->post("from");
									$data["to"] = $this->input->post("to");
									$data["valor"] = $this->input->post("valor");
									$data["uses"] = $this->input->post("uses");
									$data["code"] = $this->input->post("code");
									
									$this->load->view("panel_administrativo/header");
									$this->load->view("panel_administrativo/promotional_code_new", $data);
								}
							}
							else if($this->input->post("generate_action")) {
								
								$isOnly = false;
								$code = 0;
								while ($isOnly <= false) {
									$code = mt_rand(100000,9999999);
									$checking = $this->model_superprofe->checkCode($code);
									if($checking == "0"){
										$isOnly = true;
									}
									else {
										$isOnly = false;
									}
								}
								
								$data["vig_from"] = date("Y-m-d" , strtotime($this->input->post("from")));
								$data["vig_to"] = date("Y-m-d" , strtotime($this->input->post("to")));
								$data["value"] = $this->input->post("valor");
								$data["value"] = str_replace("$ ","", $data["value"]);
								$data["value"] = str_replace(".", "", $data["value"]);
								$data["max_uses"] = $this->input->post("uses");
								$data["code_number"] = $code;
								$data["uses"] = 0;
								
								$this->model_superprofe->createCode($data);
								
								$this->load->view("panel_administrativo/header");
								$this->load->view("panel_administrativo/promotional_code_result", $data);
								
							}
							else {
								$this->load->view("panel_administrativo/header");
								$this->load->view("panel_administrativo/promotional_code_new");
							}
			
			
							
							break;
			case "lista":	$query = $this->model_superprofe->getAllPromoCodes();
							$data["promo_list"] = $query;
							
							$this->load->view("panel_administrativo/header");
							$this->load->view("panel_administrativo/promotional_code_list", $data);
							break;
			case "bitacora":	$data["list"] = $this->model_superprofe->getBitacoraList($params);
							$this->load->view("panel_administrativo/header");
							$this->load->view("panel_administrativo/bitacora", $data);
							break;
							
		}
	}
	
	public function editPromoById(){
		
		$id = $this->input->get("id");
		$data["vig_from"] = $this->input->get("vig_from");
		$data["vig_to"] = $this->input->get("vig_to");
		$data["value"] = $this->input->get("value");
		$data["max_uses"] = $this->input->get("max_uses");
		
		$this->model_superprofe->editPromoCodeById($id, $data);
		echo "true";
	}
	
	public function deletePromoById($id){
		$this->checkPermission();
		if($id) {
			$this->model_superprofe->deletePromoCodeById($id);
			echo "true";
		}
		else {
			echo "false";
		}
	}
	
	public function actualizar($subsection){
		$this->checkPermission();
		switch($subsection){
			case "clase":
				$class = $this->input->post("cls");
				$this->model_superprofe->updateRequest($class["hash"],$class);
				if ($class["status"] == 5) {
					
					$data = $this->model_superprofe->getRequest($class["hash"]);
					
					if($data["id_professor"]) {
						$teacher = json_decode($this->aulasamigas->getUsersInfo(array($data["id_professor"])));
						$teacher = $teacher[0];
						
						$template = file_get_contents(base_url("application/views/mail/cancel_teacher.html"));
						$template = str_replace("{{HOST}}",base_url(),$template);
						$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
						$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
						$template = str_replace("{{ADDRESS}}",$data["address"],$template);
						$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
						$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
						$template = str_replace("{{TEACHER EMAIL}}",$teacher->Email,$template);
						$template = str_replace("{{TEACHER PHONE}}",$teacher->Phone,$template);
						$template = str_replace("{{PRICE}}",($data["price_public"]+$data["price_sp"]),$template);
						$template = str_replace("{{ID}}",$data["id"],$template);
						
						$config['mailtype'] = "html";
						$this->load->library('email');
						$this->email->initialize($config);
						
						$this->email->from('hola@superprofe.co', 'Superprofe');
						$this->email->to($teacher->Email); 
						$this->email->cc('estudiantesuperprofe@gmail.com'); 
						$this->email->subject('Superprofe.co - Cancelación de clase no. ' . $data["id"]);
						$this->email->message($template);  
						$this->email->send();
					}
					
					if($data["id_student"]){
						$student = json_decode($this->aulasamigas->getUsersInfo(array($data["id_student"])));
						$student = $student[0];
						
						/** notify teacher, and student
						*/
						$template = file_get_contents(base_url("application/views/mail/cancel_student.html"));
						$template = str_replace("{{HOST}}",base_url(),$template);
						$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
						$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
						$template = str_replace("{{ADDRESS}}",$data["address"],$template);
						$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
						$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
						$template = str_replace("{{TEACHER EMAIL}}",$teacher->Email,$template);
						$template = str_replace("{{TEACHER PHONE}}",$teacher->Phone,$template);
						$template = str_replace("{{PRICE}}",($data["price_public"]+$data["price_sp"]),$template);
						$template = str_replace("{{ID}}",$data["id"],$template);
						$config['mailtype'] = "html";
						$this->load->library('email');
						$this->email->initialize($config);
						
						$this->email->from('hola@superprofe.co', 'Superprofe');
						$this->email->to($student->Email); 
						$this->email->cc('estudiantesuperprofe@gmail.com'); 
						$this->email->subject('Superprofe.co - Cancelación de clase no. ' . $data["id"]);
						$this->email->message($template);  
						$this->email->send();
					}
					
				}
				
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
		$data["origin"] = $this->input->post("origin");
		$data["promo_code"] = $this->input->post("promo_code");
		
		$datetime1 = new DateTime($data["start"]);
		$datetime2 = new DateTime($data["end"]);
		$interval = $datetime1->diff($datetime2);
		$hours = $interval->format("%h");
		$data["price_public"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"public")*$hours;
		$data["price_sp"] = $this->model_superprofe->getPrice($this->input->post("id_professor"),"sp")*$hours;
		$data["id_professor"] = $this->input->post("id_professor");
		
		if($data["promo_code"] != "") {
				
			$code_count = $this->model_superprofe->checkValidCode($data["promo_code"]);
			if((int)$code_count > 0) {
				$value_code = $this->model_superprofe->getValueByCode($data["promo_code"]);
				$data["price_public"]  = $data["price_public"] - (float)$value_code;
			}
			else {
				$msg = array("Error", "El código promocional no es válido.");
				echo json_encode($msg);
				return;
			}
			
		}
		
		if($data["promo_code"] != "") {
			$resultCode = $this->model_superprofe->insertCodeUsed($data["id_student"], $data["promo_code"]);
		
			if($resultCode[0] == "Error") {
				echo json_encode( $resultCode );
				return;
			}	
		}
		
		$data["status"] = 4;
		
		$data["program_date"] = date("Y-m-d H:i:s");
		
		$reqid = $this->model_superprofe->createRequest($data);
		
		$data = $this->model_superprofe->getRequest($reqid);
		
		$teacher = json_decode($this->aulasamigas->getUsersInfo(array($data["id_professor"])));
		$teacher = $teacher[0];
		
		$user = json_decode($this->aulasamigas->getUsersInfo(array($user->IdUser)));
		$user = $user[0];
		
		$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
		foreach($areas as $area){
			if($area->IdArea == $data["id_area"]){
				$data["area"] = $area->Name;
				break;
			}
		}
		
		///////////////////////
		$this->load->library('iCalWriter');
		
		$iCal = new iCalWriter;
		$iCal->setFileOutput();
		$iCal->setFileName("assets/cal/" . $data["id"] . ".ics");
		//Now we can start with our output:
		$iCal->start();
		//To add event-data you need an iCalEvent-object:
		$iEvent = new iCalEvent;
		
		list($year_start,$month_start,$day_start,$hour_start,$minute_start,$second_start)=explode('-',date('Y-m-d-h-i-s',strtotime($data["start"])));
		list($year_end,$month_end,$day_end,$hour_end,$minute_end,$second_end)=explode('-',date('Y-m-d-h-i-s',strtotime($data["end"])));
		
		//A lot of stuff to set here. So here are just a few examples:
		$iEvent->setStart($year_start, $month_start, $day_start, 0, 1, "America/Bogota", 1, $hour_start, $minute_start);
		$iEvent->setEnd($year_end, $month_end, $day_end, 0, 1, "America/Bogota", 1, $hour_end, $minute_end);
		$iEvent->setShortDescription("Clase Superprofe");
		$iEvent->setLongDescription("Clase Superprofe. Los datos del profesor son: Telefono: " . $teacher->Phone . ", Email: " .  $teacher->Email);
		$iEvent->setLocation($data["address"]);
		$iEvent->setContact($teacher->Email);
		//Lets add the event to the iCalWriter-object:
		$iCal->add($iEvent);
		//We could add more events here.
		//Finally we want to end the output by:
		$iCal->end();
		
		$url_calendar =  getcwd() . "/assets/cal/" . $data["id"] . ".ics";
		
		
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
		$this->email->to($user->Email); 
		$this->email->cc('estudiantesuperprofe@gmail.com'); 
		$this->email->subject('Superprofe.co - Confirmacion de clase no. ' . $data["id"]);
		$this->email->message($template);  
		$this->email->attach($url_calendar);
		$this->email->send();
		
		
		// confirmation of teacher
		$template = file_get_contents(base_url("application/views/mail/confirmation_teacher.html"));
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
		
		/*
		$cal = file_get_contents(base_url("assets/cal/clase.ics"));
		$cal = str_replace("{{NAME}}","Clase de ".$data["area"],$cal);
		$cal = str_replace("{{START}}",date("YmdTHis",strtotime($data["start"])),$cal);
		$cal = str_replace("{{END}}",date("YmdTHis",strtotime($data["end"])),$cal);
		$cal = str_replace("{{SUMMARY}}","Clase de ".$data["area"],$cal);
		$cal = str_replace("{{ADDRESS}}","Clase de ".$data["address"],$cal);
		*/
		
		//$this->email->clear();
		
		$this->email->from('hola@superprofe.co', 'Superprofe');
		$this->email->to($teacher->Email); 
		$this->email->cc('estudiantesuperprofe@gmail.com'); 
		$this->email->subject('Superprofe.co - Confirmacion de clase no '.$data["id"]);
		$this->email->message($template);  
		//$this->email->attach($url_calendar);
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