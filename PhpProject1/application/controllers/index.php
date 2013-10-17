<?php

class Index extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
		$this->layout->ajouter_js("compte/compte");
		$this->layout->ajouter_js("compte/email");
		
		if(isset($this->session->userdata['idUser'])){
			redirect('dashboard','index');
		}
	}
	
	public function index() {
		$this->layout->view('index/index');
	}
	
	public function valid() {
		
		$this->layout->view('index/valid');
	}
}

?>