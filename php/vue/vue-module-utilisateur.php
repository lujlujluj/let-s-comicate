<?php require_once 'php/controleur/controleur-module-utilisateur.php';

if (!$connecte) {

	?>
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
	<?php

} else {

	?>
	<p>Vous êtes connecté</p>

	<p><a href="index.php?p=d">Déconnexion</a></p>

	<form method=POST>
		<p>
			<h2>Nouveau comic</h2>
			<label for="titre">Titre</label><input type="text" name="titre" id="titre" /><br />
			<label for="libre">Comic libre</label><input type="checkbox" name="libre" id="libre" /><br />
			<input type="submit" name="creer_comic" class="submit" />
		</p>
	</form>
	<?php

}

?>