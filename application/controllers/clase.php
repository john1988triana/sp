<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Clase extends CI_Controller {
	private $campos;
	private $bd_content;
	private $resultados;
	public function __construct() {
		parent::__construct();
		$this->load->database('superpro', TRUE);
		$this->load->model('model_superprofe');
		$this->load->library('form_validation');
		$this->load->library('aulasamigas');
		if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		    return;
		  }
	}

	public function index()	
	{
	}
	public function calificar($reqid,$type){
	if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		    return;
		  }
		$data = $this->model_superprofe->getRequest($reqid);
		$data["type"] = $type;
		if($type == 1){
			$d = array("rate"=>$this->input->post("rate"),
						"comment"=>$this->input->post("comment"));
			if(!empty($d["rate"])){
				$this->model_superprofe->updateRequest($reqid,$d);
				$data = $this->model_superprofe->getRequest($reqid);
				$data["type"] = $type;
			}
		}else{
			$d = array("student_rate"=>$this->input->post("student_rate"),
						"student_comment"=>$this->input->post("student_comment"));
			if(!empty($d["student_rate"])){
				$this->model_superprofe->updateRequest($reqid,$d);
				$data = $this->model_superprofe->getRequest($reqid);
				$data["type"] = $type;
			}
		}
		
		
		$this->load->view("header");
		$this->load->view("clase/calificar",$data);
		$this->load->view("footer");
	}
	
	public function calificar_estudiante() {
		$this->load->view("header");
		$this->load->view("clase/calificar_estudiante");
		$this->load->view("footer");
	}
	
	public function confirmar($reqid){	
	if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		    return;
		  }	
		$data["status"] = 4;
		$this->model_superprofe->updateRequest($reqid,$data);
		$data = $this->model_superprofe->getRequest($reqid);
		$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
		$user = json_decode($this->aulasamigas->getUsersInfo(array($data["id_student"])));
		$user = $user[0];
		//$teacher = json_decode($this->aulasamigas->getUsersInfo(array($data["id_professor"])))[0];
		$teacher = $this->model_superprofe->loadUser($data["id_professor"]);
		foreach($areas as $area){
			if($area->IdArea== $data["id_area"]){
				$data["area"] = $area->Name;
				break;
			}
		}
		
		$template = file_get_contents(base_url("application/views/mail/confirmation.html"));
		$template = str_replace("{{HOST}}",base_url(),$template);
		$template = str_replace("{{AREA}}",$data["area"],$template);
		$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
		$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
		$template = str_replace("{{ADDRESS}}",$data["address"],$template);
		$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
		$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
		$template = str_replace("{{TEACHER EMAIL}}",$teacher["Email"],$template);
		$template = str_replace("{{TEACHER PHONE}}",$teacher["Phone"],$template);
		$template = str_replace("{{PRICE}}",($data["price_public"]+$data["price_sp"]),$template);
		
		/*
		$cal = file_get_contents(base_url("assets/cal/clase.ics"));
		$cal = str_replace("{{NAME}}","Clase de ".$data["area"],$cal);
		$cal = str_replace("{{START}}",date("YmdTHis",strtotime($data["start"])),$cal);
		$cal = str_replace("{{END}}",date("YmdTHis",strtotime($data["end"])),$cal);
		$cal = str_replace("{{SUMMARY}}","Clase de ".$data["area"],$cal);
		$cal = str_replace("{{ADDRESS}}","Clase de ".$data["address"],$cal);
		*/
		$config['mailtype'] = "html";
		$this->load->library('email');
		$this->email->initialize($config);
		
		
		$this->email->from('hola@superprofe.co', 'Superprofe');
		$this->email->to($user->Email); 
		$this->email->cc('hola@superprofe.co'); 
		$this->email->subject('Superprofe.co - Confirmacion de clase no '.$data["id"]);
		$this->email->message($template);  
		
		$this->email->send();
		$d["teacher"] = $teacher;
		$d["request"] = $data;
		$this->load->view("header");
		$this->load->view("clase/confirmada",$d);
		$this->load->view("footer");
	}
	public function cancelar($reqid){
	if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		    return;
		  }
		$data["status"]=2;
		$this->model_superprofe->updateRequest($reqid,$data);
		
		$data = $this->model_superprofe->getRequest($reqid);
		$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
		$user = json_decode($this->aulasamigas->getUsersInfo(array($data["id_student"])));
		$user = $user[0];
		//$teacher = json_decode($this->aulasamigas->getUsersInfo(array($data["id_professor"])))[0];
		$teacher = $this->model_superprofe->loadUser($data["id_professor"]);		
		foreach($areas as $area){
			if($area->IdArea== $data["id_area"]){
				$data["area"] = $area->Name;
			}
		}
		$d["teacher"] = $teacher;
		$d["request"] = $data;
		
		$this->load->view("header");
		$this->load->view("clase/cancelada",$d);
		$this->load->view("footer");
	}
	public function solicitar($reqid){
	if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		    return;
		  }
		$data = $this->model_superprofe->getRequest($reqid);
		$this->session->set_userdata("req_id","");
		if($data["id_professor"]==NULL){
			$data = $this->model_superprofe->getRequest($reqid);
			$this->load->view("header");
			$this->load->view("clase/asignar");
			$this->load->view("footer");
			
			$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
			$cities = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$levels = $this->model_superprofe->getLevels();
			foreach($areas as $area){
				if($area->IdArea== $data["id_area"]){
					$data["area"] = $area->Name;
				}
			}
			foreach($cities as $city){
				if($city->ID== $data["city"]){
					$data["city"] = utf8_decode($city->Name);
				}
			}
			foreach($levels as $level){
				if($level["id"]== $data["id_level"]){
					$data["level"] = $level["name"];
				}
			}
			$template = file_get_contents(base_url("application/views/mail/solicitar.html"));
			$template = str_replace("{{HOST}}",base_url(),$template);
			$template = str_replace("{{AREA}}",$data["area"],$template);
			$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
			$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
			$template = str_replace("{{LEVEL}}",$data["level"],$template);
			$template = str_replace("{{ADDRESS}}",$data["address"].", ".$data["city"],$template);
			$template = str_replace("{{TOPIC}}",$data["topic"],$template);
			$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
			$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
			$template = str_replace("{{ID_CLASS}}",$reqid,$template);
			
			$config['mailtype'] = "html";
			$this->load->library('email');
			$this->email->initialize($config);
			
			$this->email->from('hola@superprofe.co', 'Superprofe');
			$this->email->to('hola@superprofe.co'); 
			$this->email->subject('Superprofe.co - Solicitud de clase. por asignar profe '.$data["id"]);
			$this->email->message($template);  

			$this->email->send();
			
		}else{
			$areas = json_decode($this->aulasamigas->getAreasByContent('768'));
			$cities = json_decode(json_decode($this->aulasamigas->getCitiesByCountry('COL'))->cities);
			$user = $this->model_superprofe->loadUser($data["id_professor"]);
			$levels = $this->model_superprofe->getLevels();
			foreach($areas as $area){
				if($area->IdArea== $data["id_area"]){
					$data["area"] = $area->Name;
				}
			}
			foreach($cities as $city){
				if($city->ID== $data["city"]){
					$data["city"] = utf8_decode($city->Name);
				}
			}
			foreach($levels as $level){
				if($level["id"]== $data["id_level"]){
					$data["level"] = $level["name"];
				}
			}
			if($user){
			$data["status"]=3;
			}else{
			$data["status"]=2;
			}
			$template = file_get_contents(base_url("application/views/mail/solicitar.html"));
			$template = str_replace("{{HOST}}",base_url(),$template);
			$template = str_replace("{{AREA}}",$data["area"],$template);
			$template = str_replace("{{STUDENT NAME}}",$data["sFName"]." ".$data["sLName"],$template);
			$template = str_replace("{{TEACHER NAME}}",$data["pFName"]." ".$data["pLName"],$template);
			$template = str_replace("{{LEVEL}}",$data["level"],$template);
			$template = str_replace("{{ADDRESS}}",$data["address"].", ".$data["city"],$template);
			$template = str_replace("{{TOPIC}}",$data["topic"],$template);
			$template = str_replace("{{DATE}}",date("l,d F Y",strtotime($data["start"])),$template);
			$template = str_replace("{{TIME}}",date("h:i a",strtotime($data["start"])),$template);
			$template = str_replace("{{ID_CLASS}}",$reqid,$template);
			
			$config['mailtype'] = "html";
			$this->load->library('email');
			$this->email->initialize($config);
			
			$this->email->from('hola@superprofe.co', 'Superprofe');
			$this->email->to($user["Email"]); 
			$this->email->cc('hola@superprofe.co'); 
			$this->email->subject('Superprofe.co - Solicitud de confirmación de clase no '.$data["id"]);
			$this->email->message($template);  

			$this->email->send();
			
			$this->load->view("header");
			$d["teacher"] = $user;
			$d["request"] = $data;
			$this->load->view("clase/solicitada",$d);
			$this->load->view("footer");
		}
	}
}