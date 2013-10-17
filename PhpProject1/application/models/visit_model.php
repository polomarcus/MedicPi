<?php
class Visit_model extends CI_Model {

	var $table = 'visit'; //Table de la BD
	
	/**
	 * Add a visit into the DB
	 * @param date $date
	 * @param int $idUser
	 */

	public function addVisit($date,$idUser)
	{
	    return $this->db->set('date', $date)
	            ->set('idUser', $idUser)
	            ->insert($this->table);
	}

	function update_entry()
	{
		
	}

		
	/**
	 * @return all data about visits
	 */
	public function getVisits($nb = 10, $debut = 0)
	{
		return $this->db->select('*')
		->from($this->table)
		->limit($nb, $debut)
		->get()
		->result();
	}
	
	/**
	 * To see if a visit has already been done on specific day by a person
	 * @return data
	 */
	public function getVisitDate($date, $idUSer)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('date', $date)
		->where('idUser', $idUSer)
		->get()
		->result();
	}
	
	/**
	 * @return number of visits
	 */
	public function countVisits()
	{
		return $this->db->select('*')
		->from($this->table)
		->get()
		->num_rows();
	}
}