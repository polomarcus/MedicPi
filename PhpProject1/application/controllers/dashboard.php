<?php
/**
 * Tableau de board résumant toutes les infos
 * Température moyenne
 * Nombre d'anomalie cette semaine, mois, année...
 * Nb d'heure actif dans la maison (BD, prendre la moyenne de toutes les jours de la semaien, mois...)
 * etc..
 */

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		

		//Redirection si non connecté
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
		
		//Ajout du JS pour le graph (true pour ajout d'une url extérieure)
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
		$this->layout->ajouter_js("dashBox");

	

		//Gestion des dates pour afficher en français
		$this->load->helper('date');
		$this->load->helper('number');
		$this->load->library('form_validation');
		$this->load->model('motion_model','motionModel');
		$this->load->model('temperature_model','tempModel');
		$this->load->model('anomalie_model','anoModel');
		$this->load->model('compte_model','compteModel');
		$this->load->model('dashboard_model','dashModel');
	}

	public function index()
	{
		//Gestion Patient
		$data['nomPatient'] = "Nom Patient";
		
		//Date française pour obtenir le mois courant
		$data['date'] = date('Y-m-d'); //today
		$mois = date('n'); //ex: 1,2,3,... sans le 0
		$data['mois'] = getMoisEnFrancais($mois); //Ex: Janvier, Avril...
		$data['year'] = date('Y');
		
		$mois = date('m'); //Ex: 01, 02...

		/*****************   CURRENT MONTH      *************************/
		//Obtain the average temperature for this month
		$tabTemp = $this->tempModel->getTempOfMonth($mois);
		$data['average'] = getAverageTab($tabTemp);//Helper Number
		
		//Obtain the number of activity in the house
		$tabMotion = $this->motionModel->getMotionOfMonth($mois);
		$data['activeHour'] =  count($tabMotion);
		
		//Nombre d'anomalies
		$data['nbAno'] = floatval($this->anoModel->getCountAnoMonth($mois));
		
		//Nombre de visite
		$dash = $this->dashModel->getDashBoardDate(date('m-Y'));
		if(!empty($dash)){
			$data['nbVisit'] = floatval($dash[0]->nbVisit);
		}
		else {
			$data['nbVisit'] = 0;
		}
		
 		/*****************   LAST MONTH      ****************************/
		$lastmonth = date('m-Y', strtotime("last month")); //MM-AAAA of last month
		$lastdash = $this->dashModel->getDashBoardDate($lastmonth); //Get dashboard of the last month
		
		//@TODO: divide by 0
		if(!empty($lastdash)){//Si il y a un dernier mois en donnée alors
			$data['lastmonth'] = true; //if data exists for the lastmonth
			
			//Nombre d'heure actif
			$data['activeHourBefore'] = floatval($lastdash[0]->nbActiv);
			if($data['activeHourBefore'] != 0) {
				$data['activeHourPercent'] = percentBetween2Number($data['activeHour'],$data['activeHourBefore']);
			}
			//Température moyenne
			$data['averTempBefore'] = floatval($lastdash[0]->averTemp);
			if($data['averTempBefore'] != 0) {
				$data['averTempPercent'] = percentBetween2Number($data['average'],$data['averTempBefore']);//helper number
			}
			//Nombre de visite
			$data['nbVisitBefore'] = floatval($lastdash[0]->nbVisit);
			if($data['nbVisitBefore'] != 0) {				
				$data['nbVisitPercent'] = percentBetween2Number($data['nbVisit'],$data['nbVisitBefore']);
			}
			//Anomalie
			$data['nbAnoBefore'] = floatval($lastdash[0]->nbAno);
			if($data['nbAnoBefore'] != 0) {
				$data['nbAnoPercent'] = percentBetween2Number($data['nbAno'],$data['nbAnoBefore']);
			}
		}
		else { //there is no last month recorded
			$data['lastmonth'] = false;
		}
		
		//Récuperation données patient
		$patient = $this->compteModel->getPatient();
		$data['patient'] = $patient[0];
		
		//Ajout des vues
		$this->layout->view("dashboard/index",$data);
	}
	/**
	 * Data pour toute l'année
	 */
	public function annee()
	{
		//Gestion Patient
		$data['nomPatient'] = "Nom Patient";
		$data['year'] = date('Y');
		
		$tabMonth = getTabMonth(); //tab with 01, 02, 03... until 12
		
		//Obtain the number of activity in the house
		$cpt = 0; //pour éviter de calculer pour le mois de décembre le pourcentage
		//***********************************************************************/
		foreach($tabMonth as $month){	
			$objMotion = new stdClass(); //temporaire
			$objVisit = new stdClass(); //temporaire
			$objAno = new stdClass(); //temporaire
			$objTemp = new stdClass(); //temporaire
			
			
			//BD Motion
			$tabMotion = $this->motionModel->getMotionOfMonth($month, $data['year']);
			$objMotion->val =  count($tabMotion); //add to the tab
	
			//BD Temp
			//Obtain the average temperature for this month
			$tabTemp = $this->tempModel->getTempOfMonth($month);
			$objTemp->val = getAverageTab($tabTemp);
			
			//BD Anomalie
			$objAno->val = floatval($this->anoModel->getCountAnoMonth($month));
			
			//BD Visit
			$dash = $this->dashModel->getDashBoardMonth($month); //Obtient le mois de l'année courrante
			if(empty($dash[0]->nbVisit)){
				$objVisit->val = 0;
			}
			else {
				$objVisit->val = $dash[0]->nbVisit;
			}
			
			if($cpt > 0){ //Calcul du pourcentage
				//**************** OBTENTION DE LA PROCHAINE VALEUR ***********************************/
				//LAst Value pour connaitre le pourcentage entre la prochaine valeur et l'actuelle
				$nextmonth = getNextMonth($month);
				$lastmonth = getLastMonth($month);
				//*********************************BD Motion
				$lastMotion = $this->motionModel->getMotionOfMonth($lastmonth, $data['year']);
				$objMotion->last =  count($lastMotion); //add to the tab
				
				//*********************************BD Visit
				$lastDash = $this->dashModel->getDashBoardMonth($lastmonth); //Obtient le mois de l'année courrante
				if(empty($lastDash[0]->nbVisit)){
					$objVisit->last = 0;
				}
				else {
					$objVisit->last = $lastDash[0]->nbVisit;
				}
				//*********************************BD Temp
				//Obtain the average temperature for this month
				$tabTemp = $this->tempModel->getTempOfMonth($lastmonth);
				$objTemp->last = getAverageTab($tabTemp);
				
				//*********************************BD Ano
				$objAno->last = floatval($this->anoModel->getCountAnoMonth($lastmonth));
				
				
				//**************** CALCUL POURCENTAGE ***********************************/
				$objMotion->percent = percentBetween2Number($objMotion->val, $objMotion->last);
				$objVisit->percent = percentBetween2Number($objVisit->val, $objVisit->last);
				$objTemp->percent = percentBetween2Number($objTemp->val, $objTemp->last);
				$objAno->percent = percentBetween2Number($objAno->val, $objAno->last);
			}
			
			//Nombre de visite
			$data['nbVisitYear'][] = $objVisit;
			
			//Température moyenne
			$data['tempYear'][] = $objTemp;
			
			//Nombre d'anomalies
			$data['nbAnoYear'][] = $objAno;
			
			//Nombre d'heure d'activité
			$data['activeHourYear'][] = $objMotion;
			
			$cpt++;
		}
		
		//Récuperation données patient
		$patient = $this->compteModel->getPatient();
		$data['patient'] = $patient[0];
		
		//***********************************************************************/
		//Ajout des vues
		$this->layout->view("dashboard/annee",$data);
	}
	
}