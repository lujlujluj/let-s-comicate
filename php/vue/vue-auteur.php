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

	require_once 'php/controleur/controleur-auteur.php';

	?>
</head>
<body>
	<?php 
	require_once 'php/vue/vue-header.php';

	require_once 'php/vue/vue-module-utilisateur.php';
	?>

	<section>

		<h2>Profil de <em><?php echo $pseudo; ?></em></h2>

	</section>

	<section>

		<h2>Meilleurs comics de l'auteur</h2>
		<?php afficher_comics_auteur($bdd, 5, $auteur); ?>

	</section>
</body>
</html>