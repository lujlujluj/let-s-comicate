<?php session_start(); ?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>YO</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<?php

	require_once 'php/modele/modele.php';

	$bdd = connexion_bdd();

	?>
</head>
<body>
	<?php require_once 'php/vue/vue-header.php'; ?>

	<?php require_once 'php/vue/vue-module-utilisateur.php'; ?>

	<section>

		<h2>Les 10 meilleurs comics</h2>
		<?php afficher_meilleurs_comics($bdd, 10); ?>
	
	</section>
</body>
</html>