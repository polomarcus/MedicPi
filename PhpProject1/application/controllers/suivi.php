<?php

class Suivi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		//JAVASCRIPT
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
		$this->layout->ajouter_js("datePicker");
		$this->layout->ajouter_js("datepickerFr");
		//DatePickerCSS
		$this->layout->ajouter_css("http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css",true);
		
		//HELPERS
		$this->load->helper('date');
		
		//LIBRARIES
		$this->load->library('form_validation');
		
		//BD
		$this->load->model('visit_model','visitModel');
		$this->load->model('dashboard_model','dashModel');
		
		//REDIRECTION
		if(isset($this->session->userdata['idUser']) && ($this->session->userdata['role'] != "Medecin")){
			redirect('dashboard','index');
		}
	}
	
	public function index() {
		if(empty($day)){
			$data['date'] = date('Y-m-d'); //today
			//Date française
			$data['date'] = convertDateFr($data['date']);
		}
		else {
			$data['date'] = $day . "/" . $month . "/" . $year;
		}
		$data['message'] = "";
		
		$this->layout->view('suivi/index',$data);
	}
	
	/**
	 * record a visit
	 */
	public function recordVisit() {
		
		$this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[9]|max_length[11]|encode_php_tags|xss_clean');
		
		
		if($this->form_validation->run())
		{
			
			//Traitement date pour inscription BD (de JJ/MM/AAAA to AAAA-MM-DD)
			$data['date'] = $this->input->post('date');
			$date = $this->input->post('date');
			$date = strtr($date,"/","-"); //Transforme la date en JJ-MM-AAAA au lieu de JJ/MM/AAAA
			$date = convertDateEng($date); //Transforme la date Fr en English (AAAA-MM-JJ) pour l'appel à la BD
			
			//Id user
			$idUser = $this->session->userdata['idUser'];
			$data['message'] = "Visite enregistrée";
			
			//On vérifie si la visite n'a pas déjà été enregistrée
			$alreadydone = $this->visitModel->getVisitDate($date, $idUser);
		
			if(empty($alreadydone)){
				//Enregistrement visite
				$dataTmp = $this->visitModel->addVisit($date, $idUser);
				
				//Gestion du dashboard
				$this->existDashboardMonth();
				$dash = $this->dashModel->setnbVisit();
			}
			else{
				$data['message'] = "Visite déjà enregistrée";
			}
		}
		else{
			$data['message'] = "Visite non enregistrée...";
		}
	
		$this->layout->view('suivi/index',$data);
	}
	
	
	/**
	 * to see all visits 
	 */
	public function voirvisite($page = 0) {
		//DB compte
		$this->load->model('compte_model','compteModel');
		
		$this->load->library('pagination');
		
		//Configuration pagination
		$config['base_url'] = site_url('anomalie','index/');
		
		//Number of visits
		$nbvisits = $this->visitModel->countVisits();
		
		$config['total_rows'] = $nbvisits;
		$config['per_page'] = 20;
		$config['first_link'] = '1er';
		$config['last_link'] = 'Dernier';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config);
		
		//get all visits data
		$data['visits'] = $this->visitModel->getVisits($config['per_page'],$page);
		
		foreach($data['visits'] as $visite){
			//Gestion nom personnel médical
			$medic = $this->compteModel->getCompteById($visite->idUser);
			$medic = $medic[0];
			$visite->nom = $medic->nom;
			$visite->prenom = $medic->prenom;
			
			//Gestion date
			$visite->date = convertDateFr($visite->date);		
		}

		$this->layout->view('suivi/voirvisite',$data);
	}
	

	/**
	 * return false if a dashboard is not recorded for a month, then create the dashboard
	 * return true is a dashboard exist for a month
	 * @return boolean
	 */
	private function existDashboardMonth(){
		/******************        DASHBOARD     ****************************/
		//On teste si le mois a déjà été ajouté au dashboard
		$dashempty = $this->dashModel->getDashBoardDate(date('m-Y'));
		if(empty($dashempty)){ //On doit ajouter un dashboard pour ce mois
			$this->dashModel->addDashboard();
			return false; //we need to add
		}
		else { //Le mois existe déjà, on change juste les valeurs
			return true; //we need to update values
		}
	}
	
}
