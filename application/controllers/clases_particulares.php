<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Clases_particulares extends CI_Controller {
	/* function: __construct
     * 
	 */    
	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('user_agent');
	}

	/* function: index
     * Crea la vista comofunciona
     *
     * parameter:
     *      void.
     *
     * return:
     *      Vistas Cargadas
     */

	public function index() {
		$headers = array("author"=>"Nadez",
						"description" => "Profesores Particulares de Matemáticas, Química, Física, Idiomas, para Refuerzos, Preparación de Exámenes y Apoyo Escolar.");
		$title = "Profesores a Domicilio. Encuentra el Profesor que Necesitas Aquí.";
		$data= array("headers" => $headers,
					"title" => $title);
		$this->load->view("header.php",$data);
		$this->load->view("clases_particulares/clases_particulares.php");
		$this->load->view("footer.php");
	}
}
/* End of file clases-particulares.php */
/* Location: ./application/controllers/clases-particulares.php */