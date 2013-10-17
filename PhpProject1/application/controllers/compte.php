<?php
class Compte extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		
		$this->layout->ajouter_js("plugin/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("plugin/jquery-ui.js",true);

		$this->load->library('form_validation');
		
		$this->load->library('encrypt');
		$this->load->model('compte_model','compteModel');	

	}
	 
	/**
	 * /!\Permet de modifier les infos du compte ("Modifier son compte")
	 */
	public function index()
	{			
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
			
		$this->form_validation->set_rules('login', 'login', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('pwd', 'pwd', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('nom', 'nom', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('prenom', 'prenom', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('mail', 'mail', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
	
		if($this->form_validation->run())
		{
			$login = $this->input->post('login');
			$pwd = $this->input->post('pwd');
			$cPwd = $this->input->post('cPwd');
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$mail = $this->input->post('mail');
		
			
			if(isset($login) && $login != ''){
				$this->compteModel->setLogin($login);
				$this->session->unset_userdata(array('login' => '')); //delete data on session
				$this->session->set_userdata('login', $login); //add new one
			
			}
			
			if(isset($nom)  && $nom != ''){
				$this->session->unset_userdata(array('nom' => '')); //delete data on session
				$this->session->set_userdata('nom', $nom);
				$this->compteModel->setNom($nom);
			}
			
			if(isset($prenom) && $prenom != ''){
				$this->session->unset_userdata(array('prenom' => '')); //delete data on session
				$this->session->set_userdata('prenom',$prenom);
				$this->compteModel->setPrenom($prenom);
			}
			
			if(isset($pwd) && $pwd != ''){
				$pwdcrypt = $this->encrypt->encode($pwd);
				$this->compteModel->setPwd($pwdcrypt);
			}
			
			if(isset($mail) && $mail != ''){
				$this->compteModel->setMail($mail);
			}
			
			redirect('compte','index');
		}

		//Get DB
		$data['compte'] = $this->compteModel->getCompte($this->session->userdata['login']);
		$data['compte'] = $data['compte'][0];
		
		$this->layout->view('compte/index',$data);			
	}
	
	public function connexion()
	{
		//  Chargement de la bibliothèque
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('login', '"Nom d\'utilisateur"', 'trim|required|min_length[1]|max_length[30]|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('pwd',    '"Mot de passe"',       'trim|required|min_length[1]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
			
		if($this->form_validation->run())
		{
			//  Le formulaire est valide
			$login = $this->input->post('login');
			$pwd = $this->input->post('pwd');

			//récup verifi du mdp dans la BD
			$compte = $this->compteModel->getCompte($login);
			if(!empty($compte[0])){
				$compte = $compte[0];
				
				//Décodage du crypté
				$result = $this->encrypt->decode($compte->pwd);


				if($this->encrypt->decode($compte->pwd) == $pwd){

					//Si le compte a été validé par l'administrateur
					if($compte->confirm == 1){
						//Création session
						$this->session->set_userdata('login', $login);
						$this->session->set_userdata('nom', $compte->nom);
						$this->session->set_userdata('prenom', $compte->prenom);
						$this->session->set_userdata('role', $compte->role);
						$this->session->set_userdata('idUser', $compte->idUser);
						$login = $this->session->userdata['login'];
						echo 'Connexion réussie !';
						//redirect('dashboard','index');
					}
					else{ // non validé par l'admin
						echo 'Compte non validé';
					}
				}	
				else {
					echo('Mauvais mot de passe');
				}	
			}
			else { //Ce compte n'existe pas				
				echo 'Ce compte n\'existe pas';
			}
			
		
			//redirect('');
		}
		else
		{
			//  Le formulaire est invalide ou vide
			echo'Erreur formulaire';
			//redirect('');
		}
		
		
	}
	
	public function deconnexion()
	{
		if(!isset($this->session->userdata['idUser'])){
			redirect('index','index');
		}
		//  Detruit la session
		$this->session->sess_destroy();
	
		//  Redirige vers la page d'accueil
		redirect('');
	}

	
	public function inscription()
	{
		$this->form_validation->set_rules('login', 'login', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('pwd', 'pwd', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');		
		$this->form_validation->set_rules('cPwd', 'cPwd', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');		
		$this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('prenom', 'prenom', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('role', 'role', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('mail', 'mail', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean|valid_email');

		if($this->form_validation->run())
		{			
			$login = $this->input->post('login');
			$pwd = $this->input->post('pwd');
			$Cpwd = $this->input->post('cPwd');
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$role = $this->input->post('role');
			$mail = $this->input->post('mail');
			
			$patient = false;
			if($role == "Patient"){
				//Already a patient ?
				$patient = $this->compteModel->getPatient();
				$patient = $patient[0];
				if(!empty($patient)){
					$patient = true;
					echo 'Un patient existe déjà';
				}
			}
			
			if(!$patient){
				if($Cpwd == $pwd){
					//Cryptage du MDP
					$pwdcrypt = $this->encrypt->encode($pwd);
						
					$this->compteModel->ajouter_compte($login, $pwdcrypt, $mail, $role, $nom, $prenom);
				}
					
				echo 'Inscription réussie';
			}
		}
		else{
			echo "Inscription ratée";
			///redirect('');
		}
	}
	
	public function getCompte(){
		$this->form_validation->set_rules('login', 'login', 'trim|required|min_length[3]|max_length[50]|encode_php_tags|xss_clean');

		if($this->form_validation->run())
		{
			
			$login = $this->input->post('login');
			
			$compte = $this->compteModel->getCompte($login);
		
			if(!empty($compte)){
				echo 'Ce login est déjà pris';
			}
			else{
				echo 'Ce login est libre';
			}
			
		}
		else {
			echo 'Trop court...';
		}
	}
	
	//Only admin can confirm an account
	public function confirmCompte(){
		
		if($this->session->userdata['role'] != "Admin"){
			redirect('index','index');
		}
		
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|min_length[1]|max_length[50]|encode_php_tags|xss_clean');
		
		if($this->form_validation->run())
		{		
			$id = $this->input->post('id');
			$this->compteModel->ConfirmCompte($id);
			echo 'Compte validé';
		}
		else {
			echo 'Echec';
		}
	}
	

}