<?php
class Configuration extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//Redirection si non connecté
		if(($this->session->userdata['role'] == "Famille")){
			redirect('index','index');
		}
		
		$this->load->library('form_validation');
		$this->load->model('config_model','configModel');
		
		
	}
	/**
	 * Sert à configurer les min et max, les délais, les mots dep asse, les fmailles....
	 */
	public function index()
	{
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
		
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("config/configChangeValue");
		$this->layout->ajouter_js("config/config_ajax");
		$data['config'] = $this->configModel->getConfig();
		$data['config'] = $data['config'][0];
		
		
		$this->layout->view("configuration/index",$data);
	}

	/**
	 * fonction called with ajax in config_ajax.js
	 * set a new value for maximal temperature
	 */
	public function changeTempMax(){
		$this->form_validation->set_rules('max', 'Max', 'trim|required|min_length[1]|max_length[3]|encode_php_tags|xss_clean');

		if($this->form_validation->run())
		{
			$data['max'] = $this->input->post('max');
			$max = $this->input->post('max');
			
			$this->configModel->setMaxTemp($max);	
			echo  "ok";
		}
		else{ //@TODO: gérer les erreurs : négatifs, ... le message sera affiché directement dans la page index
			echo "ko";
		}
	}
	
	/**
	 * fonction called with ajax in config_ajax.js
	 * set a new value for min temperature
	 */
	public function changeTempMin(){
		$this->form_validation->set_rules('min', 'Min', 'trim|required|min_length[1]|max_length[3]|encode_php_tags|xss_clean');
	
		if($this->form_validation->run())
		{
			$min = $this->input->post('min');
				
			$this->configModel->setMinTemp($min);
			echo  "ok";
		} 
		else{ //@TODO: gérer les erreurs : négatifs, ... 
			echo "ko";
		}
	}
	
	/**
	 * fonction called with ajax in config_ajax.js
	 * set a new value for maximal temperature
	 */
	public function changeDelay(){
		$this->form_validation->set_rules('delay', 'Delay', 'trim|required|min_length[1]|max_length[3]|encode_php_tags|xss_clean');
	
		if($this->form_validation->run())
		{
			$time = $this->input->post('delay');
				
			$this->configModel->setDelayAlert($time);
			echo  "ok";
		}
		else{ //@TODO: gérer les erreurs : négatifs, ...
			echo "ko";
		}
	}
	
	/**
	 * fonction called with ajax in config_ajax.js
	 * set a new value for holiday mode
	 */
	public function changeHoliday(){
		$this->form_validation->set_rules('vac', 'vac', 'trim|required|min_length[1]|max_length[3]|encode_php_tags|xss_clean');
	
		if($this->form_validation->run())
		{
			$vac = $this->input->post('vac');
			
			$this->configModel->setHolidayMode($vac);
			
			echo  "Donnée mise à jour";
		}
		else{ //@TODO: gérer les erreurs : négatifs, ...
			echo "Donnée non mise à jour";
		}
	}
}