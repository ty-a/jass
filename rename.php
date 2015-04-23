<!DOCTYPE html>

<?php
		require_once("includes/AutoLoader.php");
		displayHeader( "Admin" );
		
		if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) { //gives error message if not admin
		displayErrorMessage( "You are not allowed to view this page.");
	} elseif (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) { //if admin it will show the page
	
	?> 
	
	<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Rename a User Account</h2>
					<label for="inputTitle" class="sr-only">Old User Name</label>
					<input type="text" id="userID" class="form-control" placeholder="oldName" name="newName" required autofocus>
					
					<label for="inputTitle" class="sr-only">New User Name</label>
					<input type="text" id="newName" class="form-control" placeholder="newName" name="newName" required>
					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
	}
displayFooter();