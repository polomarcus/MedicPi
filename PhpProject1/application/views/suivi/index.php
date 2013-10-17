<div id="visite">
	<h1>Suivi médical</h1>
	<h3>Renseignez les jours de visite</h3>
	
	
	<form method="post" action="<?php echo site_url("suivi/recordVisit"); ?>">
	
		<label class="label floatl"  for="login">Rentrez la date de visite: </label>
		<input class="input floatl" type="text" id="datepicker" name="date" value="<?php echo $date; ?>"class="getdata"/></p>		
		<input class="submit floatl" type="submit" value="Enregistrer" />
		<div class="clear"></div>
		
		<h2><?php echo $message ?></h2>
	</form>
</div>