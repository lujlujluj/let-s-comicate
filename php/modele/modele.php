<?php

// Connexion base de données

function connexion_bdd() {

	require_once 'php/modele/parametres_bdd.php';

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

		$donnees = $req->fetch();

		$req->closeCursor();
		return $donnees['id'];

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
	return $bdd->lastInsertId();

}

// Créer une nouvelle case

function creer_case($bdd, $comic, $auteur, $nom_fichier) {

	$req = $bdd->prepare('SELECT longueur, libre FROM comic WHERE id = ?');
	$req->execute(array($comic));

	if ($donnees = $req->fetch()) {

		$position = $donnees['longueur'];

		if ($donnees['libre']) {

			$req = $bdd->prepare('UPDATE comic SET longueur = longueur + 1 WHERE id = ?');
			$req->execute(array($comic));

			$position_redirection = $position;

		} else
			$position_redirection = $donnees['longueur'] - 1;

	}

	$req = $bdd->prepare('INSERT INTO caze (position, date_creation, comic, auteur, image) VALUES (?, NOW(), ?, ?, ?)');
	$req->execute(array($position, $comic, $auteur, $nom_fichier));

	$req->closeCursor();
	return $position_redirection;

}

// Liker un comic

function liker_comic($bdd, $comic) {

	$req = $bdd->prepare('UPDATE comic SET likes = likes + 1 WHERE id = ?');
	$req->execute(array($comic));
	$req->closeCursor();
	return 1;

}

// Liker une case

function liker_case($bdd, $comic, $position) {

	$req = $bdd->prepare('UPDATE caze SET votes = votes + 1 WHERE comic = ? AND position = ?');
	$req->execute(array($comic, $position));
	$req->closeCursor();
	return 1;

}

// Up-voter case

function upvoter_case($bdd, $case) {

	$req = $bdd->prepare('UPDATE caze SET votes = votes + 1 WHERE id = ?');
	$req->execute(array($case));
	$req->closeCursor();
	return 1;

}

// Afficher meilleurs comic

function afficher_meilleurs_comics($bdd, $nombre) {

	$req = $bdd->prepare('SELECT co.id, co.titre, co.likes, co.date_creation, co.longueur, u.pseudo FROM comic co, utilisateur u WHERE co.auteur = u.id ORDER BY co.likes DESC LIMIT ?');
	$req->bindValue(1, $nombre, PDO::PARAM_INT);
	$req->execute();

	while ($donnees = $req->fetch()) {

		$derniere_case = $donnees['longueur'] - 1;
	
		echo '<p class="titre"><a href="index.php?p=c&comic=' .  $donnees['id'] . '&case=' . $derniere_case . '">' . $donnees['titre'] . '</a> --- ' . $donnees['likes'] . ' likes --- auteur : ' . $donnees['pseudo'] . '</p>';

		if ($donnees_case = recuperer_case($bdd, $donnees['id'], $derniere_case))
			echo '<p class="case"><img src="img/' . $donnees_case['image'] . '" alt="" /><br />Case n°' . $donnees_case['position'] . ' --- ' . $donnees_case['votes'] . ' votes --- ' . $donnees_case['date_creation'] . ' --- auteur : ' . $donnees_case['pseudo'] . '</p>';

	}

	$req->closeCursor();
	return 1;

}

// Recuperer un comic

function recuperer_comic($bdd, $comic) {

	$req = $bdd->prepare('SELECT co.titre, co.likes, co.date_creation, co.longueur, u.pseudo, co.libre FROM comic co, utilisateur u WHERE co.auteur = u.id AND co.id = ?');
	$req->execute(array($comic));

	if ($donnees = $req->fetch()) {
		
		$req->closeCursor();
		return $donnees;

	} else {

		$req->closeCursor();
		return 0;

	}

}

// Récupérer une case

function recuperer_case($bdd, $comic, $position) {

	$req = $bdd->prepare('SELECT c.id, c.position, c.votes, c.date_creation, c.image, u.pseudo FROM caze c, utilisateur u WHERE c.comic = ? AND c.auteur = u.id AND c.position = ? ORDER BY c.votes DESC LIMIT 1');
	$req->execute(array($comic, $position));

	if ($donnees = $req->fetch()) {
		
		$req->closeCursor();
		$donnees['position']++;
		return $donnees;

	} else {

		$req->closeCursor();
		return 0;

	}

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

	$req = $bdd->prepare('SELECT c.contenu, u.pseudo, c.date_heure FROM commentaire c, utilisateur u WHERE comic = ? AND c.auteur = u.id ORDER BY date_heure');
	$req->execute(array($comic));

	while ($donnees = $req->fetch()) {
		echo '<p>' . $donnees['contenu'] . '</p>';
		echo '<p class="commentaire">auteur : ' . $donnees['pseudo'] . ' --- ' . $donnees['date_heure'] . '</p>';

	}

	$req->closeCursor();
	return 1;

}

// Mise à jour comics par vote

function mise_a_jour($bdd) {

	return $bdd->exec('UPDATE comic
				 SET longueur = longueur + 1
				 WHERE id IN
				 	 (SELECT * FROM
						 (SELECT ca.comic
						  FROM caze ca, comic co
						  WHERE ca.position = co.longueur
						  AND ca.comic = co.id
						  GROUP BY ca.comic
						  HAVING COUNT(ca.id) > 0)
					  AS temp)
				 AND libre = 0');

}

// Récupérer cases potentielles

function recuperer_cases_potentielles($bdd, $comic) {

	$req = $bdd->prepare('SELECT ca.id, ca.votes, ca.date_creation, ca.image, u.pseudo
						  FROM caze ca, comic co, utilisateur u
						  WHERE ca.position = co.longueur
						  AND ca.auteur = u.id
						  AND ca.comic = co.id
						  AND co.id = ?
						  ORDER BY ca.votes DESC');
	
	$req->execute(array($comic));

	if ($req->rowCount() > 0) {

		$donnees_cases = $req->fetchAll();
		
		$req->closeCursor();
		return $donnees_cases;

	} else {

		$req->closeCursor();
		return 0;

	}

}


