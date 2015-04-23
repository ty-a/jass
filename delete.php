<!DOCTYPE html>
	<?php
		require_once("includes/AutoLoader.php");
		displayHeader( "Admin" );
	?> 		
	
		<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Delete a submission</h2>
					<label for="inputTitle" class="sr-only">Submission ID</label>
					<input type="text" id="inputID" class="form-control" placeholder="SubmissionID" name="submissionID" required autofocus>

					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
displayFooter();