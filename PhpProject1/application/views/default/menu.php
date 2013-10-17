<?php if(isset($this->session->userdata['idUser'])): ?>
	<div id="menu">
		<ul>
			<li class="floatl"><a href="<?php echo site_url('dashboard','index') ?>">Dashboard</a></li>
			<li class="floatl"><a href="<?php echo site_url('data','index') ?>">Données</a></li>
			<li class="floatl"><a href="<?php echo site_url('anomalie','index') ?>">Anomalies</a></li>
			
			<?php if($this->session->userdata['role'] == "Medecin"): ?>
				<li class="floatl"><a href="<?php echo site_url('suivi','index') ?>">Visites Médical</a></li>
                <li class="floatl"><a href="<?php echo site_url('suivi','voirvisite') ?>">Voir les visites</a></li>				
			<?php endif ?>
			<?php if($this->session->userdata['role'] == 'Admin'): ?>
				<li class="floatl"><a href="<?php echo site_url('admin','index') ?>">Valider des comptes</a></li>			
			<?php endif ?>
			<?php if($this->session->userdata['role'] != 'Famille'): ?>
				<li class="floatl"><a href="<?php echo site_url('configuration', 'index') ?>">Configuration</a></li>
			<?php endif ?>
		</ul>
	
		<div class="clear"></div>
	</div>
<?php endif ?>