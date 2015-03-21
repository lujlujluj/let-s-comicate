<?php

// Enregistrer nouvel utilisateur

if (isset($_POST['enregistrer_utilisateur'])) {

	enregistrer_utilisateur($bdd, $_POST['mail'], $_POST['mdp'], $_POST['pseudo']);

}

// Authentifier utilisateur

if (isset($_POST['authentifier_utilisateur'])) {

	if (authentifier_utilisateur($bdd, $_POST['mail'], $_POST['mdp']))
		echo '<p>AUTH OK</p>';

}

?>