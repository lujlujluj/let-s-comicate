<?php
if ($connecte) {

	?>
	<div class="case">

		<h2>Nouvelle case</h2>
		
		<form method=POST enctype="multipart/form-data">
			<p>
				<input type="file" name="image" /><br />
				<input type="submit" name="creer_case" class="submit" />
			</p>
		</form>
		
	</div>
	<?php

}
?>