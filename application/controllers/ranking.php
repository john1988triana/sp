<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Ranking extends CI_Controller {
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
		
		$this->load->model('model_superprofe');
		$data["ranking"] = $this->model_superprofe->getRanking();
		
		//echo json_encode($data);
		//return;
		
		$this->load->view("header");
		$this->load->view("ranking/index", $data);
		$this->load->view("footer");
	}
}
/* Location: ./application/controllers/clases-particulares.php */