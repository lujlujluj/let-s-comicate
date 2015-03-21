<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>YO</title>
	<style>

		label {

			width: 120px;
			margin-bottom: 6px;
			display: inline-block;

		}

		.submit {

			margin-left: 120px;

		}

		h2 {

			margin-left: 30px;
		
		}

	</style>
	<?php

	include('bdd.php');

	$bdd = connexion_bdd();

	include('controleur.php');

	?>
</head>
<body>
	<h1>Let's comicate !</h1>

	<form method=POST>
		<p>
			<h2>S'enregistrer</h2>
			<label for="mail">E-mail</label><input type="email" name="mail" id="mail" /><br />
			<label for="pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo" /><br />
			<label for="mdp">Mot de passe</label><input type="password" name="mdp" id="mdp" /><br />
			<input type="submit" name="enregistrer_utilisateur" class="submit" />
		</p>
	</form>

	<form method=POST>
		<p>
			<h2>Se connecter</h2>
			<label for="mail2">E-mail</label><input type="email" name="mail" id="mail2" /><br />
			<label for="mdp2">Mot de passe</label><input type="password" name="mdp" id="mdp2" /><br />
			<input type="submit" name="authentifier_utilisateur" class="submit" />
		</p>
	</form>

	<p>
		<h2>Les 3 meilleurs comics</h2>
		<?php afficher_meilleurs_comics($bdd, 3); ?>
	</p>
</body>
</html>