<?php

// Nouveau commentaire

if (isset($_POST['nouveau_commentaire']) && isset($_SESSION['utilisateur'])) {

	nouveau_commentaire($bdd, $_SESSION['utilisateur'], $comic, $_POST['contenu']);

	header($redirect);

	exit();

}

// Liker un comic

if (isset($_POST['liker_comic']) && isset($_SESSION['utilisateur'])) {

	liker_comic($bdd, $comic);

	header($redirect);

	exit();

}

// Up-voter ou liker une case

if (isset($_POST['liker_case']) && isset($_SESSION['utilisateur'])) {

	if (isset($vote) && isset($_POST['id_case'])) // Case potentielle
		upvoter_case($bdd, $_POST['id_case']);
	else // Case déjà parue
		liker_case($bdd, $comic, $position);

	header($redirect);

	exit();

}

// Créer une nouvelle case

if (isset($_POST['creer_case']) && isset($_SESSION['utilisateur'])) {

	$nouvelle_position = creer_case($bdd, $comic, $_SESSION['utilisateur']);

	if (isset($vote))
		header($redirect);
	else
		header('location: index.php?p=c&comic=' . $comic . '&case=' . $nouvelle_position);

	exit();

}
	
?>