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
	?>

	<section>

		<?php
		if (!isset($comic_vide)) {

			?>
			<p>
				<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=0">Première case</a>
				<a href="index.php?p=c&comic=<?php echo $comic; ?>&case=<?php echo $position-1; ?>">Précédent</a>
			</p>

			<div class="case">

				<div class="contenu">

					<p>Case n°<?php echo $donnees_case['position']; ?></p>
					
					<?php
					if ($connecte && $donnees_case['id_auteur'] == $_SESSION['utilisateur']) {

						?>
						<form method=POST enctype="multipart/form-data">
							<p>
								<strong>Modifier case</strong><br />
								<input type="file" name="image" /><br />
								<textarea name="texte" id="texte"></textarea><br />
								<input type="hidden" name="id_case" value="<?php echo $donnees_case['id']; ?>" />
								<input type="submit" name="modifier_case" class="submit" />
							</p>
						</form>
						<?php

					}

					if ($donnees_case['image']) {

						?>
						<p><img src="img/<?php echo $donnees_case['image']; ?>" alt="" /></p>
						<?php

					}
					
					echo '<p>' . $donnees_case['texte'] . '</p>';

					?>

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

					<p>Auteur : <a href="index.php?p=a&auteur=<?php echo $donnees_case['id_auteur']; ?>"><?php echo $donnees_case['pseudo']; ?></a></p>

				</div>

				<div class="commentaires">
					<?php afficher_commentaires_case($bdd, $donnees_case['id']); ?>
				
					<?php
					if ($connecte) {

						?>
						<form method=POST>
							<p>
								<h2>Poster un commentaire</h2>
								<textarea name="contenu" id="contenu"></textarea><br />
								<input type="submit" name="nouveau_commentaire_case" class="submit" />
							</p>
						</form>
						<?php

					}
					?>
				</div>
			</div>

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
			<p id="vote"><strong><a href="index.php?p=v&comic=<?php echo $comic; ?>">Vote pour la prochaine case !</a></strong></p>
			<?php

		}
		?>

	</section>
	
	<?php
	require_once 'php/vue/vue-nouvelle-case.php';
	
	require_once 'php/vue/vue-commentaires.php';
	?>
</body>
</html>