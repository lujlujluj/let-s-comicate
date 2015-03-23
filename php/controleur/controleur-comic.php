<?php

if (isset($_GET['comic']) && isset($_GET['case'])) {

	$comic = $_GET['comic'];
	$position = $_GET['case'];

	$redirect = 'location: index.php?p=c&comic=' . $comic . '&case=' . $position;
	

	require_once 'php/controleur/controleur-nouvelle-case.php';

	require_once 'php/controleur/controleur-likes.php';

	require_once 'php/controleur/controleur-commentaires.php';
	

	$donnees = recuperer_comic($bdd, $comic);
	
	if ($position == -1)
		$comic_vide = true;
	else
		$donnees_case = recuperer_case($bdd, $comic, $position);

}

?>