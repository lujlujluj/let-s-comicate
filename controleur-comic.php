<?php

if (isset($_GET['comic']) && isset($_GET['case'])) {

	$comic = $_GET['comic'];
	$position = $_GET['case'];

	$donnees = recuperer_comic($bdd, $comic);

	if (isset($_POST['nouveau_commentaire'])) {

		nouveau_commentaire($bdd, 1, $comic, $_POST['contenu']);

	}

}

?>