<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('signBeforeNumber'))
{
	/**
	 * 
	 * @param float 
	 * @return string of number with a + Ex: 13 en entrée, output +13
	 */
	function signBeforeNumber($number)
	{
		if($number > 0){
			return '+' . $number;
		}
		
		return $number; //0
	}
}

if ( ! function_exists('percentBetween2Number'))
{
	/**
	 * @param float, float
	 * @return the difference int % between 2 numbers, ex: intput 60, 14 output : -76%
	 */
	function percentBetween2Number($new, $old)
	{
		if($old != 0){
			$result = (($new - $old) / $old) * 100;
			$result = number_format($result,0, ',', ' ');//arrondi sans chiffre apèrs la virgule, ex : 1,455.76 = 1 455
			$result = signBeforeNumber($result); //helper number
			$result .= '%';
		}
		else {
			$result = ' ';
		}
		
		return $result;
	}
}

if ( ! function_exists('getAverageTab'))
{
	/**
	 * @param $tab of temp, $temp->val
	 * @return float average
	 */
	function getAverageTab($tab)
	{
		$average = 0; //average Temperature
		if(count($tab) > 0) {
			foreach($tab as $temp){
				$average += floatval($temp->val);
			}
			
			$average = $average / count($tab);
			return number_format($average,1); //Ex : '79.3' un chiffre apèrs la virgule
		}
		else {
			return 0;
		}
	}
}