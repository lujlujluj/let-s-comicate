<?php

if (isset($_GET['auteur'])) {

	$auteur = $_GET['auteur'];

	$pseudo = recuperer_pseudo($bdd, $auteur);
	
}

?>