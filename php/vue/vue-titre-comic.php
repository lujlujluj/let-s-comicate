<div class="titre">

	<h2><?php echo $donnees['titre']; ?></h2>
		
	<?php
	if ($connecte) {

		?>
		<form method=POST>
			<p><?php echo $donnees['likes']; ?> likes <input type="submit" name="liker_comic" class="submit inline" value="Liker" /></p>
		</form>
		<?php

	} else {
		
		?>
		<p><?php echo $donnees['likes']; ?> likes</p>
		<?php

	}
	?>

	<p>Créé le <?php echo $donnees['date_creation']; ?></p>
	<p>Auteur : <?php echo $donnees['pseudo']; ?></p>

</div>