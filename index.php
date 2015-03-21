<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>YO</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<?php

	require_once 'modele.php';

	$bdd = connexion_bdd();

	?>
</head>
<body>
	<?php require_once 'vue-header.php'; ?>

	<?php require_once 'vue-connexion-utilisateur.php'; ?>

	<p>
		<h2>Les 3 meilleurs comics</h2>
		<?php afficher_meilleurs_comics($bdd, 3); ?>
	</p>
</body>
</html>