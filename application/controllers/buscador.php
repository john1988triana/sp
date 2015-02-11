<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Buscador extends CI_Controller {

	private $campos;
	private $bd_content;
	private $resultados;
	private $sUrlGoogle; 

	public function __construct() {
		parent::__construct();
		$this->load->database('superpro', TRUE);
		$this->load->model('model_superprofe');
		$this->load->library('aulasamigas');		
	}
	public function index(){
		$area = $this->input->get("area");
		$topic =  $this->input->get("topic");
		$level =  $this->input->get("level");
		$city = $this->input->get("city");
		$address = $this->input->get("address");
		$date = $this->input->get("date");
		$time = $this->input->get("time");
		$phone = $this->input->get("phone");
		$datos = array(
			"areas" => $this->aulasamigas->getAreasByContent('768'),
			"cities" => $this->aulasamigas->getCitiesByCountry('COL'),
			"levels" => $this->model_superprofe->getLevels(),
			"area" => $area,
			"topic" => $topic,
			"city" => $city,
			"address" => $address,
			"date" => $date,
			"time" => $time,
			"level" => $level,
			"phone"=> $phone,
			"errors"=>"",
			"message" => "");
		$this->load->view('busqueda/view_search_form', $datos);
	}
	
}
/* Location: ./application/controllers/busqueda.php */