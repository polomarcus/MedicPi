<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('convertDate'))
{
	/**
	 * convertir une date du français a l'anglais
	 * @param date format françase : JJ/MM/AAAA $date
	 * @return date format anglais : AAAA/MM/JJ
	 */
	function convertDateEng($date)
	{
		$tabDate = explode('-' , $date);
		$enDate  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
		return $enDate;
	}
	
	/**
	 * convertir une date de l'anglais en français
	 * @param date format anglais : AAAA-MM-JJ HH:MM:SS
	 * @return date format françase : JJ/MM/AAAA $date
	 */
	function convertDateFr($date)
	{
		$date = strtr($date,"-","/");
		
		$tabDate = explode('/' , $date);
		$tabTmp = explode(' ' , $tabDate[2]);
		$day = $tabTmp[0];
		
		if(!empty($tabTmp[1])){ //gestion heure
			$heure = $tabTmp[1];//non utilisé
		}
		$enDate  = $day .'/'.$tabDate[1].'/'. $tabDate[0];
		return $enDate;
	}
	
	/**
	 * @return Janvier si 01 en paramètre, Fevrier si 02 etc.
	 * @param int $chiffreMois, ex: 01, 02, 03...
	 */
	function getMoisEnFrancais($chiffreMois){

		$mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
		return $mois_fr[$chiffreMois];
	}
	
	/**
	 * @return un tableau contenant 01,02,03....
	 * @param 
	 */
	function getTabMonth(){
		$tabMonth = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		return $tabMonth;
	}
	
	/**
	 * @return le mois suivant, intput 02 output: 03
	 * @param month
	 */
	function getNextMonth($month){
		$currentMonth = intval($month);
		if($currentMonth > 8){
			if($currentMonth > 11){
				return '01';
			}
			
			return strval($currentMonth + 1);
		}
		else{
			return '0' . ($currentMonth + 1);
		}
	}
	/**
	 * @return le mois suivant, intput 02 output: 03
	 * @param month
	 */
	function getLastMonth($month){
		$currentMonth = intval($month);
		if($currentMonth == 1){
				return '12';
		}
		
		if($currentMonth > 10){
			return strval($currentMonth - 1);
			
		}
		else{
			return '0' .  ($currentMonth - 1);
		}
	}
}