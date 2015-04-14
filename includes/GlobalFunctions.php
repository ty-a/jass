<?php
	
	function displayErrorMessage( $text ) {
		?>
		<div class="container">
			<p class="bg-danger text-center"><?php echo( $text ) ?></p>
		</div>
		<?php
	}
	
	function displaySuccessMessage( $text ) {
		?>
		<div class="container">
			<p class="bg-success text-center"><?php echo( $text ) ?></p>
		</div>
		<?php
	}