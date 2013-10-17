<div id="data"> <!-- Ce div se ferme dans temperature.php -->
	<h1>Obtenir les données en fonction d'un jour</h1>
	<form>
		<label class="label floatl"  for="date">
			Rentrez une date : 
		</label>
		<input type="text" id="datepicker" class="floatl" name="date" value="<?php echo $date; ?>"class="getdata"/>
		
		<div id="loadData" class="marginl10" style="display: none;">
			<img src="<?php echo img_url('icones/ajax-loader.gif') ?>"/>
		</div>	
	</form>
	<div class="clear"/></div>