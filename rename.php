<!DOCTYPE html>

<?php
		require_once("includes/AutoLoader.php");
		displayHeader( "Admin" );
	?> 
	
	<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Rename a User Account</h2>
					<label for="inputTitle" class="sr-only">User ID</label>
					<input type="text" id="userID" class="form-control" placeholder="UserID" name="userID" required autofocus>
					
					<label for="inputTitle" class="sr-only">New Name</label>
					<input type="text" id="newName" class="form-control" placeholder="newName" name="newName" required>
					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
displayFooter();