<?php
class Anomalie extends CI_Controller
{
	/**
	 * 15/04/13
	 * @TODO Un système de pagination AJAX JQuery pour toutes les anomalies classés par date
	 */
	public function __construct()
	{
		parent::__construct();

		//Redirection si non connecté
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
		
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('anomalie_model','anoModel');
		
		$this->load->library('pagination');
	}
	 
	public function index($page = 0)
	{			
		//Configuration pagination
		$config['base_url'] = site_url('anomalie','index/');
		
		//Nombre d'anomalie dans la table
		$nbAnomalie = $this->anoModel->count_anomalie();
		
		$config['total_rows'] = $nbAnomalie; //A CHANGER
		$config['per_page'] = 20;
		$config['first_link'] = '1er';
		$config['last_link'] = 'Dernier';
		$config['full_tag_open'] = '<p>';		
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = '<b>';	
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config);
		
		
		$data['anomalies'] = $this->anoModel->getAnomalies($config['per_page'], $page);
		$this->layout->view('anomalie/index',$data);			
	}	
	
	/**
	 * @TODO mettre une anomalie comme règlée ou vue ou...
	 */
	public function fix(){
		
		
	}
}