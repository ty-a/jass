<!DOCTYPE html>

<?php
		require_once("includes/AutoLoader.php");
		require_once("includes/renameHelper.php");
		displayHeader( "Admin" );
		
		if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) { //gives error message if not admin
		displayErrorMessage( "You are not allowed to view this page.");
	} elseif (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) { //if admin it will show the page
			
			if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			global $db_host, $db_user, $db_password, $db_name;
			$hasError = false;
			$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);
			
			if( $db_handler->connect_error ) {
				displayErrorMessage("Unable to connect to Database, please try again later.");
				$hasError = true;
				if(!isset($_POST['oldUserName']) && empty($_POST['oldUserName'])) {
					displayErrorMessage("Please provide the Old Username and <a href=\"rename.php\">try again</a>");
					$hasError = true;

				}
				if(!isset($_POST['newUserName']) && empty($_POST['newUserName'])) {
					displayErrorMessage("Please provide the New Username and <a href=\"rename.php\">try again</a>");
					$hasError = true;
				}
			}
			$oldUser = $_POST['oldUserName'];
			$newUser = $_POST['newUserName'];
			if(!$hasError) {
				$id = renameAccount($oldUser, $newUser,  $db_handler);
				$id = Logger($_SESSION['userId'], $oldUser." was renamed to ".$newUser,  $db_handler);
				
				if($id !== false ) {
					displaySuccessMessage("User was successfully renamed.");
				} 
			}
		} 
		
	?> 
	
	<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Rename a User Account</h2>
					<label for="inputTitle" class="sr-only">Old User Name</label>
					<input type="text" id="userID" class="form-control" placeholder="oldName" name="oldUserName" required autofocus>
					
					<label for="inputTitle" class="sr-only">New User Name</label>
					<input type="text" id="newName" class="form-control" placeholder="newName" name="newUserName" required>
					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
	}
displayFooter();