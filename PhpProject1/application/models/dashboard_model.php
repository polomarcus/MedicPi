<?php
class Dashboard_model extends CI_Model {

	var $table = 'dashboard'; //Table de la BD
	
	/**
	 * add a dashboard for a month (ex: MM-AAAA)
	 */
	public function addDashboard(){	
			$this->db->set('date', date('m-Y'))
			->set('nbAno', 0)
			->set('averTemp', 0)
			->set('nbActiv', 0)
			->set('nbVisit', 0)
			->insert($this->table);
	}
	
	/**
	 * @return all data about a month (number of anomalies, number of visits @ home..)
	 * @param date $date ex: 02-2013
	 */
	public function getDashBoardDate($date)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('date =', $date)
		->get()
		->result();
	}
	
	/**
	 * @return all data about a month (number of anomalies, number of visits @ home..)
	 * @param date $date ex: 02-2013
	 */
	public function getDashBoardMonth($month, $year = 0)
	{
		if($year == 0){
			$year = date('Y');
		}
	
		$date = $month . '-' . $year ;

		return $this->db->select('*')
		->from($this->table)
		->where('date =', $date)
		->get()
		->result();
	}
	

	/**
	 * @param  current value ++
	 */
	public function setnbAno()
	{
		$date = date('m-Y');
		$currentValue = $this->getDashBoardDate($date);
		$currentValue = $currentValue[0]->nbAno;
		
		$data = array(
				'nbAno' => $currentValue+1,
		);
	
	
		$this->db->where('date', $date);
		$this->db->update($this->table, $data);
	}
	
	/**
	 * @param  min temp
	 */
	public function setaverTemp($val)
	{
		$date = date('m-Y');
		
		//Obtain the current value 
		$currentValue = $this->getDashBoardDate($date);
		$currentValue = floatval($currentValue[0]->averTemp); //@TODO: TESTER !!!
		
		//Cast in float
		$val = floatval($val);
		
		$val = ($currentValue + $val)/2; //Average of the new & current value
		
		$data = array(
				'averTemp' => $val,
		);
	
		$this->db->where('date', $date);
		$this->db->update($this->table, $data);
	}
	/**
	 * @param  currentvalue++;
	 */
	public function setnbActiv()
	{
		$date = date('m-Y');
		$currentValue = $this->getDashBoardDate($date);
		$currentValue = $currentValue[0]->nbActiv; 
		$data = array(
				'nbActiv' => $currentValue+1,
		);

		$this->db->where('date', $date);
		$this->db->update($this->table, $data);
	}

	/**
	 * inscrease the number of visite by one
	 */
	public function setnbVisit()
	{
		$date = date('m-Y');
		$currentValue = $this->getDashBoardDate($date);
		$currentValue = $currentValue[0]->nbVisit;
		
		$data = array(
				'nbVisit' => $currentValue+1,
		);
		
		$this->db->where('date', $date);
		$this->db->update($this->table, $data);
	}
}