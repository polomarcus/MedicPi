$(document).ready(function(){

	//Confirm an account
	$('.valid').click(function(){
		id = $(this).attr('id'); //Id du compte

		$.ajax({
		      type: "POST",
		      url: "/MedicPi/compte/confirmCompte/",
		      data: {"id" : id},
		      success: function(response) {
		    	  if(response == "Compte validé"){
		    		  $("#rep" + id).html(response); 
		    		  $("#rep" + id).attr('class', 'green');
		    	  }
		    	  else { //Echec connexion
		    		  $("#rep" + id).html(response); 
		    		  $("#rep" + id).attr('class', 'red');
		    	  }
		      }
		     });
		    return false;
		    });
}); 


	