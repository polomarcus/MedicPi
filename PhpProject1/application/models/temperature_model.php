<?php
class Temperature_model extends CI_Model {

	var $table = 'temperature'; //table BD
	
	
	/**
	 * @return all the last date and time when a motion is detected
	 * @param  limit the number of return $nb
	 * @param  limit the number of return $debut
	 */
	public function getTemp($nb = 10, $debut = 0)
	{
		return $this->db->select('*')
		->from($this->table)
		->limit($nb, $debut)
		->order_by('dateTmp', 'desc')
		->get()
		->result();
	}
	
	
	/**
	 * @return data according to the id
	 */
	public function getTempByIdData($idData)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idData', $idData)
		->get()
		->result();
	}
	
	/**
	 * @return idData
	 * @param  $id, the id of the motion
	 */
	public function getIdData($id)
	{
		$idData = $this->db->select('idData')
		->from($this->table)
		->where('idTmp', $id)
		->get()
		->result();
		
		$idData = $idData[0]->idData;
		
		return intval($idData);
	}
	
	public function liste_anomalie($nb = 10, $debut = 0)
	{
		//On doit appeler le model de temperature ou motion pour accèder à leur info
		//On retourne un putain de gros tableau contenant toutes les infos
		//if(type == YYY)...
		
		
	    return $this->db->select('*')
	            ->from($this->table)
	            ->limit($nb, $debut) 
	            ->order_by('idAno', 'desc')
	            ->get()
	            ->result();
	}
	
	/**
	 * @return all data on motion of the date
	 * @param  $date (ex: AAAA-MM-JJ)
	 */
	public function getTempDate($date)
	{
		//To obtain all day
		$first_date = $date . " " . "00:00:00";
		$second_date = $date . " " . "23:59:59";
	
		return $this->db->select('*')
		->from($this->table)
		->where('dateTmp >=', $first_date)
		->where('dateTmp <=', $second_date)
		->order_by('dateTmp', 'asc')
		->get()
		->result();
	}
	
	/**
	 * @return all data on motion between 2 dates
	 * @param  $date (ex: AAAA-MM-JJ)
	 */
	public function getTempBetweenDates($first_date,$second_date)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('dateTmp >=', $first_date)
		->where('dateTmp <=', $second_date)
		->get()
		->result();
	}
	/**
	 * @return all data on motion of the month
	 * @param  $month (ex: MM)
	 */
	public function getTempOfMonth($month)
	{
		//To otain the number of day in the month
		$days = date('t', $month);
		$year = date('Y');
		
		//To obtain all day
		$first_date = $year . '-' . $month . '-01' . " " . "00:00:00";
		$second_date = $year . '-' . $month . '-' . $days . " " . "23:59:59";
		
		return $this->db->select('val')
		->from($this->table)
		->where('dateTmp >=', $first_date)
		->where('dateTmp <=', $second_date)
		->order_by('dateTmp', 'desc')
		->get()
		->result();
	}
	
	/**
	 * addTemp
	 * @return the id just created
	 */
	public function addTemp($val)
	{	
		$this->load->model('data_model','dataModel');
		$this->load->helper('date');
		
		//Gestion de Data
		$idData = $this->dataModel->addData("temperature");
		
		//Insert the temperature into DB
		$this->db->set('idData', $idData)
				 ->set('val', $val)
				 ->set('dateTmp', date('Y-m-d H:i:s'))
		->insert($this->table);
	
		//ID
		return $this->db->insert_id();
	}
	
}