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

	require_once 'php/controleur/controleur-comic.php';

	?>
</head>
<body>
	<?php 
	require_once 'php/vue/vue-header.php';

	require_once 'php/vue/vue-module-utilisateur.php';

	require_once 'php/vue/vue-titre-comic.php'; 


	if (!isset($comic_vide)) {

		?>
		<p>
			<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=0">Première case</a>
			<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=<?php echo $position-1; ?>">Précédent</a>
		</p>

		<p>Case n°<?php echo $donnees_case['position']; ?></p>

		<?php
		if ($connecte) {

			?>
			<form method=POST>
				<p><?php echo $donnees_case['votes']; ?> votes <input type="submit" name="liker_case" class="submit inline" value="Up-voter" /></p>
			</form>
			<?php

		} else {
			
			?>
			<p><?php echo $donnees_case['votes']; ?> votes</p>
			<?php

		}
		?>

		<p><?php echo $donnees_case['date_creation']; ?></p>

		<p>Auteur : <?php echo $donnees_case['pseudo']; ?></p>

		<p>
			<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=<?php echo $position+1; ?>">Suivant</a>
			<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=<?php echo $donnees['longueur']-1; ?>">Dernière case</a>
		</p>
		<?php

	} else {

		?>
		<p><strong>Aucune case dans ce comic pour l'instant.</strong></p>
		<?php

	}

	if (!$donnees['libre']) {

		?>
		<p><strong><a href="index.php?p=v&comic=<?php echo $comic; ?>">Vote pour la prochaine case !</a></strong></p>
		<?php

	}
	

	require_once 'php/vue/vue-nouvelle-case.php';
	
	require_once 'php/vue/vue-commentaires.php';
	?>
</body>
</html>