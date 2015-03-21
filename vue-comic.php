<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>YO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<?php

	require_once 'bdd.php';

	$bdd = connexion_bdd();

	require_once 'controleur.php';

	?>
</head>
<body>
	<?php require_once 'header.php'; ?>

	<?php afficher_comic($bdd, $comic, $case) ?>
</body>
</html>