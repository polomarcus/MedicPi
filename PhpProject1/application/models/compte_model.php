<?php
class Compte_model extends CI_Model {

	var $table = 'compte'; //Table de la BD
	

	//->where('id', (int) $id)
	public function liste_compte($nb = 10, $debut = 0)
	{
		//test
	    return $this->db->select('*')
	            ->from($this->table)
	            ->limit($nb, $debut) 
	            ->order_by('idUser', 'desc')
	            ->get()
	            ->result();
	}

	public function ajouter_compte($login, $pwd, $mail, $role, $nom, $prenom)
	{
	    return $this->db->set('login', $login)
	            ->set('pwd', $pwd)
	            ->set('role', $role)
	            ->set('nom', $nom)
	            ->set('prenom', $prenom)
	            ->set('mail', $mail)
	            ->insert($this->table);
	}

	function update_entry()
	{
		$this->login = $_POST['login'];
		$this->pwd = $_POST['pwd'];
		$this->role = $_POST['role'];
		$this->nom = $_POST['nom'];
		$this->prenom = $_POST['prenom'];
		$this->date = time();

		$this->db->update('entries', $this, array('id' => $_POST['id']));
	}

		
	public function getCompte($pseudo)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('login', $pseudo)
		->get()
		->result();
	}
	
	public function getCompteById($id)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idUSer', $id)
		->get()
		->result();
	}
	
	public function getTempByIdData($idData)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('idData', $idData)
		->get()
		->result();
	}
	
	/**
	 * @param String login
	 */
	public function setLogin($val)
	{
		$data = array(
				'login' => $val,
		);
	
		$this->db->where('idUser', $this->session->userdata['idUser']); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	/**
	 * @param  pwd
	 */
	public function setPwd($val)
	{
		$data = array(
				'pwd' => $val,
		);
	
		$this->db->where('idUser', $this->session->userdata['idUser']); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	/**
	 * @param  nom
	 */
	public function setNom($val)
	{
		$data = array(
				'nom' => $val,
		);
		
		$this->db->where('idUser', $this->session->userdata['idUser']); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	/**
	 * @param  prenom
	 */
	public function setPrenom($val)
	{
		$data = array(
				'prenom' => $val,
		);
	
		$this->db->where('idUser', $this->session->userdata['idUser']); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	/**
	 * @param  mail
	 */
	public function setMail($val)
	{
		$data = array(
				'mail' => $val,
		);
	
		$this->db->where('idUser', $this->session->userdata['idUser']); //$id par défaut
		$this->db->update($this->table, $data);
	}
	
	/**
	 * return all emails of medics
	 */
	
	public function getMailMedic() {
		return $this->db->select('mail')
		->from($this->table)
		->where('role', "Medecin")
		->get()
		->result();
	
	}
	
	/**
	 * return patient data (only one patient)
	 */
	
	public function getPatient() {
		return $this->db->select('*')
		->from($this->table)
		->where('role', "Patient")
		->get()
		->result();
	
	}
	
	/**
	 * retunr all account not confirmed (valid = 0)
	 */
	public function getCompteToConfirm(){
		return $this->db->select('*')
		->from($this->table)
		->where('confirm', 0)
		->get()
		->result();
	}
	
	/**
	 * confirm an account
	 */
	public function ConfirmCompte($id){

		$data = array(
				'confirm' => 1,
		);
		
		$this->db->where('idUser', $id); //$id par défaut
		$this->db->update($this->table, $data);

	}
}