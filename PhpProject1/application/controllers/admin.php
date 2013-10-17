<?php
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//Redirection si non connecté
		if(!isset($this->session->userdata['idUser']) && ($this->session->userdata['role'] != "Admin")){
			redirect('index','index');
		}
		
	
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
		$this->load->library('form_validation');
		$this->load->model('compte_model','compteModel');
		$this->layout->ajouter_js("admin/admin");
	}
	 
	public function index()
	{			
		//Configuration pagination
		$config['base_url'] = site_url('anomalie','index/');
		
		//Nombre d'anomalie dans la table
		$data['comptes']  = $this->compteModel->getCompteToConfirm();
		
		
		$this->layout->view('admin/index',$data);			
	}	
}