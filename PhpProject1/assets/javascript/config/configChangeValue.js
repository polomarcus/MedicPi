//Gere l'affichage du formulaire de changmeent de configuration
$(document).ready(function(){
	//Max
	$('#buttomSubmitMax').hide();
	$('#maxNext').hide();
	 //Min
	$('#buttomSubmitMin').hide();
	$('#minNext').hide();
	 //Delay
	$('#buttomSubmitDelay').hide();
	$('#delayNext').hide();
	
	//Max
	 $('#changeValueMax').click(function(){
		 $('#changeValueMax').hide();
		 $('#maxCurrent').hide();
		 $('#buttomSubmitMax').show();
		 $('#maxNext').show();
	 });
	 
	 //Min
	 $('#changeValueMin').click(function(){
		 $('#changeValueMin').hide();
		 $('#minCurrent').hide();
		 $('#buttomSubmitMin').show();
		 $('#minNext').show();
	 });
	 
	 //Delay
	 $('#changeValueDelay').click(function(){
		 $('#changeValueDelay').hide();
		 $('#delayCurrent').hide();
		 $('#buttomSubmitDelay').show();
		 $('#delayNext').show();
	 });
});
