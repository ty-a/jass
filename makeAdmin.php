<!DOCTYPE html>
	<?php
		require_once("includes/AutoLoader.php");
		require_once("includes/makeAdminHelper.php");
		
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
				if(!isset($_POST['userName']) && empty($_POST['userName'])) {
					displayErrorMessage("Please provide the Username and <a href=\"makeAdmin.php\">try again</a>");
					$hasError = true;
				}
			}
			$userName = $_POST['userName'];
							
			if(!$hasError) {
				$id = makeAdmin($userName,  $db_handler);
				$id = Logger($_SESSION['userId'], $userName." was promoted to admin",  $db_handler);
				
				
				if($id !== false ) {
					displaySuccessMessage("User was successfully made an admin.");
				} 
			}
		} 
		
	?> 		
	
		<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Promote a User</h2>
					<label for="inputTitle" class="sr-only">Username</label>
					<input type="text" id="inputID" class="form-control" placeholder="userName" name="userName" required autofocus>

					
					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
<?php
}
displayFooter();