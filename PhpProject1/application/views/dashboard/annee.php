<div id="dashboard">
	
	<p class="switch">
		<a class="ongletDash floatl" href="<?php echo site_url('dashboard','index') ?>">Mois</a>
		<a class="ongletDash current floatr" href="<?php echo site_url('dashboard','annee') ?>">Année</a>
	</p>

	<h1>Tableau de bord - <?php echo $year ?> - <?php echo $patient->prenom . ' ' . $patient->nom  ?></h1>

	<table>
		<tr> 
			<th></th> 
			<th>Jan</th> 
			<th>Fév</th> 
			<th>Mar</th> 
			<th>Avr</th>
			<th>Mai</th>
			<th>Jui</th>
			<th>Jui</th>
			<th>Aoû</th>
			<th>Sep</th>
			<th>Oct</th>
			<th>Nov</th>
			<th>Déc</th>
		</tr> 
	
		<tr>
	 		<th>T° (moy)</th>
	 		
	 		<?php foreach($tempYear as $temp):?>
	 		<td>
				<?php echo $temp->val;?>
				<?php if(!empty($temp->percent) && $temp->percent != ' '):?>
		 			(<?php echo $temp->percent;?>)
	 			<?php endif;?> 	
			</td>
			<?php endforeach;?>
		</tr>
	
		<tr>
			<th>Activité (h)</th>
			<?php foreach($activeHourYear as $activeHour):?>
	 		<td>
	 			<?php echo $activeHour->val;?>
	  			<?php if(!empty($activeHour->percent) && $activeHour->percent != ' '):?>
		 			(<?php echo $activeHour->percent;?>)
				<?php endif;?> 	
	 		</td>
			<?php endforeach;?>
		</tr>
	
		<tr>
			<th>Visites</th>
	 		<?php foreach($nbVisitYear as $nbVisit):?>
	 		<td>
	 			<?php echo $nbVisit->val;?> 
	 			<?php if(!empty($nbVisit->percent) && $nbVisit->percent != ' '):?>
	 				(<?php echo $nbVisit->percent;?>)
	 			<?php endif;?>
	
	 		</td>
			<?php endforeach;?>	
		</tr>
	
		<tr>
			<th>Anomalies</th>
	 		<?php foreach($nbAnoYear as $nbAno):?>
	 		<td>
	 			<?php echo $nbAno->val;?>
	 		 	<?php if(!empty($nbAno->percent) && $nbAno->percent != ' '):?>
		 			(<?php echo $nbAno->percent;?>)
	 			<?php endif;?>
	 		</td>
			<?php endforeach;?>
		</tr>
	</table>
</div>





