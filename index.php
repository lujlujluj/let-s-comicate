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

	<form method=POST>
		<p>
			<h2>Nouveau comic</h2>
			<label for="titre">Titre</label><input type="text" name="titre" id="titre" /><br />
			<label for="libre">Comic libre</label><input type="checkbox" name="libre" id="libre" /><br />
			<input type="submit" name="creer_comic" class="submit" />
		</p>
	</form>

	<form method=POST>
		<p>
			<h2>Nouvelle case</h2>
			<input type="submit" name="creer_case" class="submit" />
		</p>
	</form>

	<form method=POST>
		<p>
			<h2>Liker comic</h2>
			<input type="submit" name="liker_comic" class="submit" />
		</p>
	</form>

	<form method=POST>
		<p>
			<h2>Liker case</h2>
			<input type="submit" name="liker_case" class="submit" />
		</p>
	</form>

	<p>
		<h2>Comic n°1</h2>
		<?php afficher_comic($bdd, 1); ?>
		<p><strong>Commentaires :</strong></p>
		<?php afficher_commentaires($bdd, 1); ?>
	</p>
	
	<form method=POST>
		<p>
			<h2>Poster un commentaire</h2>
			<textarea name="contenu" id="contenu"></textarea><br />
			<input type="submit" name="nouveau_commentaire" class="submit" />
		</p>
	</form>
</body>
</html>