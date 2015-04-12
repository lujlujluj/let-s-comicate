<?php

if (isset($_GET['p'])) {

	switch ($_GET['p']) {

		case 'c':
			require_once 'php/vue/vue-comic.php';
			break;

		case 'v':
			require_once 'php/vue/vue-vote.php';
			break;

		case 'a':
			require_once 'php/vue/vue-auteur.php';
			break;

		case 'd':
			require_once 'php/controleur/controleur-deconnexion.php';
			break;

		case 'm':
			require_once 'php/controleur/controleur-mise-a-jour.php';
			break;

		default:
			require_once 'php/vue/vue-accueil.php';
			break;

	}

} else
	require_once 'php/vue/vue-accueil.php'; 

?>