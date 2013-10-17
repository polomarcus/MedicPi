<div id="compte">

	<h1>Mon compte</h1>
	
	<form method="post" action="<?php echo site_url("compte/index"); ?>">
	    
	    <label class="label floatl" for="login">Login : </label>
	    <input class="input floatl" type="text" name="login" value="<?php echo $compte->login ?>" />
	    <?php echo form_error('login'); ?>
	 	<div class="clear" /><br/>
	 	
	 	<label class="label floatl" for="nom">Nom : </label>
	    <input class="input floatl" type="text" name="nom" value="<?php echo $compte->nom ?>" />
	    <?php echo form_error('nom'); ?>
	 	<div class="clear" /><br/>
	 	
	 	<label class="label floatl" for="nom">Prénom : </label>
	    <input class="input floatl" type="text" name="prenom" value="<?php echo $compte->prenom ?>" />
	    <?php echo form_error('prenom'); ?>
	 	<div class="clear" /><br/>
	 	
	    <label class="label floatl" for="pwd">Nouveau mot de passe :</label>
	    <input class="input floatl" type="password" name="pwd" value="" />
	    <?php echo form_error('pwd'); ?>
	    <div class="clear" /><br/>
	    
	    <!--
	    <label class="label floatl" for="mail">Mail:</label>
	    <input class="input floatl" type="text" name="mail" value="<?php echo $compte->mail ?>" />
	    <?php echo form_error('mail'); ?>
	    <div class="clear" /><br/>
	 	-->
	 	
	    <input class="submit" type="submit" value="Envoyer" />
	</form>
	
</div>