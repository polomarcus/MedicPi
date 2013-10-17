<?php
class Data extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//Ajout du JS pour le graph (true pour ajout d'une url extérieure)
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
		

		$this->layout->ajouter_js("http://code.highcharts.com/highcharts.js",true);
		$this->layout->ajouter_js("temperature_ajax");
		$this->layout->ajouter_js("motion");
		$this->layout->ajouter_js("datePicker");
		$this->layout->ajouter_js("datepickerFr");
		//DatePickerCSS
		$this->layout->ajouter_css("http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css",true);
		
		//Gestion des dates pour afficher en français
		$this->load->helper('date');
		$this->load->library('form_validation');
		
		//BD
		$this->load->model('motion_model','motionModel');
		$this->load->model('temperature_model','tempModel');
		$this->load->model('anomalie_model','anoModel');
		$this->load->model('dashboard_model','dashModel');
		$this->load->model('compte_model','compteModel');
	}
	 
	public function index($day = 0, $month = 0, $year = 0)
	{
		//Redirection si non connecté
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
		
		//En ajax récupéré la valeur de la date et envoyé ça à la vue par data
		//Par défaut on dit que la date est aujourd'hui
		if(empty($day)){
			$data['date'] = date('Y-m-d'); //today
			//Date française	
			$data['date'] = convertDateFr($data['date']);
		}
		else {
			$data['date'] = $day . "/" . $month . "/" . $year;
		}

		//Ajout des vues
		$this->layout->views("data/form_motion",$data);
		$this->layout->views("data/motion",$data);
		$this->layout->view("data/temperature");
	}
	
	/**
	 * write into BD a motion date
	 * used by a wget + the website adress command :  ./capteurMvtWGET http://localhost/MedicPi/data/addMotion/ 0
	 * 0 is the pin used for the motion sensor
	 * we can consider to use a token to protect the writting
	 * @param  $token protect the writting of the data
	 * 
	 */
	//@TODO: 
	public function addMotion($token = 0){ //Ou $state
		if($token == 0){
			//Eviter que l'heure soit enregistré 2 fois
			$alreadyExist = $this->motionModel->getMotionHour(date('Y-m-d H')); //AAAA-MM-DD HH
			$alreadyExist = $alreadyExist[0];
		
			
			if(empty($alreadyExist)){
				echo 'Ajout du mouvement';
				$this->existDashboardMonth(); //Gestion Dashboard
				$this->dashModel->setnbActiv(); //increase the number of motion by one for a dashboard of the month.
				$this->motionModel->addMotion();
			}
			else {
				echo 'Mouvement déjà enregistré pour cette heure';
			}
		}
	}
	
	/**
	 * write into BD a motion date
	 * http://localhost/MedicPi/data/addTemp/6 for example
	 * @param  $token protect the writting of the data
	 */
	public function addTemp($val, $token = 0){
		//A CHANGER pour les min et max
		$this->load->model('config_model','configModel');
		$config = $this->configModel->getConfig();
		$config = $config[0];

		$MIN = $config->minTemp;  
		$MAX = $config->maxTemp;  
		
		//@TODO: A CHANGER pour token
		if($token == 0 && isset($val)){ 
			
			//@TODO: Avoid Spams
// 			//Last time we had a temp : to avoid SPAM
// 			$lastData = $this->tempModel->getTemp(1); //Prend seulement la dernière info
// 			$lastData = $lastData[0];
// 			var_dump($lastData);
// 			$lastanomalies = $this->anoModel->getAnomalies(5);
// 			var_dump($lastanomalies);
			

			
			$idTemp = $this->tempModel->addTemp($val); //enregistrement dans la BD
			$idData = $this->tempModel->getIdData($idTemp);
			
			//Gestion dashboard du mois
			$this->existDashboardMonth();
			$this->dashModel->setaverTemp($val); //increase the number of motion by one for a dashboard of the month.
		
			
			//MODE HOLIDAY
			$holiday = $this->configModel->getConfig();
			$holiday = $holiday[0];
			
			if($holiday->holiday == 0){ //NOT ON HOLIDAYS
				$holiday->holiday = false;
			}
			else {
				$holiday->holiday = true;
			}
			
			if(!$holiday->holiday){
				
				if($val > $MAX){
					//RED LED
					exec('python /var/www/MedicPi/assets/program_data/alertLED.py');
					/************************************************************/
					//Anomalie température max
					$this->anoModel->addAnomalie($idData, "Il fait trop chaud");
								//Envoie des mails
					$today = date('Y-m-d H:i:s');
					$aujourdhui = convertDateFr($today);
					$heure = date('H:i');

					$message = 'Il fait chaud (' . $val . ' °C) le ' . $aujourdhui . ' à ' . $heure;
					$this->sendEmail($message); //Mails
				} 
				elseif($val < $MIN){
					//RED LED for 5 min
					exec('python /var/www/MedicPi/assets/program_data/alertLED.py');
					/************************************************************/
					//Anomalie température min
					$this->anoModel->addAnomalie($idData, "Il fait trop froid");
					//@TODO: tester et mettre un lien dans le mail vers l'anomalie pour la lire
					
					//Envoie des mails
					$today = date('Y-m-d H:i:s');
					$aujourdhui = convertDateFr($today);
					$heure = date('H:i');

					$message = 'Il fait froid (' . $val . ' °C) le ' . $aujourdhui . ' à ' . $heure;
					$this->sendEmail($message); //Mails
					
				}	
			}
			//@TODO : mettre un $boolean anomaliedetected et regroupé dans le même if le mail, la led...
		}
	}

	/** 
	 * Regarde dans la Bd si il y a des anomalies a crée
	 * en regardant dans la table Motion si il y a eu des mouvement
	 * durant une journée ou pas etc.
	 * 
	 * @TODO : petit programme python qui appel en wget cette méthode toutes les heures
	 */
	public function createAnomalyMotion(){
		//@TODO : différentes alertes sur la meme anomalie 4h, 8h, ...
		$this->load->model('config_model','configModel');
		
		$holiday = $this->configModel->getConfig();
		$holiday = $holiday[0];
		
		
		if($holiday->holiday == 0){ //NOT ON HOLIDAYS
			$holiday->holiday = false;
		}
		else {
			$holiday->holiday = true;
		}

		if(!$holiday->holiday){ //Does not create a anomaly if holiday mode
		
			/*********************************************************/
			/********* DASHBOARD ***********************/
			$this->existDashboardMonth();
			$this->dashModel->setnbAno(); //increase the number of anomaly by one for a dashboard of the month.
			
			$DELAY_ALERT = $this->configModel->getDelayAlert();
			//today
			$today = date('Y-m-d H:i:s');
			
			//last time we had motion
			$lastData = $this->motionModel->getMotion(1); //Prend seulement la dernière info
			$lastData = $lastData[0];
			
			//Différence entre les 2 dates
			$d1 = new DateTime($today);
			$d2 = new DateTime($lastData->dateMo);
			$diff = $d1->diff($d2); //$diff contient   public 'y' => int 0
													//   public 'm' => int 0
													//   public 'd' => int 4
													//   public 'h' => int 22
													//   public 'i' => int 54
													//   public 's' => int 58
													//   public 'invert' => int 1
													//   public 'days' => int 4
			
			$aujourdhui = convertDateFr($today);
			
			//Si il existe une anomalie avec l'id Date de la donnée mouvement
			$tmp = $this->anoModel->getAnomalieByIdData($lastData->idData);
			$newAnomaly = (empty($tmp)); 
			
			if($diff->h > $DELAY_ALERT && $newAnomaly){ //We create a new anomaly
				//RED LED
				exec('python /var/www/MedicPi/assets/program_data/alertLED.py');
				/************************** DB ***************************/
				//Add to the DB the new anomaly
				$this->anoModel->addAnomalie($lastData->idData, "Pas de mouvement depuis " .
						 $diff->h ." heures le " . $aujourdhui);
				
				/********* Sending a Email or a SMS ***********************/
				//@TODO: tester et mettre un lien dans le mail vers l'anomalie pour la lire
				
				//Récupération emails de toutes les medecins
				$emails = $this->compteModel->getMailMedic();
				
				//Récuperation données patient
				$patient = $this->compteModel->getPatient();
				$patient = $patient[0];

				//Envoie des mails
				$message = 'il n\'y a plus de mouvement depuis ' . $diff->h . ' heures';
				$this->sendEmail($message); //Mails
				
	// 			/*********************************************************/
	// 			/********* DASHBOARD ***********************/
				$this->existDashboardMonth();
				$this->dashModel->setnbAno(); //increase the number of anomaly by one for a dashboard of the month.
			}
		}
	}
	
	/**
	 * function called with ajax in motion.js
	 * python scriptTempWget.py
	 * @return a tab with the ID and the date of motions
	 */
	public function getMotionDate(){
		//$dateMvt = "2013-04-07"; //Ce format là pour la BD
		$this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[20]|encode_php_tags|xss_clean');

		if($this->form_validation->run())
		{
			$data['date'] = $this->input->post('date');
			$dateMvt = $this->input->post('date');
			$dateMvt = strtr($dateMvt,"/","-"); //Transforme la date en JJ-MM-AAAA au lieu de JJ/MM/AAAA
			$dateMvt = convertDateEng($dateMvt); //Transforme la date Fr en English (AAAA-MM-JJ) pour l'appel à la BD
			
			$data['dateMotion'] = $this->motionModel->getMotionDate($dateMvt);		
		}
		else{ //Erreur formulaire
			$data['dateMotion'] = -1;
		}

		echo  json_encode($data['dateMotion']);
	}
	
	/**
	 * function called with ajax in motion.js
	 * python scriptTempWget.py
	 * @return a tab with the ID and the date of motions
	 */
	public function getTempDate(){
		//$dateMvt = "2013-04-07"; //Ce format là pour la BD
		$this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[20]|encode_php_tags|xss_clean');
	
		if($this->form_validation->run())
		{
			$data['date'] = $this->input->post('date');
			$date = $this->input->post('date');
			$date = strtr($date,"/","-"); //Transforme la date en JJ-MM-AAAA au lieu de JJ/MM/AAAA
			$date = convertDateEng($date); //Transforme la date Fr en English (AAAA-MM-JJ) pour l'appel à la BD
				
			$dataTmp = $this->tempModel->getTempDate($date);
		}
		else{
			$dataTmp = 0;
			$date = "Erreur...";
		}
	
		echo  json_encode($dataTmp);
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
	
	/**
	 * send a email to all medics of the patient
	 * @param string $message
	 */
	private function sendEmail($message){
		
		//Config email
		$headers = 'From: no-reply@medicpi.fr' . "\r\n";
		$headers ='From: "Medic Pi"<no-reply@medicpi.fr>'."\n";
		$headers .='Content-Type: text/plain; charset="UTF-8"\r\n'; 
		$headers .='Content-Transfer-Encoding: 8bit';
		
		//Récupération emails de toutes les medecins
		$emails = $this->compteModel->getMailMedic();
		
		//Récuperation données patient
		$patient = $this->compteModel->getPatient();
		$patient = $patient[0];
		
		//Envoie des mails
		//Adresse déveoppeur
		//$ok = mail('paleclercq@gmail.com', 'Nouvelle anomalie chez ' . $patient->prenom . ' ' . $patient->nom, 'Bonjour,' . "\n" . $message . ' chez ' . $patient->prenom . ' ' . $patient->nom . '.' . "\n" . 'Bien à vous, Medic Pi.', $headers);
// 		if($ok){
// 			echo 'mail envoyé';
// 		}
// 		else {
// 			echo 'erreur email';
// 		}
		
		foreach($emails as $email){
			//Vraies adresses email des medecins
			$ok = mail($email->mail, 'Nouvelle anomalie chez ' . $patient->prenom . ' ' . $patient->nom, 'Bonjour,' . "\n" . $message . ' chez ' . $patient->prenom . ' ' . $patient->nom . '.' . "\n\n" . 'Bien à vous,' . "\n" . 'Medic Pi.', $headers);
			//Débuge MODE
// 			if($ok){
// 				echo 'Mail sent to ' . $email->mail . '\n';
// 			}
// 			else {
// 				echo 'Erreur email : ' . $email->mail . '\n';
// 			}
			
		}
	}
	
}