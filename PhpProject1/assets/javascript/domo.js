$(document).ready(function(){

	//Switch on a socket
	$('.button').click(function(){
		id = $(this).attr('id'); //Id du compte
		//alert(id);
		type = id.substr(0,2);
		if(type == "on"){
			num = id.substr(2,1);
		}
		else {
			num = id.substr(3,1);
		}
		
		//alert(num);
		
		$.ajax({
		      type: "POST",
		      url: "/MedicPi/domo/prise/",
		      data: {"num" : id},
		      success: function(response) {
		    	  
		    	  if(response == "Done"){
		    		  $("#rep" + num).html(response); 
		    		  $("#rep" + num).attr('class', 'green');
		    	  }
		    	  else { //Echec connexion
		    		  $("#rep" + num).html(response); 
		    		  $("#rep" + num).attr('class', 'red');
		    	  }
		      }
		     });
		    return false;
		    });
	
	
}); 


	