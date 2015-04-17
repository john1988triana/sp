<?php
/* title: login
 * Clase login .
 *
 * Author: DJ
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Manuales extends CI_Controller {
	/* function: __construct
     * 
	 */    
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('user_agent');
		$this->load->library('aulasamigas');
		date_default_timezone_set("America/Bogota");
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

	public function hora()
	{			
		echo date('d-m-Y H:i:s');
		echo date("r")."<br>";
		echo date("G:H:s")."<br>";
		echo date("F j, Y, g:i a")."<br>";                 // March 10, 2001, 5:16 pm
		echo date("m.d.y")."<br>";                         // 03.10.01
		echo date("j, n, Y")."<br>";                       // 10, 3, 2001
		echo date("Ymd")."<br>";                           // 20010310
		echo date('h-i-s, j-m-y, it is w Day')."<br>";     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
		echo date('\i\t \i\s \t\h\e jS \d\a\y.')."<br>";   // it is the 10th day.
		echo date("D M j G:i:s T Y")."<br>";               // Sat Mar 10 17:16:18 MST 2001
		echo date('H:m:s \m \i\s\ \m\o\n\t\h')."<br>";     // 17:03:18 m is month
		echo date("H:i:s")."<br>";                         // 17:16:18
		echo date("Y-m-d H:i:s")."<br>";
		echo date("e");
		echo "<p id='demo'></p>";
		$hora = time();
		echo $hora;
		echo "<script>document.getElementById('demo').innerHTML = Date();</script>";   
		echo "----------------------<br>";
		echo timezones('UM5')."<br>";
		
	}

	public function index() {
		$this->load->view("header");
		$this->load->view("manuales/index");
		$this->load->view("footer");
	}
}
/* Location: ./application/controllers/clases-particulares.php */