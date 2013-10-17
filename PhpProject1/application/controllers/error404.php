<?php
class Error404 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//Redirection si non connecté
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
	}
	
	public function index()
	{
		$this->layout->view('default/404');
	}
}