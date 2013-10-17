$(document).ready(function(){
	
	generateDataMotion();
	
	function createGraphicMotion(data, dateMvt){
		/** GRAPHIQUE MOUVEMENT **/
		$('#container2').highcharts({
	            chart: {
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	                text: 'Mouvement',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Détection faite par un capteur placé dans l\'appartement',
	                x: -20
	            },
	            xAxis: {
	                categories: dateMvt //Tableau de date qu'on a rempli plus haut comme des grands dans traiteResponse
	            },
	            yAxis: {
	                title: {
	                    text: 'Mouvement (oui ou non)'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                valueSuffix: 'Mouvement detecté'
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: [{
	                name: 'Mouvement',
	                data: data //Tableau de température 
	            }]
	        });  
		}

	function generateDataMotion(){
		  $.post("/MedicPi/data/getMotionDate",
				    $("form").serialize(),
				   function(result){
					  //Gestion affichage date
					  date = $("#datepicker").val(); 
					 
					  
					  //Obj va contenir les données de la requete SQL contenant les heures de mouvement
					var obj = jQuery.parseJSON(result);
					  //Xaxis
					var dateMvt = new Array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23'); //tableau des dates/heures
					  //Yaxis
					var data = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //tableau des valeurs Oui ou(1) non(0)

					for (i = 0; i< obj.length; i++) { 	/* ligne.length nombre d'element du tableau*/
						//console.log(obj[i]);					
						data[parseFloat(obj[i].dateMo.substr(11,2))] = 1; //On met 1 dans le tableau de données à l'index de l'heure (exemple : mouvement à 12 alors on insère 1 à data[12]
					}
						
					createGraphicMotion(data, dateMvt);
						
		  },"html");	
	}
		  
	  $('#datepicker').change(function(){
		  generateDataMotion();
	  });   
	 
});