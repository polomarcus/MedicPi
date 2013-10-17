<div id="valider">
	<h1>Confirmer des comptes en attente</h1>
	
	<?php foreach($comptes as $compte):?>
		<form>
			<p class="nomPrenom floatl">Nom : <?php echo $compte->prenom . ' ' . $compte->nom . '<br />Email : ' . $compte->mail ?><p>
			<a href="#" class="valid floatl" id="<?php echo $compte->idUser ?>">
				<img id="validImg" src="<?php echo img_url('icones/ok.png') ?>" />
			</a>
			<label id="rep<?php echo $compte->idUser ?>" class="floatl"></label> <!-- La réponse en AJAX -->
			<div class="clear"></div>
		</form>
	<?php endforeach;?>
</div>