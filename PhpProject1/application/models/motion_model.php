<?php
class Motion_model extends CI_Model {
	/**
	 * /!\ Important : 
	 * don't forget to put in php.ini of your server : date.timezone = "Europe/Brussels" for french time
	 * instead of date.timezone = UTC 
	 */
	var $table = 'motion'; //Table de la BD
	
	/**
	 * @return all the last date and time when a motion is detected
	 * @param  limit the number of return $nb
	 * @param  limit the number of return $debut
	 */
	public function getMotion($nb = 10, $debut = 0)
	{
	    return $this->db->select('*')
	            ->from($this->table)
	            ->limit($nb, $debut) 
	            ->order_by('dateMo', 'desc')
	            ->get()
	            ->result();
	}

	/**
	 * @return data according to the id
	 */
	public function getMotionById($id)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idMvt', $id)
		->get()
		->result();
	}
	
	/**
	 * @return data according to the id
	 */
	public function getMotionByIdData($idData)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idData', $idData)
		->get()
		->result();
	}
	/**
	 * @return all data on motion of the date
	 * @param  $date (AAAA-MM-JJ)
	 */
	public function getMotionDate($date)
	{
		//To obtain all day
		$first_date = $date . " " . "00:00:00";
		$second_date = $date . " " . "23:59:59";
		
		return $this->db->select('*')
		->from($this->table)
		->where('dateMo >=', $first_date)
		->where('dateMo <=', $second_date)
		->order_by('dateMo', 'desc')
		->get()
		->result();
	}
	
	/**
	 * @return all data on motion of an hour of a date
	 * @param  $date (AAAA-MM-JJ HH)
	 */
	public function getMotionHour($date)
	{
		//To obtain all day
		$first_date = $date . ":00:00";
		$second_date = $date . ":59:59";
	
		
		return $this->db->select('*')
		->from($this->table)
		->where('dateMo >=', $first_date)
		->where('dateMo <=', $second_date)
		->order_by('dateMo', 'desc')
		->get()
		->result();
	}
	
	/**
	 * @return all data on motion between 2 dates
	 * @param  $date (ex: AAAA-MM-JJ)
	 */
	public function getMotionBetweenDates($first_date, $second_date)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('dateMo >=', $first_date)
		->where('dateMo <=', $second_date)
		->get()
		->result();
	}
	
	/**
	 * @return all data on motion of the month
	 * @param  $month (ex: MM), $year (ex:AAAA)
	 */
	public function getMotionOfMonth($month, $year = 0)
	{
		//To otain the number of day in the month
		$days = date('t', $month);
		if($year == 0){
			$year = date('Y');
		}
	
		//To obtain all day
		$first_date = $year . '-' . $month . '-01' . " " . "00:00:00";
		$second_date = $year . '-' . $month . '-' . $days . " " . "23:59:59";
	
		return $this->db->select('*')
		->from($this->table)
		->where('dateMo >=', $first_date)
		->where('dateMo <=', $second_date)
		->get()
		->result();
	}
	

	/**
	 * NOT TESTED, 16/04/2013
	 * @return idData
	 * @param  $id, the id of the motion
	 */
	public function getIdData($id)
	{
		return $this->db->select('idData')
		->from($this->table)
		->where('idMvt', $id)
		->get()
		->result();
	}
	
	/**
	 * add the current date and time of a motion (ex: AAAA-MM-JJ HH:MM:SS )
	 * @return the id of motion just created
	 */
	public function addMotion()
	{
		$this->load->model('data_model','dataModel');
		$this->load->helper('date');
		
		//Gestion de Data
		$idData = $this->dataModel->addData("motion");
		
		//Insert the motion into DB
		$this->db->set('dateMo', date('Y-m-d H:i:s'))
						->set('idData', $idData)
						->insert($this->table);
		
		//ID
		return $this->db->insert_id();
	}
}