<?php

if (isset($_GET['comic'])) {

	$comic = $_GET['comic'];

	$vote = true;

	$redirect = 'location: index.php?p=v&comic=' . $comic;


	require_once 'php/controleur/controleur-nouvelle-case.php';

	require_once 'php/controleur/controleur-likes.php';

	require_once 'php/controleur/controleur-commentaires.php';

	
	$donnees = recuperer_comic($bdd, $comic);
	
	if (!$donnees_cases_potentielles = recuperer_cases_potentielles($bdd, $comic))
		$aucune_case_potentielle = true;

}

?>