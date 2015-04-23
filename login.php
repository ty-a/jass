<!DOCTYPE html>
<?php
	require_once("includes/AutoLoader.php");
	require_once("includes/LoginHelper.php");

	displayHeader( "Login" );
	if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
		displayErrorMessage("You are already logged in.");
	} else if( $_SERVER['REQUEST_METHOD'] === 'POST' ) { // we have been posted
		global $db_host, $db_user, $db_password, $db_name;
		$hasError = false;
		$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);
		if( $db_handler->connect_error ) {
			displayErrorMessage("Unable to connect to Database, please try again later.");
			$hasError = true;
		}
		
		$username = $_POST['username'];
		if(!(confirmUsernameNotEmpty( $username ))) {
			$hasError = true;
		}
		
		if(!(confirmPasswordNotEmpty( $_POST['password'] ))) {
			$hasError = true;
		}
		
		if(!$hasError) {
			if(performLogin( $username, $_POST['password'], $db_handler )) {
				displaySuccessMessage("Logged in successfully!");
			}
		}
	
	} else { 
		?> 
		<div class="container">
			<form class="form-signin">
				<h2 class="form-signin-heading">Please Login</h2>
				<label for="inputUserName" class="sr-only">Username</label>
				<input type="text" id="inputUserName" class="form-control" placeholder="Username" name="username" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
				<button class="btn btn-lg btn-primary btn-block" formmethod="post" type="submit">Login</button>
			
				<p class="text-center">Don't have an account? <a href="signup.php">Sign up for one!</a></p>
			</form>
		</div>
	<?php }
displayFooter();