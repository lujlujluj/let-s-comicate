<?php

if (isset($_GET['comic'])) {

	$comic = $_GET['comic'];

	$vote = true;

	$redirect = 'location: index.php?p=v&comic=' . $comic;

	require_once 'php/controleur/controleur-comic-vote.php';

	$donnees = recuperer_comic($bdd, $comic);
	
	if (!$donnees_cases_potentielles = recuperer_cases_potentielle($bdd, $comic))
		$aucune_case_potentielle = true;

}

?>