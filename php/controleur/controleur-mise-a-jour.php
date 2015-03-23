<?php

require_once 'php/modele/modele.php';

$bdd = connexion_bdd();

$nb_affectes = mise_a_jour($bdd);

echo 'OK :) / ' . $nb_affectes . ' modification(s)';

?>