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
	public function matematicas(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Matemáticas para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Matemáticas Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/matematicas");
		$this->load->view("footer.php");
	}
	public function fisica(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Física para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Física Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";	
		$this->load->view("header.php",$data);
		$this->load->view("bogota/fisica");
		$this->load->view("footer.php");
	}
	public function quimica(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Química para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Química Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/quimica");
		$this->load->view("footer.php");
	}
	public function ingles(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Inglés para Refuerzos y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de I Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/ingles");
		$this->load->view("footer.php");
	}
	public function refuerzoescolar(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio para Refuerzo Escolar y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Refuerzo Escolar Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/refuerzo");
		$this->load->view("footer.php");
	}
	public function algebra(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de algebra para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de algebra Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/algebra");
		$this->load->view("footer.php");
	}
	public function calculo(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Cálculo para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Cálculo Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/calculo");
		$this->load->view("footer.php");
	}
	public function estadistica(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Estadística para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Estadística Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/estadistica");
		$this->load->view("footer.php");
	}	
	public function contabilidad(){
		$data["headers"] =array("description"=>"En SuperProfe encuentras Profesores Particulares y a Domicilio de Contabilidad para Refuerzo y Preparación de Exámenes y como Apoyo al Proceso Académico. Queremos que no te preocupes Nunca más por buscar profesor, En www.superprofe.co  los puedes encontrar rápido, fácil y seguro!");
		$data["title"] = "Profesores y Clases de Contabilidad Particulares y a Domicilio - Encuentra el Profesor que Necesitas Aquí";
		$this->load->view("header.php",$data);
		$this->load->view("bogota/contabilidad");
		$this->load->view("footer.php");
	}

}
/* End of file clases-particulares.php */
/* Location: ./application/controllers/clases-particulares.php */