<?php

// Nouveau commentaire

if (isset($_POST['nouveau_commentaire']) && isset($_SESSION['utilisateur'])) {

	nouveau_commentaire($bdd, $_SESSION['utilisateur'], $comic, $_POST['contenu']);

	header($redirect);

	exit();

}

?>