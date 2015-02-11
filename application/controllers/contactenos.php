<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Contactenos extends CI_Controller {
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
		$this->load->view("header.php");
		$name = $this->input->post("name");
		$fname = $this->input->post("fname");
		$email = $this->input->post("email");
		$question = $this->input->post("question");
		$phone = $this->input->post("phone");
		if(!empty($name)){
			$this->load->view("contactenos/gracias.php");
			$template = file_get_contents(base_url("application/views/mail/contact.html"));
			$template = str_replace("{{HOST}}",base_url(),$template);
			$template = str_replace("{{NAME}}",$name,$template);
			$template = str_replace("{{LAST_NAME}}",$fname,$template);
			$template = str_replace("{{PHONE}}",$phone,$template);
			$template = str_replace("{{MAIL}}",$email,$template);
			$template = str_replace("{{QUESTION}}",$question,$template);

			$config['mailtype'] = "html";
			$this->load->library('email');
			$this->email->initialize($config);
			
			
			$this->email->from('hola@superprofe.co', 'Superprofe');
			$this->email->to('hola@superprofe.co'); 
			$this->email->subject('Superprofe.co - Contacto desde la página');
			$this->email->message($template);  
			
			$this->email->send();
		}else{
			$this->load->view("contactenos/contacto.php");
		}
		$this->load->view("footer.php");
	}
}
/* End of file como_funciona.php */
/* Location: ./application/controllers/como_funciona.php */