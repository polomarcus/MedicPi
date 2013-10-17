<?php
class Domo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//Ajout du JS pour le graph (true pour ajout d'une url extérieure)
		$this->layout->ajouter_js("http://code.jquery.com/jquery-1.9.1.js",true);
		$this->layout->ajouter_js("http://code.jquery.com/ui/1.10.2/jquery-ui.js",true);
	
		$this->layout->ajouter_js("temperature_ajax");
		$this->layout->ajouter_js("domo");

		
	
		$this->load->library('form_validation');
		
	
	}
	 
	public function index($day = 0, $month = 0, $year = 0)
	{

		//Ajout des vues
		$this->layout->view('domo/index');
	}
	
	/**
	 * Allume la prise numéro num
	
	 */
	public function prise(){
		
		$this->form_validation->set_rules('num', 'num', 'trim|required|min_length[1]|max_length[20]|encode_php_tags|xss_clean');
		
		if($this->form_validation->run())
		{
			$num = $this->input->post('num');
			
			//Voir si c'est off ou on
			$type = substr($num,0,2);
			
			if($type =="of"){
				$type = "off";
				$num = substr($num,3,1);
			}
			else {
				$type = "on";
				$num = substr($num,2,1);
			}
			
			//Répéter plusieurs fois pour être sur
			$commande = '/var/www/./scs IV' .$num .' ' . $type;
			//var_dump($commande);
			exec($commande,$output);
// 			foreach($output as $out){
// 				echo $out;
// 			}
			
			exec($commande);
			exec($commande);
			exec($commande);
			exec($commande);
			exec($commande);
			exec($commande);
			
			echo 'Done';
		}
		else {
			//exec('/var/www/./scs IV3 on');
			echo 'Echec';
		}
		
	}
}