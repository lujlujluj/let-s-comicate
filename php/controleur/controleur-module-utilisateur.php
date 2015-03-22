<?php

// Enregistrer nouvel utilisateur

if (isset($_POST['enregistrer_utilisateur'])) {

	enregistrer_utilisateur($bdd, $_POST['mail'], $_POST['mdp'], $_POST['pseudo']);

}

// Authentifier utilisateur

if (isset($_POST['authentifier_utilisateur'])) {

	if ($id_utilisateur = authentifier_utilisateur($bdd, $_POST['mail'], $_POST['mdp'])) {

		$_SESSION['utilisateur'] = $id_utilisateur;

	}

	header('location: index.php');

	exit();

}


if (isset($_SESSION['utilisateur']))
	$connecte = true;
else
	$connecte = false;


// Nouveau comic

if (isset($_POST['creer_comic']) && $connecte) {

	if (isset($_POST['libre']))
		$libre = 1;
	else
		$libre = 0;

	$id = creer_comic($bdd, $_POST['titre'], $libre, $_SESSION['utilisateur']);

	header('location: index.php?p=c&comic=' . $id . '&case=-1');

	exit();

}

?>