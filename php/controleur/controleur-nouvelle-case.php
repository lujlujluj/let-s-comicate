<?php

// Créer une nouvelle case

if (isset($_POST['creer_case']) && isset($_SESSION['utilisateur'])) {

	$extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

	$nom_fichier = uniqid() . '.' . $extension;

	if (move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $nom_fichier)){
		$nouvelle_position = creer_case($bdd, $comic, $_SESSION['utilisateur'], $nom_fichier);
	}

	if (isset($vote))
		header($redirect);
	else
		header('location: index.php?p=c&comic=' . $comic . '&case=' . $nouvelle_position);

	exit();

}

?>