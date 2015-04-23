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
					<h2>Disable a User Account</h2>
					<label for="inputTitle" class="sr-only">User ID</label>
					<input type="text" id="userID" class="form-control" placeholder="UserID" name="userID" required autofocus>
					
					<label for="inputContent" class="sr-only">Reason</label>
					<textarea id="inputContent" class="form-control" placeholder="Type your reason here" rows="5" name="content" required></textarea>
					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
	}
displayFooter();