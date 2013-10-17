<?php
class Config_model extends CI_Model {

	var $table = 'configuration'; //Table de la BD

	/**
	 * /!\ Il n'y a qu'une seule configuration pour la Raspberry Pi (càd il y a un seul id : 1)
	 * 
	 */
	
	public function getConfig()
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idConfig', 1)
		->get()
		->result();
	}
	
	/**
	 * 
	 * @return int delay before an alert
	 */
	public function getDelayAlert(){
		$delay = $this->db->select('nbHourAlert')
		->from($this->table)
		->where('idConfig', 1)
		->get()
		->result();
		
		$delay = $delay[0];
		
		return intval($delay->nbHourAlert);
	}
	
	/**
	 * @param  $timer, timer which creates an anomaly when it finishs
	 */
	public function setDelayAlert($time)
	{
		$data = array(
               'nbHourAlert' => $time,
        );

		$this->db->where('idConfig', 1); //$id par défaut
		$this->db->update($this->table, $data); 
	}
	
	/**
	 * @param  min temp
	 */
	public function setMinTemp($val)
	{
		$data = array(
				'minTemp' => $val,
		);
	
		$this->db->where('idConfig', 1); //$id par défaut
		$this->db->update($this->table, $data);
	}
	/**
	 * @param  max temp
	 */
	public function setMaxTemp($val)
	{
		$data = array(
				'maxTemp' => $val,
		);
	
		$this->db->where('idConfig', 1); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	public function setHolidayMode($val){
	
		$data = array(
				'holiday' => $val,
		);
		
		$this->db->where('idConfig', 1); //$id par défaut
		$this->db->update($this->table, $data);
	}

}