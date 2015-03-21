<?php

// Connexion base de données

function connexion_bdd() {

	require_once 'parametres_bdd.php';

	try {

		$bdd = new PDO('mysql:host=' . $host_bdd . ';dbname=' . $dbname_bdd . ';charset=utf8', $login_bdd, $mdp_bdd);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		
	}
	catch (Exception $e) {

	    die('Erreur : ' . $e->getMessage());

	}

	return $bdd;

}



// Enregistrer nouvel utilisateur

function enregistrer_utilisateur($bdd, $mail, $mdp, $pseudo) {

	$req = $bdd->prepare('INSERT INTO utilisateur (mail, mdp, pseudo) VALUES (?, ?, ?)');
	$req->execute(array($mail, $mdp, $pseudo));
	$req->closeCursor();
	return 1;

}

// Authentifier utilisateur

function authentifier_utilisateur($bdd, $mail, $mdp) {

	$req = $bdd->prepare('SELECT id FROM utilisateur WHERE mail = ? AND mdp = ?;');
	$req->execute(array($mail, $mdp));
	if ($req->rowCount() == 1) {

		$req->closeCursor();
		return 1;

	} else {

		$req->closeCursor();
		return 0;

	}

}

// Créer un nouveau comic

function creer_comic($bdd, $titre, $libre, $auteur) {

	$req = $bdd->prepare('INSERT INTO comic (titre, libre, date_creation, auteur) VALUES (?, ?, NOW(), ?)');
	$req->execute(array($titre, $libre, $auteur));
	$req->closeCursor();
	return 1;

}

// Créer une nouvelle case

function creer_case($bdd, $comic, $auteur) {

	$req = $bdd->prepare('SELECT longueur, libre FROM comic WHERE id = ?');
	$req->execute(array($comic));

	if ($donnees = $req->fetch()) {

		$position = $donnees['longueur']++;

		if ($donnees['libre']) {

			$req = $bdd->prepare('UPDATE comic SET longueur = longueur + 1 WHERE id = ?');
			$req->execute(array($comic));

		}

	}

	$req = $bdd->prepare('INSERT INTO caze (position, date_creation, comic, auteur) VALUES (?, NOW(), ?, ?)');
	$req->execute(array($position, $comic, $auteur));

	$req->closeCursor();
	return 1;

}

// Liker un comic

function liker_comic($bdd, $comic) {

	$req = $bdd->prepare('UPDATE comic SET likes = likes + 1 WHERE id = ?');
	$req->execute(array($comic));
	$req->closeCursor();
	return 1;

}

// Liker une case

function liker_case($bdd, $case) {

	$req = $bdd->prepare('UPDATE caze SET likes = likes + 1 WHERE id = ?');
	$req->execute(array($case));
	$req->closeCursor();
	return 1;

}

// Afficher meilleurs comic

function afficher_meilleurs_comics($bdd, $nombre) {

	$req = $bdd->prepare('SELECT co.id, co.titre, co.nb_vues, co.likes, co.date_creation, co.longueur, u.pseudo FROM comic co, utilisateur u WHERE co.auteur = u.id ORDER BY co.likes DESC LIMIT ?');
	$req->bindValue(1, $nombre, PDO::PARAM_INT);
	$req->execute();

	while ($donnees = $req->fetch()) {

		$derniere_case = $donnees['longueur']-1;
	
		echo '<p><a href="vue-comic.php?comic=' .  $donnees['id'] . '&case=' . $derniere_case . '">' . $donnees['titre'] . '</a> --- ' . $donnees['nb_vues'] . ' vues --- ' . $donnees['likes'] . ' likes --- auteur : ' . $donnees['pseudo'] . '</p>';

		afficher_case($bdd, $donnees['id'], $derniere_case);

	}

	$req->closeCursor();
	return 1;

}

// Recuperer un comic

function recuperer_comic($bdd, $comic) {

	$req = $bdd->prepare('SELECT co.titre, co.nb_vues, co.likes, co.date_creation, co.longueur, u.pseudo FROM comic co, utilisateur u WHERE co.auteur = u.id AND co.id = ?');
	$req->execute(array($comic));

	if ($donnees = $req->fetch()) {
		
		$req->closeCursor();
		return $donnees;

	} else {

		$req->closeCursor();
		return 0;

	}

}

// Afficher case

function afficher_case($bdd, $comic, $position) {

	$req = $bdd->prepare('SELECT c.position, c.votes, c.date_creation, u.pseudo FROM caze c, utilisateur u WHERE c.comic = ? AND c.auteur = u.id AND c.position = ?');
	$req->execute(array($comic, $position));

	while ($donnees = $req->fetch()) {

		echo '<p>Case n°' . $donnees['position'] . ' --- ' . $donnees['votes'] . ' votes --- ' . $donnees['date_creation'] . ' --- auteur : ' . $donnees['pseudo'] . '</p>';
	
	}

	$req->closeCursor();
	return 1;

}

// Nouveau commentaire

function nouveau_commentaire($bdd, $auteur, $comic, $contenu) {

	$req = $bdd->prepare('INSERT INTO commentaire (auteur, comic, date_heure, contenu) VALUES (?, ?, NOW(), ?)');
	$req->execute(array($auteur, $comic, $contenu));
	$req->closeCursor();
	return 1;

}

// Afficher commentaires

function afficher_commentaires($bdd, $comic) {

	$req = $bdd->prepare('SELECT * FROM commentaire WHERE comic = ? ORDER BY date_heure');
	$req->execute(array($comic));

	while ($donnees = $req->fetch()) {
		echo '<p>' . $donnees['contenu'] . '</p>';
		echo '<p>auteur : ' . $donnees['auteur'] . ' --- ' . $donnees['date_heure'] . '</p>';

	}

	$req->closeCursor();
	return 1;

}
