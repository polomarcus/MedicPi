<?php


/*
 $url_secret = site_url('forum', 'secret', '2452', 'codeigniter');
 $url_secret va donc valoir quelque chose comme cela :
http://nom_de_domaine.tld/forum/secret/2452/codeigniter.html
*/
//Reprend toutes les données 
function site_url($uri = '')
{
	if( ! is_array($uri))
	{
		//  Tous les paramètres sont insérés dans un tableau
		$uri = func_get_args();
	}
	 
	//  On ne modifie rien ici
	$CI =& get_instance();
	return $CI->config->site_url($uri);
}


//Affichera (selon les préférences) : <a href="http://nom_de_domaine.tld/user/connexion.html">Page de connexion</a>
//url('Page de connexion', 'user', 'connexion');
function url($text, $uri = '')
{
	if( ! is_array($uri))
	{
		$uri = func_get_args();

		//  Suppression de la variable $text
		array_shift($uri);
	}
	 
	echo '<a href="' . site_url($uri) . '">' . htmlentities($text) . '</a>';
	return '';
}