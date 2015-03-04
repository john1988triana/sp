<?php
/* title: superprofe_model
 * Modelo completo de la base de datos de superprofe y en la cual ser realizaran las consultas
 *
 * Author: Edwin Alexander Gutiérrez Cely - edwin.gutierrez1991@gmail.com
 * Date Update: 21 Agosto 2014*/
if (!defined('BASEPATH'))
    exit('No hay acceso directo al script');

class Model_superprofe extends CI_Model
{
    private $bd_superpro;
	private $areas = null;
	public function __construct() {
        parent::__construct();
        $this->db_super_pro = $this->load->database('superpro', TRUE);
    }
	/**
	* Sets the areas to match against the professor skills
	*/
	public function setAreas($areas){
		$this->areas = $areas;
	}
	
	/**
	* Gets the levels
	*/
	public function getLevels(){
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("level");
		$this->db_super_pro->where("id > ",1);
		$query = $this->db_super_pro->get();
		return $query->result_array();
	}
	/**
	* Add a new user to the platform to Add a User to the DataBase it should be checked first
	*/
	private function addUser($firstName,$lastName,$id_user,$type){
		if($type == 0){ //student
			$this->db_super_pro->insert('student',array("firstName"=>$firstName,"lastName"=>$lastName,"id_user"=>$id_user));
		}else{ //teacher
			$this->db_super_pro->insert('professor',array("firstName"=>$firstName,"lastName"=>$lastName,"id_user"=>$id_user));
		}
	}
	/**
	* Checks for the existence of an user if the user doesnt exist on DB then create it
	*/
	public function checkUser($firstName,$lastName,$id_user,$type){
		if($type==0){ //student
			$this->db_super_pro->select("*");
			$this->db_super_pro->from("student");
			$this->db_super_pro->where("id_user = ",$id_user);
			$query = $this->db_super_pro->get();
			$results = $query->result_array();
			if(count($results) == 0){
				$this->addUser($firstName,$lastName,$id_user,$type);
				return $this->checkUser($firstName,$lastName,$id_user,$type);
			}else{
				return $results[0];
			}
		}else{ //teacher
			$this->db_super_pro->select("*");
			$this->db_super_pro->from("professor");
			$this->db_super_pro->where("id_user = ",$id_user);
			$query = $this->db_super_pro->get();
			$results = $query->result_array();
			if(count($results) == 0){
				$this->addUser($firstName,$lastName,$id_user,$type);
				return $this->checkUser($firstName,$lastName,$id_user,$type);
			}else{
				return $results[0];
			}
		}
	}
	/**
	* Find matches on database
	*/
	public function getMatches($area,$topic,$level,$city,$address,$date,$time){
		if(!$area || !$city || !$date){
			return array();
		}
		$day = date('w',strtotime($date));
		$teachers = json_decode($this->aulasamigas->searchTeachers("NULL","NULL",$city));
		if($teachers){
			$q =" p.* from professor p 
				join professor_area pa on pa.id_professor = p.id
				join available a on a.id_professor = p.id 
				where 
				p.active = 1 and 
				pa.id_area = $area and 
				pa.id_level = $level and 
				a.start_day <= $day and
				a.end_day >= $day ";
			if($time){
				$endtime = $time+2;
				$q.="and
				a.start_time <= $time and
				a.end_time >= $endtime ";
				}
			$q .= "and (";
			foreach($teachers as $teacher){
				$q .= "p.id_user = '$teacher->IdUser' or ";
			}
			$q = substr($q,0,-3);
			$q .= ") group by p.id";
			
			$this->db_super_pro->select($q);
			$query= $this->db_super_pro->get();
			$results = $query->result_object();
			
			foreach($results as &$result){
				foreach($teachers as &$teacher){
					if($result->id_user == $teacher->IdUser){
						$result->Email = $teacher->Email;
						$result->Image = $teacher->Image;
						$result->Phone = $teacher->Phone;
						$result->Movil = $teacher->Movil;
						$result->Gender = $teacher->Gender;
						$result->City = $teacher->City;
					}
				}
			}
			return $results;
		}
		return array();
	}
	/**
	*
	*/
	public function adminRole($id){
		$this->db_super_pro->select("role");
		$this->db_super_pro->from("administrator");
		$this->db_super_pro->where("id = ",$id);
		$query = $this->db_super_pro->get();
		$result = $query->row_array();
		if(isset($result["role"])){
			return $result["role"];
		}
		return NULL;
	}
	/**
	* Queries the aulas amigas database and fetches for a complete user
	*/
	public function loadUser($user_id){
		$amigas = json_decode($this->aulasamigas->getUsersInfo(array($user_id)), true);
		$amigas = $amigas[0];
		if($amigas["isTeacher"] == 1){
			$this->setAreas(json_decode($this->aulasamigas->getAreasByContent('768')));
			//user info
			$this->db_super_pro->select("*");
			$this->db_super_pro->from("professor");
			$this->db_super_pro->where("id_user = ",$amigas["IdUser"]);
			$query = $this->db_super_pro->get();
			$user = array_merge($amigas,$query->row_array());
			//experience
			$this->db_super_pro->select("e.* , i.name institution, i.phone phone, i.address address");
			$this->db_super_pro->from("experience e");
			$this->db_super_pro->where("id_professor = ",$user["id"]);
			$this->db_super_pro->join("institution i","e.id_institution = i.id");
			$query = $this->db_super_pro->get();
			$user["experience"] = $query->result_array();
			//areas
			$this->db_super_pro->select("pa.*,l.name level");
			$this->db_super_pro->from("professor_area pa");
			$this->db_super_pro->join("level l ","l.id = pa.id_level");
			$this->db_super_pro->where("pa.id_professor = ",$user["id"]);
			$query = $this->db_super_pro->get();
			$ids = $query->result_object();
			
			foreach($ids as &$id){
				foreach($this->areas as $areaAmigas){
					if($id->id_area == $areaAmigas->IdArea){
						$id->Name = $areaAmigas->Name;
					}
				}
			}
			$user["selected_areas"] = $ids;
			$user["areas"] = $this->areas;
			//references
			$this->db_super_pro->select("*");
			$this->db_super_pro->from("reference");
			$this->db_super_pro->where("id_professor = ",$user["id"]);
			$query = $this->db_super_pro->get();
			$user["reference"] = $query->result_array();
			
			return $user;
		}
		else{
			$this->db_super_pro->select("*");
			$this->db_super_pro->from("student");
			$this->db_super_pro->where("id_user = ",$amigas["IdUser"]);
			$query = $this->db_super_pro->get();
			$user = array_merge($amigas,$query->row_array());
			
			//experience
			$this->db_super_pro->select("e.* , i.name institution, i.phone phone, i.address address");
			$this->db_super_pro->from("studies e");
			$this->db_super_pro->where("id_student = ",$user["id"]);
			$this->db_super_pro->join("institution i","e.id_institution = i.id");
			$query = $this->db_super_pro->get();
			$user["studies"] = $query->result_array();
			
			return $user;
		}
	}
	/**
	* Update status of the professor
	*/
	public function update_professor_data($status){
		$this->db_super_pro->select('*');
        $this->db_super_pro->from('professor');        
        $this->db_super_pro->where('id_user', $this->session->userdata('sIdUser'));        
        $result = $this->db_super_pro->get();
         if ($result->num_rows() > 0) {
         	$data_insert = array(
					   'status' => $status,
					   'linkedin' => $this->input->post('cpprofileLinkedin'),
					   'terms' => 1
					   );
            $this->db_super_pro->where('id_user', $this->session->userdata('sIdUser'));
            $this->db_super_pro->update('professor', $data_insert);   
            $result = json_encode($result->result());
         	$result = json_decode($result, true);
         	$data = array(
					   'id_user' => $result[0]['id_user'],
					   'status' => $status,
					   'verificar_cuenta' => $result[0]['status']
					   );
	         return $data;
         }else{
	         return FALSE;
         }
	}
	/**
	* Updates user
	*/
	public function update($id_user,$data,$type){
		$this->db_super_pro->where('id_user', $id_user);
		if($type == 1){
			$this->db_super_pro->update('professor', $data);
		}else{
			$this->db_super_pro->update('student', $data);
		}
	}
	
	/**
	* Insert User video
	*/
	public function insertvideo($id_user,$data){
		
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		//$professors["id"]
		
		$data_insert = array(
					   'professor_id' => $professors["id"],
					   'video_url' => $data["youtube"]
					   );
		
		$this->db_super_pro->insert("videos_by_professor",$data_insert);
		$id = $this->db_super_pro->insert_id();
		
		return $id;
	}
	
	/**
	* Get user videos 
	*/
	public function getVideosByUser($id_user) {
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		//$professors["id"]
		
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("videos_by_professor");
		$this->db_super_pro->where("professor_id = ", $professors["id"]);
		$query = $this->db_super_pro->get();
		return $query->result_array();	
	}
	
	/**
	* Adds a experience to a professor
	*/
	public function addExperience($id_user,$data){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		//institution
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("institution");
		$this->db_super_pro->like("name",$data["institution"]);
		$this->db_super_pro->like("address",$data["address"]);
		$query = $this->db_super_pro->get();
		$institutions = $query->row_array();
		$id=-1;
		if(count($institutions) == 0){
			$d =	array("name" => $data["institution"],
						  "address"=>$data["address"]);
			if(isset($data["phone"])){
				$d["phone"] = $data["phone"];
			}
			$this->db_super_pro->insert("institution",$d);
			$id = $this->db_super_pro->insert_id();
		}else{
			$id = $institutions["id"];
		}
		$this->db_super_pro->insert("experience",array("id_professor"=>$professors["id"],
														"id_institution"=>$id,
														"title"=>$data["title"],
														"from"=>$data["from"],
														"to"=>$data["to"],
														"description"=>$data["description"],
														"additional_activities"=>$data["additional"],
														"type"=>$data["type"]));
		return $this->db_super_pro->insert_id();
	}
	
	/**
	* Adds a study to a student
	*/
	public function addStudies($id_user,$data){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("student");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$students = $query->row_array();
		//institution
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("institution");
		$this->db_super_pro->like("name",$data["institution"]);
		$query = $this->db_super_pro->get();
		$institutions = $query->row_array();
		$id=-1;
		if(count($institutions) == 0){
			$d =	array("name" => $data["institution"],
						  "address"=>$data["address"]);
			if(isset($data["phone"])){
				$d["phone"] = $data["phone"];
			}
			$this->db_super_pro->insert("institution",$d);
			$id = $this->db_super_pro->insert_id();
		}else{
			$id = $institutions["id"];
		}
		$this->db_super_pro->insert("studies",array("id_student"=>$students["id"],
														"id_institution"=>$id,
														"title"=>$data["title"],
														"from"=>$data["from"],
														"to"=>$data["to"],
														"id_level"=>$data["id_level"]
													));
		return $this->db_super_pro->insert_id();
	}
	
	/**
	* Gets the availability of a professor
	*/
	public function getAvailable($id_user){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id = $id["id"];
		//available
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("available");
		$this->db_super_pro->where("id_professor = ",$id);
		$query = $this->db_super_pro->get();
		return json_encode($query->result_array());
	}
	/**
	* Updates the availability of a professor
	*/
	public function updateAvailable($id_user,$lapses){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id=$id["id"];
		//remove previous lapses
		$this->db_super_pro->delete("available",array("id_professor"=>$id));
		foreach($lapses as &$lapse){
			$lapse["id_professor"] = $id;
			$this->db_super_pro->insert("available",$lapse);
		}
	}
	/**
	* Removes a study from a student
	*/
	public function removeStudies($id_user,$experience){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("student");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$this->db_super_pro->delete("studies",array("id_student"=>$professors["id"],
															"id"=>$experience));
	}
	/**
	* Removes a experience from a professor
	*/
	public function removeExperience($id_user,$experience){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$this->db_super_pro->delete("experience",array("id_professor"=>$professors["id"],
															"id"=>$experience));
	}
	/**
	* Adds a reference to a professor
	*/
	public function addReference($id_user,$data){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$this->db_super_pro->insert("reference",array("id_professor"=>$professors["id"],
													"name"=>$data["name"],
													"title"=>$data["title"],
													"phone"=>$data["phone"],
													"address"=>$data["address"],
													"type"=>$data["type"]));
		return $this->db_super_pro->insert_id();
	}
	/**
	* Removes a reference from a professor
	*/
	public function removeReference($id_user,$reference){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$this->db_super_pro->delete("reference",array("id_professor"=>$professors["id"],
															"id"=>$reference));
	}
	/**
	* Adds a competence to a professor
	*/
	public function addCompentence($id_user,$competence,$level){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$id = $professors["id"];
		
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("professor_area");
		$this->db_super_pro->where("id_professor = ",$id);
		$this->db_super_pro->where("id_area = ",$competence);
		$this->db_super_pro->where("id_level = ",$level);
		$query = $this->db_super_pro->get();
		$result = $query->row_array();
		if(count($result)>0)
			return;
		$this->db_super_pro->insert("professor_area",array("id_professor"=>$id,
															"id_area"=>$competence,
															"id_level"=>$level));
	}
	/**
	* Removes a competence from a professor
	*/
	public function removeCompentence($id_user,$competence){
		$comp = explode("-",$competence);
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		$this->db_super_pro->delete("professor_area",array("id_professor"=>$professors["id"],
															"id_area"=>$comp[0],
															"id_level"=>$comp[1]));
	}
	/**
	* Get the status of the profesor
	*/
	public function getProfessorStatus($id_user){
		$this->db_super_pro->select("status");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$professors = $query->row_array();
		if(count($professors) == 0){
			return null;
		}else{
			return $professors["status"];
		}
	}
	/**
	* Gets the studies of a student
	*/
	public function getStudies($id_user){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("student");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id=$id["id"];
		$this->db_super_pro->select("e.title,e.from,e.to,e.type,i.name institution, l.name level");
		$this->db_super_pro->from("studies e");
		$this->db_super_pro->join("institution i","e.id_institution = i.id");
		$this->db_super_pro->join("level l","e.id_level = l.id");
		$this->db_super_pro->where("e.id_student = ",$id);
		$this->db_super_pro->group_by("e.id");
		$query = $this->db_super_pro->get();
		return json_encode($query->result_array());
	}
	/**
	* Gets the experience of a professor
	*/
	public function getExperience($id_user){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id = $id["id"];
		$this->db_super_pro->select("e.title,e.from,e.to,e.description,e.additional_activities,e.type,i.name institution");
		$this->db_super_pro->from("experience e");
		$this->db_super_pro->join("institution i","e.id_institution = i.id");
		$this->db_super_pro->where("e.id_professor = ",$id);
		$this->db_super_pro->group_by("e.id");
		$query = $this->db_super_pro->get();
		return json_encode($query->result_array());
	}
	/**
	* Gets the references of a professor
	*/
	public function getReference($id_user){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id = $id["id"];
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("reference");
		$this->db_super_pro->where("id_professor = ",$id);
		$query = $this->db_super_pro->get();
		return json_encode($query->result_array());
	}
	/**
	* Gets the profile of a professor
	*/
	public function getProfile($id_user){
		$this->db_super_pro->select("id");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id =$id["id"];
		$this->db_super_pro->select("profile");
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id = ",$id);
		$query = $this->db_super_pro->get();
		return json_encode($query->row_array());
	}
	/**
	* Creates a request for a class with the asociated professor
	*/
	function createRequest($data){
		$data["date"] = date("Y-m-d H:i:s");
		if(isset($data["id_professor"])){
			$this->db_super_pro->select("id");
			$this->db_super_pro->from("professor");
			$this->db_super_pro->where("id_user = ",$data["id_professor"]);
			$query = $this->db_super_pro->get();
			$data["id_professor"] = $query->row_array();
			$data["id_professor"] = $data["id_professor"]["id"];
		}
		if(isset($data["id_student"])){
			$this->db_super_pro->select("id");
			$this->db_super_pro->from("student");
			$this->db_super_pro->where("id_user = ",$data["id_student"]);
			$query = $this->db_super_pro->get();
			$data["id_student"] = $query->row_array();
			$data["id_student"] = $data["id_student"]["id"];
		}
		$this->db_super_pro->insert("request",$data);
		$id = $this->db_super_pro->insert_id(); 
		$this->db_super_pro->where('id', $id);
		$hash = md5($id);
        $this->db_super_pro->update('request', array("hash"=>$hash));   
		return $hash;
	}
	function getPrice($id,$type){
		if($type=="public"){
			$this->db_super_pro->select("price price");
		}else{
			$this->db_super_pro->select("fee_sp price");
		}
		$this->db_super_pro->from("professor");
		$this->db_super_pro->where("id_user = ",$id);
		$query = $this->db_super_pro->get();
		$result = $query->row_array();
		return $result["price"];
	}
	function getRequest($id){
		$this->db_super_pro->select("r.id,r.date,r.hash,r.id_area,r.id_level,r.rate,r.student_rate,r.city,r.address,r.start,r.end,st.id id_status,st.name status,r.phone,r.price_public,r.price_sp,r.topic,s.id_user id_student,s.firstName sFName,s.lastName sLName,p.id_user id_professor,p.firstName pFName,p.lastName pLName");
		$this->db_super_pro->from("request r");
		$this->db_super_pro->join("student s","r.id_student = s.id","left");
		$this->db_super_pro->join("professor p","r.id_professor = p.id","left");
		$this->db_super_pro->join("status st","r.status = st.id","left");
		$this->db_super_pro->where("r.hash = ",$id);
		$query = $this->db_super_pro->get();
		return $query->row_array();
	}
	function updateRequest($id,$data){
		if(isset($data["id_professor"])){
			if($data["id_professor"] != "-1"){
				$this->db_super_pro->select("id");
				$this->db_super_pro->from("professor");
				$this->db_super_pro->where("id_user = ",$data["id_professor"]);
				$query = $this->db_super_pro->get();
				$data["id_professor"] = $query->row_array();
				$data["id_professor"] =$data["id_professor"]["id"];
			}
		}
		if(isset($data["id_student"])){
			$this->db_super_pro->select("id");
			$this->db_super_pro->from("student");
			$this->db_super_pro->where("id_user = ",$data["id_student"]);
			$query = $this->db_super_pro->get();
			$data["id_student"] = $query->row_array();
			$data["id_student"] = $data["id_student"]["id"];
		}
		$this->db_super_pro->where('hash', $id);
        $this->db_super_pro->update('request', $data);  
				
		if(isset($data["rate"])){
			$this->db_super_pro->select("id_professor");
			$this->db_super_pro->from("request");
			$this->db_super_pro->where('hash', $id);
			$query = $this->db_super_pro->get();
			$id_professor = $query->row_array();
			$id_professor = $id_professor["id_professor"];
			
			$this->db_super_pro->select("avg(rate) average");
			$this->db_super_pro->from("request");
			$this->db_super_pro->where('id_professor', $id_professor);
			$this->db_super_pro->where('rate >', '0');
			$query = $this->db_super_pro->get();
			$row = $query->row_array();
			$p = array("rate"=>$row["average"]);
			
			$this->db_super_pro->where('id', $id_professor);
			$this->db_super_pro->update('professor', $p);  
		}
		if(isset($data["student_rate"])){
			$this->db_super_pro->select("id_student");
			$this->db_super_pro->from("request");
			$this->db_super_pro->where('hash', $id);
			$query = $this->db_super_pro->get();
			$id_student = $query->row_array();
			$id_student = $id_student["id_student"];
			
			$this->db_super_pro->select("avg(rate) average");
			$this->db_super_pro->from("request");
			$this->db_super_pro->where('id_student', $id_student);
			$this->db_super_pro->where('rate >', '0');
			$query = $this->db_super_pro->get();
			$row = $query->row_array();
			$p = array("rate"=>$row["average"]);
			
			$this->db_super_pro->where('id', $id_student);
			$this->db_super_pro->update('student', $p);  
		}
	}
	function getRangeClasses($id_user,$start,$end,$type,$states = array(4)){
		$this->db_super_pro->select("id");
		if($type == 1){
			$this->db_super_pro->from("professor");
		}else{
			$this->db_super_pro->from("student");
		}
		$this->db_super_pro->where("id_user = ",$id_user);
		$query = $this->db_super_pro->get();
		$id = $query->row_array();
		$id = $id["id"];
		
		$q = " r.*,s.firstName sFName,s.lastName sLName, p.firstName pFName, p.lastName pLName from request r join student s on s.id = r.id_student join professor p on p.id = r.id_professor where ";
		if($type== 1){
			$q.="r.id_professor = '$id' ";
		}else{
			$q.="r.id_student = '$id' ";
		}
		$q.="and r.start > '$start' and r.end < '$end' and (";
		foreach($states as $state){
			$q.="r.status = '$state' or ";
		}
		$q = substr($q,0,-3);
		$q .= ")";
		$this->db_super_pro->select($q);
		$query = $this->db_super_pro->get();
		return $query->result_array();
	}
	////// ADMIN FUNCTIONS
	function getStatus(){
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("status");
		$this->db_super_pro->order_by("id","asc");
		$query = $this->db_super_pro->get();
		return $query->result_array();
	}
	function getFullStudentList(){
		$this->db_super_pro->select("s.*,count(r.id) classes");
		$this->db_super_pro->from("student s");
		$this->db_super_pro->join("request r","r.id_student = s.id","left");
		$this->db_super_pro->group_by("s.id","asc");
		$query = $this->db_super_pro->get();
		$students = $query->result_array();
		$ids = array();
		foreach($students as &$t){
			$ids[] = $t["id_user"];
		}
		$aulas = json_decode($this->aulasamigas->getUsersInfo($ids));
		foreach($aulas as &$a){
			foreach($students as &$t){
				if($a->IdUser == $t["id_user"]){
					$t["address"] = $a->Address;
					$t["phone"] = $a->Phone;
					$t["birthday"] = $a->DayBorn ."-". $a->MonthBorn. "-".$a->YearBorn;
					$t["id_city"] = $a->City;
					$t["email"] = $a->Email;
					$t["doc_number"] = $a->DocNumber;
				}
			}
		}
		return $students;
	}
	function getPayableProfessors(){
		$this->db_super_pro->select("p.*,count(q.id) classes,sum(q.price_public) price,sum(q.price_sp) fee");
		$this->db_super_pro->from("professor p");
		$this->db_super_pro->join("request q","q.id_professor = p.id");
		$this->db_super_pro->where("q.status",'6');
		$this->db_super_pro->group_by("p.id","asc");
		$query = $this->db_super_pro->get();
		$teachers = $query->result_array();
		$ids = array();
		if(count($teachers)){
		foreach($teachers as &$t){
			$ids[] = $t["id_user"];
		}
		$aulas = json_decode($this->aulasamigas->getUsersInfo($ids));
		foreach($aulas as &$a){
			foreach($teachers as &$t){
				if($a->IdUser == $t["id_user"]){
					$t["address"] = $a->Address;
					$t["phone"] = $a->Phone;
					$t["birthday"] = $a->DayBorn ."-". $a->MonthBorn. "-".$a->YearBorn;
					$t["id_city"] = $a->City;
					$t["email"] = $a->Email;
					$t["doc_number"] = $a->DocNumber;
				}
			}
		}
		}
		return $teachers;
	}
	function getFullProfessorList($active=TRUE){
		$this->db_super_pro->select("p.*,GROUP_CONCAT(pa.id_area) areas");
		$this->db_super_pro->from("professor p");
		$this->db_super_pro->join("professor_area pa","pa.id_professor = p.id","left");
		if($active == true){
			$this->db_super_pro->where("p.active","1");
		}
		$this->db_super_pro->group_by("p.id","asc");
		$query = $this->db_super_pro->get();
		$teachers = $query->result_array();
		$ids = array();
		foreach($teachers as &$t){
			$ids[] = $t["id_user"];
		}
		$aulas = json_decode($this->aulasamigas->getUsersInfo($ids));
		foreach($aulas as &$a){
			foreach($teachers as &$t){
				if($a->IdUser == $t["id_user"]){
					$t["address"] = $a->Address;
					$t["phone"] = $a->Phone;
					$t["birthday"] = $a->DayBorn ."-". $a->MonthBorn. "-".$a->YearBorn;
					$t["id_city"] = $a->City;
					$t["email"] = $a->Email;
					$t["doc_number"] = $a->DocNumber;
				}
			}
		}
		return $teachers;
	}
	function getPendingProfessors(){
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("professor p");
		$this->db_super_pro->or_where("p.validation_background","0");
		$this->db_super_pro->or_where("p.validation_professional_ref","0");
		$this->db_super_pro->or_where("p.validation_personal_ref","0");
		$this->db_super_pro->or_where("p.validation_interview","0");
		$this->db_super_pro->or_where("p.validation_personal_test","0");
		$this->db_super_pro->or_where("p.validation_agreement","0");
		$this->db_super_pro->or_where("p.active","0");
		$query = $this->db_super_pro->get();
		$teachers = $query->result_array();
		$ids = array();
		foreach($teachers as &$t){
			$ids[] = $t["id_user"];
		}
		$aulas = json_decode($this->aulasamigas->getUsersInfo($ids));
		foreach($aulas as &$a){
			foreach($teachers as &$t){
				if($a->IdUser == $t["id_user"]){
					$t["email"] = $a->Email;
					$t["doc_number"] = $a->DocNumber;
				}
			}
		}
		return $teachers;
	}
	function getActualClassesProfessors(){
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("professor p");
		$this->db_super_pro->join("request r","r.id_professor = p.id");
		$this->db_super_pro->where("r.status","4");
		$query = $this->db_super_pro->get();
		$teachers = $query->result_array();
		$ids = array();
		foreach($teachers as &$t){
			$ids[] = $t["id_user"];
		}
		if(count($ids)){
			$aulas = json_decode($this->aulasamigas->getUsersInfo($ids));
			foreach($aulas as &$a){
				foreach($teachers as &$t){
					if($a->IdUser == $t["id_user"]){
						$t["email"] = $a->Email;
						$t["doc_number"] = $a->DocNumber;
					}
				}
			}
		}
		return $teachers;
	}
	function updateProfessor($data){
		$this->db_super_pro->where('id', $data["id"]);
        $this->db_super_pro->update('professor', $data);
	}
	function updateOrCreateStudent($data){
		$user = json_decode($this->aulasamigas->getUserByEmail($data["email"]));
		if(empty($data)){
			$result = json_decode($this->aulasamigas->addUser(
				$data["firstName"], $data["lastName"], $data["email"], $_SERVER['REMOTE_ADDR'], 
				$data["doc"], $data["gender"], 0, 0, '768'));
			$this->checkUser($data["firstName"],$data["lastName"],$result->id_user,0);
			$data["id_user"] = $result->id_user;
		}else{
			$data["id_user"] = $user[0]->IdUser;
		}
		
		if($data["birthday"]) {
			$dateBorn = explode("-", $data["birthday"]);
			$dayBorn = $dateBorn[0];
			$monthBorn = $dateBorn[1];
			$yearBorn = $dateBorn[2];
		}
		else {
			$dayBorn = "";
			$monthBorn = "";
			$yearBorn = "";
		}
		
		$this->aulasamigas->updateContactUserInfo(array("Email"=>$data["email"],"FirstName"=>$data["firstName"],
														"FamilyName"=>$data["lastName"],"City"=>$data["city"],
														"Country"=>$data["country"],"Phone"=>$data["phone"], "Movil"=>$data["mobile"], 
														"DayBorn"=>$dayBorn, "MonthBorn"=>$monthBorn, "YearBorn"=>$yearBorn,
														"Address"=>$data["address"],"DocType"=>$data["docType"], "Gender"=>$data["gender"],
														"DocNumber"=>$data["doc"]));
		$this->db_super_pro->where('id_user', $data["id_user"]);
        $this->db_super_pro->update('student', array("firstName"=>$data["firstName"],"lastName"=>$data["lastName"]));
	}
	function getClassByStatus($status=array(3)){
		$this->db_super_pro->select("r.id,r.hash,r.date,r.id_area,r.rate,
								r.comment,l.name level,r.city,r.address,r.start,
								r.end,r.status,r.phone,r.price_public,r.price_sp,r.topic,r.notes,
								s.firstName sFName,s.lastName sLName,p.firstName pFName,
								p.lastName pLName,p.id_user id_professor,s.id_user id_student");
		$this->db_super_pro->from("request r");
		$this->db_super_pro->join("level l","r.id_level = l.id","left");
		$this->db_super_pro->join("student s","r.id_student = s.id","left");
		$this->db_super_pro->join("professor p","r.id_professor = p.id","left");
		foreach($status as $state){
			$this->db_super_pro->or_where("r.status = ",$state);
		}		
		$query = $this->db_super_pro->get();
		return $query->result_array();
	}
	
	/**
	* promo codes
	*/
	
	function getAllPromoCodes(){
		$this->db_super_pro->select("*");
		$this->db_super_pro->from("promo_codes");
		$this->db_super_pro->order_by("id","desc");
		$query = $this->db_super_pro->get();
		return $query->result_array();
	}
	
	function deletePromoCodeById($id){
		
		$this->db_super_pro->delete("promo_codes",array("id"=>$id));
		
	}
	
}