<?php require_once 'controleur-connexion-utilisateur.php'; ?>

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