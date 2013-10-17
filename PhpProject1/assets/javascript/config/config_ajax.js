//gere l'ajax de la configuration

//Change max temp config
$('#buttomSubmitMax').click(function(){
	  //alert("clik");
   $.post("/MedicPi/configuration/changeTempMax",
    $("form").serialize(),
    function(result){	
	   
	  //Obj va contenir les données de la requete SQL contenant les heures de mouvement
	 if(result == "ok"){
		 $('#changeValueMax').show();
		 $('#maxNext').hide();
		 $('#buttomSubmitMax').hide();

		 var delay = $('#max').val(); //La valeur entrée par l'utilisateur dans le input
		 $('#maxCurrent').html(delay + " heures");

		 $('#maxCurrent').show();
		 
		 $('.reponseMax').html("Donnée mise à jour !")
		 $(".reponseMax").attr('class', 'green');
	 }
	 else {
		 $('.reponseMax').html(result)
	 }
   },"html");
});

//Change min temp config
$('#buttomSubmitMin').click(function(){
	  //alert("clik");
 $.post("/MedicPi/configuration/changeTempMin",
  $("form").serialize(),
  function(result){	
	  //Obj va contenir les données de la requete SQL contenant les heures de mouvement
	 if(result == "ok"){
		 $('#changeValueMin').show();
		 $('#minNext').hide();
		 $('#buttomSubmitMin').hide();

		 var delay = $('#min').val(); //La valeur entrée par l'utilisateur dans le input
		 $('#minCurrent').html(delay + " °C");

		 $('#minCurrent').show();
		 $('.reponseMin').html("Donnée mise à jour !")
		 $(".reponseMin").attr('class', 'green');
	 }
	 else {
		 $('.reponseMin').html(result)
	 }
 },"html");
});

//Change delay alert config
$('#buttomSubmitDelay').click(function(){
	  //alert("clik");
 $.post("/MedicPi/configuration/changeDelay",
  $("form").serialize(),
  function(result){	
	  //Obj va contenir les données de la requete SQL contenant les heures de mouvement
	 if(result == "ok"){
		 $('#changeValueDelay').show();
		 $('#delayNext').hide();
		 $('#buttomSubmitDelay').hide();

		 var delay = $('#delay').val(); //La valeur entrée par l'utilisateur dans le input
		 $('#delayCurrent').html(delay + " heures");

		 $('#delayCurrent').show();
		 $('.reponseDelay').html("Donnée mise à jour !")
		 $(".reponseDelay").attr('class', 'green');
	 }
	 else {
		 $('.reponseDelay').html(result)
	 }
 },"html");
});

//Holiday off
$('#non').click(function(){
	
	$.ajax({
	      type: "POST",
	      url: "/MedicPi/configuration/changeHoliday",
	      data: {"vac" : 0},
	      success: function(response) {
	    	  $("#reponseHoliday").html(response); 	
	    	  
	    	  
	    	  $("#non").prop("checked", true)
	    	  if(response == 'Donnée mise à jour') {
	    		  $("#reponseHoliday").attr('class', 'green');
	    	  }
	    	  else {
	    		  $("#reponseHoliday").attr('class', 'red');
	    	  } 
	      }
	     });
	    return false;
	    });


//Holiday mode on
$('#oui').click(function(){
	$.ajax({
	      type: "POST",
	      url: "/MedicPi/configuration/changeHoliday",
	      //url: '@Url.Action("configuration", "changeHoliday")',  
	         
	      data: {"vac" : 1},
	      success: function(response) {
	    	  $("#reponseHoliday").html(response); 	
	    	 // $("#non[value=Non]").attr("checked", true);
	    	  $("#oui").prop("checked", true)
	    	  if(response == 'Donnée mise à jour') {
	    		  $("#reponseHoliday").attr('class', 'green');
	    	  }
	    	  else {
	    		  $("#reponseHoliday").attr('class', 'red');
	    	  } 
	      }
	     });
	    return false;
	    });


