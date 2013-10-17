$(document).ready(function(){
	
	//Auto load par rapport à la date du jour
	generateData();
	
	//Chercher les données dans la BD et appel la fonction createGraphic avec ces données
	function generateData(){
		 $('#loadData').show(); //Loading animation
		$.post("/MedicPi/data/getTempDate",
			    $("form").serialize(),
			    function(result){
				     
				  date = $("#datepicker").val(); 
				 // $('#dateMvt').html(date); //Gestion affichage date
				  		
				  //Obj va contenir les données de la requete SQL contenant les heures de mouvement
				  var obj = jQuery.parseJSON(result);
	
				  var dateTemp = new Array(); //tableau des dates/heures
				  var temp = new Array(); //tableau des valeurs du capteurs de température
				  
					for (i = 1; i< obj.length; i++) { 	/* ligne.length nombre d'element du tableau*/				
						dateTemp.push(obj[i].dateTmp.substr(10,6));
						temp.push(parseFloat(obj[i].val));
					}		
					//Création du graphique
					createGraphic(dateTemp,temp);
					 $('#loadData').hide();
						//$("#motion").html(obj.idMvt.toString());  //test
			   },"html");	
	}

		  
	  //Quand une date est choisi dans le calendrier
	  //On crée 2 tableaux contenant les dates et les valeurs
	  $('#datepicker').change(function (){	
		  generateData();
	  }); 
	 
	  
	  /** GRAPHIQUE TEMPERATURE **/
	  function createGraphic(dateTemp, temp){
		  
			$('#container').highcharts({
		            chart: {
		                type: 'line',
		                marginRight: 130,
		                marginBottom: 25
		            },
		            title: {
		                text: 'Température',
		                x: -20 //center
		            },
		            subtitle: {
		                text: 'Capteur DS18B20',
		                x: -20
		            },
		            xAxis: {
		                categories: dateTemp //Tableau de date qu'on a rempli plus haut comme des grands dans traiteResponse
		            },
		            yAxis: {
		                title: {
		                    text: 'Temperature (°C)'
		                },
		                plotLines: [{
		                    value: 0,
		                    width: 1,
		                    color: '#808080'
		                }]
		            },
		            tooltip: {
		                valueSuffix: '°C'
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
		                name: 'Chez le patient',
		                data: temp //Tableau de température 
		            }]
		        });  
	  }
	  
});