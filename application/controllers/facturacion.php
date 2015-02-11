<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Facturacion extends CI_Controller {

		public function __construct() {
		parent::__construct();

			//$this->load->database('superpro', TRUE);
			$this->load->model('model_superprofe');
			$this->load->library('form_validation');
			$this->load->library('aulasamigas');		
		}

		public function index(){
			$this->load->view('facturacion/view_billing');
		}
	}