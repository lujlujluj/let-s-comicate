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

	require_once 'php/controleur/controleur-vote.php';

	?>
</head>
<body>
	<?php 
	require_once 'php/vue/vue-header.php';

	require_once 'php/vue/vue-module-utilisateur.php';

	require_once 'php/vue/vue-titre-comic.php'; 
	?>

	<section>

		<h2>Vote pour la prochaine case</h2>

		<?php
		if (isset($aucune_case_potentielle)) {

			?>
			<p>Aucune proposition de case pour le moment.</p>
			<?php

		} else {

			foreach ($donnees_cases_potentielles as $donnees_case) {

				?>
				<div class="case">

					<h3>Case créée par <?php echo $donnees_case['pseudo']; ?></h3>

					<p><img src="img/<?php echo $donnees_case['image']; ?>" alt="" /></p>

					<?php
					if ($connecte) {

						?>
						<form method=POST>
							<p>
								<input type="hidden" name="id_case" value="<?php echo $donnees_case['id']; ?>" />
								<?php echo $donnees_case['votes']; ?> votes <input type="submit" name="liker_case" class="submit inline" value="Up-voter" />
							</p>
						</form>
						<?php

					} else {
						
						?>
						<p><?php echo $donnees_case['votes']; ?> votes</p>
						<?php

					}
					?>

					<p><?php echo $donnees_case['date_creation']; ?></p>

				</div>
				<?php

			}

		}
		?>

	</section>

	<?php
	require_once 'php/vue/vue-nouvelle-case.php';
	
	require_once 'php/vue/vue-commentaires.php';
	?>
</body>
</html>