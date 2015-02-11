<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Terminos extends CI_Controller {
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
		$this->load->view("header.php");
		$this->load->view("terminos/terminos");
		$this->load->view("footer.php");
	}
}
/* End of file clases-particulares.php */
/* Location: ./application/controllers/clases-particulares.php */