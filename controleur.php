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

// Créer un nouveau comic

if (isset($_POST['creer_comic'])) {

	if (isset($_POST['libre']))
		$libre = 1;
	else
		$libre = 0;

	creer_comic($bdd, $_POST['titre'], $libre, 1);

}

// Créer une nouvelle case

if (isset($_POST['creer_case'])) {

	creer_case($bdd, 1, 1);

}

// Liker un comic

if (isset($_POST['liker_comic'])) {

	liker_comic($bdd, 1);

}

// Liker une case

if (isset($_POST['liker_case'])) {

	liker_case($bdd, 1);

}

// Nouveau commentaire

if (isset($_POST['nouveau_commentaire'])) {

	nouveau_commentaire($bdd, 1, 1, $_POST['contenu']);

}

?>