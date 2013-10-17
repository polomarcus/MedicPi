
<div id="dashboard">

	<p class="switch">
		<a class="ongletDash current floatl" href="<?php echo site_url('dashboard','index') ?>">Mois</a>
		<a class="ongletDash floatr" href="<?php echo site_url('dashboard','annee') ?>">Année</a>
	</p>

	
	<h1>Tableau de bord - <?php echo $mois . ' ' . $year ?> - <?php echo $patient->prenom . ' ' . $patient->nom ?></h1>
	
	<div class="floatl dashbox">
		<div class="boxTitle" onClick="displayBox(1)">
			<h2>Nombre de visites</h2>
		</div>
		
		<div class="boxContent">
			<p>Ce mois : <?php echo $nbVisit ?> visite<?php if($nbVisit > 1 ): echo 's'; endif;?></p>
			<p>
				<?php if($lastmonth == true):
					if($nbVisitBefore != 0):?>
						<?php echo $nbVisitPercent ?> par rapport au mois dernier (<?php echo $nbVisitBefore ?> visite<?php if($nbVisitBefore > 1 ): echo 's'; endif;?>)
					<?php else: ?>
						Mois précédént : <?php echo $nbVisitBefore ?> visite <?php if($nbVisitBefore > 1 ): echo 's'; endif;?>
					<?php endif; ?>
				<?php endif;?>
			</p>
		</div>
	</div>

	<div class="floatl dashbox">
		<div class="boxTitle">
			<h2>Nombre d'anomalies</h2>
		</div>
		<div class="boxContent">
			<p>Ce mois : <?php echo $nbAno ?> anomalie<?php if($nbAno > 1 ): echo 's'; endif;?></p>
			<p>
				<?php if($lastmonth == true):
					if($nbAnoBefore != 0):?>
						<?php echo $nbAnoPercent ?> par rapport au mois dernier (<?php echo $nbAnoBefore ?> anomalie<?php if($nbAnoBefore > 1 ): echo 's'; endif;?>)
					<?php else:?>
						Mois précédént : <?php echo $nbAnoBefore ?> anomalie <?php if($nbAnoBefore > 1 ): echo 's'; endif;?>
					<?php endif; ?>
				<?php endif;?>
			</p>
		</div>
	</div>

	<div class="floatl dashbox">
		<div class="boxTitle">	
			<h2>Température moyenne</h2>
		</div>
		
		<div class="boxContent">		
			<p>Ce mois :<?php echo $average ?> °C</p>
			<p>
				<?php if($lastmonth == true):
					if($averTempBefore != 0):?>
						<?php echo $averTempPercent ?> par rapport au mois dernier (<?php echo $averTempBefore ?> °C)
					<?php else:?>
						Mois précédént : <?php echo $averTempBefore ?> °C
					<?php endif; ?>
				<?php endif;?>
			</p>
		</div>
	</div>

	<div class="floatl dashbox">
		<div class="boxTitle">
			<h2>Nombre d'heure d'activité dans la maison</h2>
		</div>
		
		<div class="boxContent">
			<small>Correspond à une activité enregistré dans la maison pour chaque heure</small>
			<p>Ce mois : <?php echo $activeHour ?> heures d'activité</p>
			<p>
				<?php if($lastmonth == true):
					if($activeHourBefore != 0):?>
						<?php echo $activeHourPercent ?> par rapport au mois dernier (<?php echo $activeHourBefore ?> heure<?php if($activeHourBefore > 1 ): echo 's'; endif;?>)
					<?php else:?>
						Mois précédént : <?php echo $activeHourBefore ?> heure<?php if($activeHourBefore > 1 ): echo 's'; endif;?>
					<?php endif;?>
				<?php endif;?>
			</p>
		</div>
	</div>
	<div class="clear"></div>

</div>



