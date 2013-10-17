<div id="header">
	<a href="<?php echo site_url('index','') ?>"><img id="logo" src="<?php echo img_url('logo.jpg') ?>" /></a>
	
	<div id="compteHeader" class="floatr">


		<?php if(!isset($this->session->userdata['idUser'])): ?>
			<form id="formLog" method="post" action="#">
				<label id="reponseLogin"></label>
				<input class="input" id="login" type="text" name="login" placeholder="Votre login" />
				<label id="reponsePwd"></label>
		    	<input class="input" id="pwd" type="password" name="pwd" placeholder="Votre mot de passe" />
		    	<input class="submit" id="submitLogin" type="submit" value="ok" />
			</form>

		<?php else: ?>
			<div id="infoCompte">
				<p>
					Bonjour : <?php echo $this->session->userdata['prenom'].' '.  $this->session->userdata['nom'] ?><br />
					Rôle : <?php echo $this->session->userdata['role'] ?>
				</p>
				<a href="<?php echo site_url("compte/index"); ?>">Voir mon compte</a>
				<a href="<?php echo site_url("compte/deconnexion"); ?>">Deconnexion</a>
			</div>		
		<?php endif ?>

	</div>
		
	
	
	<div class="clear"></div>
</div>
