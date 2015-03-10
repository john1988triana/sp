<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Bogota extends CI_Controller {
	/* function: __construct
     * 
	 */    
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('user_agent');
	}

	/* function: index
     * Crea la vista colombia
     *
     * parameter:
     *      void.
     *
     * return:
     *      Vistas Cargadas
     */

	public function index() {
		redirect(base_url("clases_particulares"));
	}
	
	public function tematica() {
		
		$topic = $this->input->get("topic");
		
		switch($topic) {
			case "matematicas": 
				$data["topic"] = "Matemáticas";
				$data["topic_no_sign"] = "Matematicas";
				$data["url_image"] = "matematicas.jpg";
				break;
			case "fisica": 
				$data["topic"] = "Física";
				$data["topic_no_sign"] = "Fisica";
				$data["url_image"] = "fisica.jpg";
				break;
			case "quimica": 
				$data["topic"] = "Química";
				$data["topic_no_sign"] = "Quimica";
				$data["url_image"] = "quimica.jpg";
				break;
			case "ingles": 
				$data["topic"] = "Inglés";
				$data["topic_no_sign"] = "Ingles";
				$data["url_image"] = "profesores-ingles.jpg";
				break;
			case "apoyo_escolar": 
				$data["topic"] = "Refuerzo y Apoyo Escolar";
				$data["topic_no_sign"] = "Refuerzo y Apoyo Escolar";
				$data["url_image"] = "refuerzo-escolar-apoyo-tareas.jpg";
				break;
			case "algebra": 
				$data["topic"] = "Álgebra";
				$data["topic_no_sign"] = "Algebra";
				$data["url_image"] = "algebra.jpg";
				break;
			case "calculo": 
				$data["topic"] = "Cálculo";
				$data["topic_no_sign"] = "Calculo";
				$data["url_image"] = "calculo.jpg";
				break;
			case "estadistica": 
				$data["topic"] = "Estadística";
				$data["topic_no_sign"] = "Estadistica";
				$data["url_image"] = "estadistica.jpg";
				break;
			case "contabilidad": 
				$data["topic"] = "Contabilidad";
				$data["topic_no_sign"] = "Contabilidad";
				$data["url_image"] = "contabilidad.jpg";
				break;
		}
		
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	
	public function getTeachers() {
		$this->load->model('model_superprofe');
		
		$p_area = $this->input->get("id_area");
		$level = $this->input->get("level");
		$order = $this->input->get("order");
		$model_order = "";
		$order_direction = "";
		
		switch($order){
			case "nombre": $model_order = "pro.firstName";
						$order_direction = "asc";
						break;
			case "rating": $model_order = "pro.rate";
						$order_direction = "desc";
						break;
			case "precio": $model_order = "pro.price";
						$order_direction = "asc";
						break;
			case "nivel": $model_order = "pro.level";
						$order_direction = "desc";
						break;
		}
		
		
		$result = $this->model_superprofe->getTeachers($p_area, $level, $model_order, $order_direction);
		
		echo json_encode($result);
		
	}
	
	public function matematicas(){
		
		$data["topic"] = "Matemáticas";
		$data["topic_no_sign"] = "Matematicas";
		$data["url_image"] = "matematicas.jpg";
		
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Matemáticas para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Matemáticas Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		//$this->load->view("bogota/matematicas");
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function fisica(){
		
		$data["topic"] = "Física";
		$data["topic_no_sign"] = "Fisica";
		$data["url_image"] = "fisica.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Física para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Física Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";	
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function quimica(){
		
		$data["topic"] = "Química";
		$data["topic_no_sign"] = "Quimica";
		$data["url_image"] = "quimica.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Química para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Química Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function ingles(){
		
		$data["topic"] = "Inglés";
		$data["topic_no_sign"] = "Ingles";
		$data["url_image"] = "profesores-ingles.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Inglés para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de I Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function refuerzoescolar(){
		
		$data["topic"] = "Refuerzo y Apoyo Escolar";
		$data["topic_no_sign"] = "Refuerzo y Apoyo Escolar";
		$data["url_image"] = "refuerzo-escolar-apoyo-tareas.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio para Refuerzo Escolar y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Refuerzo Escolar Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function algebra(){
		
		$data["topic"] = "Álgebra";
		$data["topic_no_sign"] = "Algebra";
		$data["url_image"] = "algebra.jpg";
						
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de algebra para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de algebra Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function calculo(){
		$data["topic"] = "Cálculo";
		$data["topic_no_sign"] = "Calculo";
		$data["url_image"] = "calculo.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Cálculo para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Cálculo Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}
	public function estadistica(){
		$data["topic"] = "Estadística";
		$data["topic_no_sign"] = "Estadistica";
		$data["url_image"] = "estadistica.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Estadística para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Estadística Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}	
	public function contabilidad(){
		
		$data["topic"] = "Contabilidad";
		$data["topic_no_sign"] = "Contabilidad";
		$data["url_image"] = "contabilidad.jpg";
				
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Contabilidad para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Contabilidad Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/tematica", $data);
		$this->load->view("footer.php");
	}

}
/* End of file clases-particulares.php */
/* Location: ./application/controllers/clases-particulares.php */