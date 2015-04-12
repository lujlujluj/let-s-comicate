<?php

// Nouveau commentaire comic

if (isset($_POST['nouveau_commentaire_comic']) && isset($_SESSION['utilisateur'])) {

	nouveau_commentaire_comic($bdd, $_SESSION['utilisateur'], $comic, $_POST['contenu']);

	header($redirect);

	exit();

}

// Nouveau commentaire case

if (isset($_POST['nouveau_commentaire_case']) && isset($_SESSION['utilisateur'])) {

	nouveau_commentaire_case($bdd, $_SESSION['utilisateur'], $donnees_case['id'], $_POST['contenu']);

/*	header($redirect);

	exit();
*/
}

?>