$(document).ready(function(){

	
	//Vérife si un pseudo existe déjà
	$('#loginIns').keyup(function(){
		login = $('#loginIns').val();
		$('#responseLogIns').hide();
		$('#loadLogin').show();
		$.ajax({
		      type: "POST",
		      url: "/MedicPi/compte/getCompte",
		      data: {"login" : login },
		      success: function(response) {
		    	  $('#loadLogin').hide();
		    	  $("#responseLogIns").html(response); 	
		    	  $('#responseLogIns').show();
		    	  if(response == 'Ce login est libre') {
		    		  $("#responseLogIns").attr('class', 'green');
		    	  }
		    	  else {
		    		  $("#responseLogIns").attr('class', 'red');
		    	  } 
		      }
		     });
		    return false;
		    });

	//Connexion
	$('#submitLogin').click(function(){
		login = $('#login').val();
		pwd = $('#pwd').val();
		$.ajax({
		      type: "POST",
		      url: "/MedicPi/compte/connexion",
		      data: {"login" : login, "pwd" : pwd},
		      success: function(response) {
		    	  if(response == "Connexion réussie !"){
		    		  $("#reponseLogin").html(response); 
		    		  $("#reponseLogin").attr('class', 'white');
			    	  location.reload() ; //rechargement de la page
		    	  }
		    	  else { //Echec connexion
		    		  $("#reponseLogin").html(response); 
		    		  $("#reponseLogin").attr('class', 'red');
		    	  }
		      }
		     });
		    return false;
		    });
	}); 


	//Validation mot de passe
	$('#pwdIns').keyup(function(){
		passid = $('#pwdIns').val()
		passid_len = passid.length;  
		
		if (passid_len == 0 || passid_len < 3)  
		{  
			  $("#responsePwdIns").html('Trop court...'); 	
			  $("#responsePwdIns").attr('class', 'red');	  
		}
		else if(passid_len >= 25 ){
			  $("#responsePwdIns").html('Trop long (25 caratères)...'); 	
			  $("#responsePwdIns").attr('class', 'red');
		}
		else {
			$("#responsePwdIns").html('Mot de passe valide'); 	
			$("#responsePwdIns").attr('class', 'green');
		}
		
	});
	
	//Validation confirme mot de passe
	$('#cPwdIns').keyup(function(){
		passconfirm= $('#cPwdIns').val()
		passid = $('#pwdIns').val()
		
		if (passid  == passconfirm)  
		{  
			  $("#responseCPwdIns").html('Mot de passe confirmé'); 	
			  $("#responseCPwdIns").attr('class', 'green');	  
		}
		else {
			$("#responseCPwdIns").html('Mot de passe différent'); 	
			$("#responseCPwdIns").attr('class', 'red');
		}
		
	});

	

	//Inscription en ajax
	$('#submitIns').click(function(){
		login = $('#loginIns').val();
		pwd = $('#pwdIns').val();
		cPwd = $('#cPwdIns').val();
		nom = $('#nomIns').val();
		prenom = $('#prenomIns').val();
		role = $('#roleIns').val();
		mail =  $('#mailIns').val();
		
		$.ajax({
		      type: "POST",
		      url: "/MedicPi/compte/inscription",
		      data: {"login" : login, "pwd" : pwd, "cPwd" : cPwd, "nom" : nom, "prenom" : prenom, "role" : role, "mail" : mail},
		      success: function(response) {
		    	  $("#responseIns").html(response); 	
		    	  
		    	  if(response == 'Inscription réussie') {
		    		  $("#responseIns").attr('class', 'green');
		    	  }
		    	  else {
		    		  $("#responseIns").attr('class', 'red');
		    	  } 
		      }
		     });
		    return false;
		    });


