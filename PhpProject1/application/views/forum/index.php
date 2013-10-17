<h1>Bonjour <?php echo $pseudo;?></h1>
 
<p>
    Ceci est une vue chargée par un controlleur forum.php
</p>

<p>
	Ton pseudo a été chargé dans le controlleur et passé dans la vue par <b>$data['pseudo']</b>
</p>


<p>
	<a href="<?php echo site_url(); ?>">Accueil</a> Lien crée par la fonction <b>site_url()</b> qui évite d'avoir à écrire les début d'adresse (http://localhost/MedicPi/) dans les href
</p>

<p>Exemple de session : <?php echo $this->session->userdata('pseudo'); ?></p>


<a href="<?php echo site_url('forum', 'deconnexion'); ?>">Déconnexion</a>

