<?php

if (isset($_POST['liker_comic'])) {

	liker_comic($bdd, 1);

}

if (isset($_POST['liker_case'])) {

	liker_case($bdd, 1);

}

if (isset($_POST['nouveau_commentaire'])) {

	nouveau_commentaire($bdd, 1, 1, $_POST['contenu']);

}

?>