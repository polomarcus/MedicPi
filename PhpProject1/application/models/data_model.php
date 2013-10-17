<?php
class Data_model extends CI_Model {

	var $table = 'data'; //Table de la BD

	/**
	 * @return the id of the new data
	 * @param  $type of data we want to add
	 */
	public function addData($type)
	{
		$this->db->set('type', $type)
				->insert($this->table);
		
		//ID
		return $this->db->insert_id();
	}
	
	public function getDataByID($id)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idData', $id)
		->get()
		->result();
	}
}