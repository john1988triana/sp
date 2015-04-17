<?php
class Robot extends CI_Controller {

	public function index()
	{
		$this->load->model('model_superprofe');
		$this->load->library('aulasamigas');
		$this->load->library('email');
		date_default_timezone_set("America/Bogota");
		$config['mailtype'] = "html";
		$this->email->initialize($config);						
		$classes=$this->model_superprofe->getClassByStatus(array(4));
		foreach($classes as $class){
			$end = new DateTime($class["end"]);
			$now = new DateTime();
			if(empty($class["id_student"])){continue;}
			if(empty($class["id_professor"])){continue;}
			if($end < $now){
				$this->email->clear();
				$data["status"] = 6;
				$this->model_superprofe->updateRequest($class["hash"],$data);
				$template = file_get_contents(base_url("application/views/mail/finalizada_student.html"));
				$template = str_replace("{{HOST}}",base_url(),$template);
				$template = str_replace("{{STUDENT NAME}}",$class["sFName"]." ".$class["sLName"],$template);
				$template = str_replace("{{TEACHER NAME}}",$class["pFName"]." ".$class["pLName"],$template);
				$template = str_replace("{{ID_CLASS}}",$class["hash"],$template);
				$student = json_decode($this->aulasamigas->getUsersInfo(array($class["id_student"])));
				$student = $student[0];
				
				$this->email->from('hola@superprofe.co', 'Superprofe');
				$this->email->to($student->Email); 
				$this->email->cc('estudiantesuperprofe@gmail.com'); 
				$this->email->subject('Superprofe.co - ¿Cómo estuvo tu clase?');
				$this->email->message($template);  
				
				$this->email->send();
				$this->email->clear();
				
				$template = file_get_contents(base_url("application/views/mail/finalizada_professor.html"));
				$template = str_replace("{{HOST}}",base_url(),$template);
				$template = str_replace("{{STUDENT NAME}}",$class["sFName"]." ".$class["sLName"],$template);
				$template = str_replace("{{TEACHER NAME}}",$class["pFName"]." ".$class["pLName"],$template);
				$template = str_replace("{{PRICE}}",$class["price_sp"],$template);
				
				$professor = json_decode($this->aulasamigas->getUsersInfo(array($class["id_professor"])));
				$professor = $professor[0];
				$this->email->from('hola@superprofe.co', 'Superprofe');
				$this->email->to($professor->Email); 
				$this->email->cc('estudiantesuperprofe@gmail.com'); 
				$this->email->subject('Superprofe.co - ¿Cómo estuvo tu clase?');
				$this->email->message($template);  
				
				$this->email->send();
			}
		}
	}
}