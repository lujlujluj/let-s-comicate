<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>YO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<?php

	require_once 'modele.php';

	$bdd = connexion_bdd();

	require_once 'controleur-comic.php';

	?>
</head>
<body>
	<?php require_once 'vue-header.php'; ?>

	<?php require_once 'vue-connexion-utilisateur.php'; ?>

	<h2><?php echo $donnees['titre']; ?></h2>

	<p><?php echo $donnees['nb_vues']; ?> vues</p>
	<p><?php echo $donnees['likes']; ?> likes</p>
	<p>Créé le <?php echo $donnees['date_creation']; ?></p>
	<p>Auteur : <?php echo $donnees['pseudo']; ?></p>
		
	<p>
		<a href="vue-comic.php?comic=<?php echo $comic; ?>&case=0">Première case</a>
		<a href="vue-comic.php?comic=<?php echo $comic; ?>&case=<?php echo $position-1; ?>">Précédent</a>
	</p>

	<?php afficher_case($bdd, $comic, $position); ?>

	<p>
		<a href="vue-comic.php?comic=<?php echo $comic; ?>&case=<?php echo $position+1; ?>">Suivant</a>
		<a href="vue-comic.php?comic=<?php echo $comic; ?>&case=<?php echo $donnees['longueur']-1; ?>">Dernière case</a>
	</p>

	<h2>Commentaires</h2>

	<?php afficher_commentaires($bdd, $comic); ?>

	<form method=POST>
		<p>
			<h2>Poster un commentaire</h2>
			<textarea name="contenu" id="contenu"></textarea><br />
			<input type="submit" name="nouveau_commentaire" class="submit" />
		</p>
	</form>
</body>
</html>