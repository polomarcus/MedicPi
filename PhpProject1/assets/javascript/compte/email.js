$(document).ready(function(){

	function VerifMail(mail)
    { 
		var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

		return(reg.test(mail));	
    }
	
	//Vérife si un pseudo existe déjà
	$('#mailIns').keyup(function(){
			if(VerifMail($('#mailIns').val())){
				$("#responseMailIns").attr('class', 'green');
				$('#responseMailIns').html('Email valide')
				 
			}
			else {
				$("#responseMailIns").attr('class', 'red');
				$('#responseMailIns').html('Email non valide')
			}
		});
	
	});
