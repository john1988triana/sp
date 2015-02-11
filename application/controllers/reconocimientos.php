<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Reconocimientos extends CI_Controller {
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
		$this->load->view("header");
		$this->load->view("reconocimientos/reconocimientos");
		$this->load->view("footer");
	}
}
/* Location: ./application/controllers/clases-particulares.php */