<?php

/* title: Index
 * Clase login .
 *
 * Author: Alejandro sossa - Yeisson Ibarra.
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Index extends CI_Controller {
	/* function: __construct
     * Constructor del control login carga el modelo login_model desde el principio para realizar validaciones correspondientes. */

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('user_agent');
	}

	/* function: index
     * Inicio de la plataforma .
     *
     * parameter:
     *      void.
     *
     * return:
     *      void.
     */

	public function index() {
		
		$this->_load_index();
	}

	private function _load_index(){
		
		$id_user = $this->session->userdata('sIdUser');
		$esAdmin = $this->session->userdata('esAdmin');

		if($esAdmin)
			redirect('administrador/cargar_panel');
		
		if (!empty($id_user) AND $id_user != NULL) {
			redirect('login/validate_view');
		}else{
			$this->load->library('aulasamigas');
			$this->load->model('model_superprofe');
			$data = array(
				"areas" => $this->aulasamigas->getAreasByContent('768'),
				"cities" => $this->aulasamigas->getCitiesByCountry('COL'),
				"levels" => $this->model_superprofe->getLevels()
			);
			$this->load->view('header');
			$this->load->view('index',$data);
			$this->load->view('footer');
		}
		
	}
	public function pre_mat()
	{
		$this->load->view('vistas_precargadas/matematicas');
	}
	public function pre_ingles()
	{
		$this->load->view('vistas_precargadas/ingles');
	}
	public function pre_fisica()
	{
		$this->load->view('vistas_precargadas/fisica');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
