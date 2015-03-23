<?php

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
	
?>