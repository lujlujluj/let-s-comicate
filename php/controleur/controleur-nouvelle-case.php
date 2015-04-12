<?php

// Créer une nouvelle case

if (isset($_POST['creer_case']) && isset($_SESSION['utilisateur'])) {

	if (!$_FILES['image']['error']) {
	
		$extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

		$nom_fichier = uniqid() . '.' . $extension;

		if (move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $nom_fichier)){
			$nouvelle_position = creer_case($bdd, $comic, $_SESSION['utilisateur'], $nom_fichier, $_POST['texte']);
		}

	} else if (isset($_POST['texte'])) {

		$nouvelle_position = creer_case($bdd, $comic, $_SESSION['utilisateur'], '', $_POST['texte']);

	}
	

	if (isset($vote))
		header($redirect);
	else
		header('location: index.php?p=c&comic=' . $comic . '&case=' . $nouvelle_position);

	exit();

}

// Modifier une case existante

if (isset($_POST['modifier_case']) && isset($_POST['id_case']) && isset($_SESSION['utilisateur'])) {

	$extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

	$nom_fichier = uniqid() . '.' . $extension;

	if (move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $nom_fichier)){
		modifier_case($bdd, $_SESSION['utilisateur'], $_POST['id_case'], $nom_fichier, $_POST['texte']);
	} else if (isset($_POST['texte'])) {
		modifier_case($bdd, $_SESSION['utilisateur'], $_POST['id_case'], '', $_POST['texte']);
	}

	header($redirect);
	exit();

}

?>