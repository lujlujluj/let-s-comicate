<div id="commentaires">

	<h2>Commentaires</h2>

	<?php afficher_commentaires_comic($bdd, $comic); ?>

	<?php
	if ($connecte) {

		?>
		<form method=POST>
			<p>
				<h2>Poster un commentaire</h2>
				<textarea name="contenu" id="contenu"></textarea><br />
				<input type="submit" name="nouveau_commentaire_comic" class="submit" />
			</p>
		</form>
		<?php

	}
	?>

</div>