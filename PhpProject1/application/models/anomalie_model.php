<?php
class Anomalie_model extends CI_Model {

	var $table = 'anomalie'; //table BD
	
	/**
	 * 
	 * @param unknown_type $nb
	 * @param unknown_type $debut
	 * @return toutes les anomalies
	 */
	public function getAnomalies($nb = 10, $debut = 0)
	{
	   $this->load->helper('date');
	   $this->load->model('data_model','dataModel');
	   $this->load->model('temperature_model','tempModel');
	   $this->load->model('motion_model','motionModel');
	   
	   //Récupération des infos des anomalies
	   $anomalies =  $this->db->select('*')
	            ->from($this->table)
	            ->limit($nb, $debut) 
	            ->order_by('idAno', 'desc')
	            ->get()
	            ->result();
	   
	   //On ajout les infos supplémentaires à l'anomalie selon $idData
	   foreach($anomalies as $ano){
	   	$var = $this->dataModel->getDataByID($ano->idData);
	   	$model = $var[0]->type;
	   	
	   	$ano->type = $var[0]->type; //Ajout du type à l'anomalie
	   	
	   	if($model == "motion"){
	   		$dataMotion = $this->motionModel->getMotionByIdData($ano->idData);
	   		$dataMotion[0]->dateMo = convertDateFr($dataMotion[0]->dateMo);
	   		$ano->data = $dataMotion[0]; //Ajout des données sur la température
	   	}
	   	elseif($model == "temperature"){
	   		$dataTemp = $this->tempModel->getTempByIdData($ano->idData);
	   		$dataTemp[0]->dateTmp = convertDateFr($dataTemp[0]->dateTmp);
	   		$ano->data = $dataTemp[0]; //Ajout des données du mouvement
	   	} 	
	   }
	   
	   return $anomalies;
	}
	
	/**
	 * @return data according to the id
	 */
	public function getAnomalieByIdData($idData)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idData', $idData)
		->get()
		->result();
	}
	
	/**
	 * @return number of anomalie
	 */
	public function count_anomalie()
	{
		return $this->db->select('*')
		->from($this->table)
		->get()
		->num_rows();
	}
	
	/**
	 * add one anomalie, NOT TESTED 16/04/2013
	 * @return the id just created
	 */
	public function addAnomalie($idData, $description)
	{	
		//Insert the anomalie into DB
		$this->db->set('idData', $idData)
				 ->set('description', $description)
		->insert($this->table);
	
		//ID
		return $this->db->insert_id();
	}
	
	/**
	 * Return the number of anomalies for the month of the year
	 * @param unknown_type $month
	 * @param unknown_type $year
	 */
	public function getCountAnoMonth($month, $year = 0)
	{
		if($year == 0){
			$year = date('Y');
		}
		
		//To otain the number of day in the month
		$days = date('t', $month);
		
		//All day of the month
		$first_date = $year . '-' . $month . '-01' . " " . "00:00:00";
		$second_date = $year . '-' . $month . '-' . $days . " " . "23:59:59";
		
		
		$this->load->helper('date');
		$this->load->model('data_model','dataModel');
		$this->load->model('temperature_model','tempModel');
		$this->load->model('motion_model','motionModel');
		
		//Récupération des infos des anomalies
		$anomalies =  $this->db->select('*')
		->from($this->table)
		->order_by('idAno', 'desc')
		->get()
		->result();
		
		//On ajout les infos supplémentaires à l'anomalie selon $idData
		foreach($anomalies as $ano){
			$var = $this->dataModel->getDataByID($ano->idData);
			$model = $var[0]->type;
			 
			$ano->type = $var[0]->type; //Ajout du type à l'anomalie
			 
			if($model == "motion"){
				$dataMotion = $this->motionModel->getMotionBetweenDates($first_date,$second_date);
			}
			elseif($model == "temperature"){
				$dataTemp = $this->tempModel->getTempBetweenDates($first_date,$second_date);
			}
		}
		
		return count($dataTemp) + count($dataMotion);	
	}
}