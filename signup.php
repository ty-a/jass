<!DOCTYPE html>
<?php
require_once("includes/AutoLoader.php");
require_once("includes/RegistrationHelper.php");
displayHeader("Signup");

	if( $_SERVER['REQUEST_METHOD'] === 'POST' ) { // we have been posted
		global $db_host, $db_user, $db_password, $db_name;
		$hasError = false;
		$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);
		if( $db_handler->connect_error ) {
			displayErrorMessage("Unable to connect to Database, please try again later.");
			return;
		}
		$username = $_POST['username'];
		if(!validateUsername( $username, $db_handler )) {
			$hasError = true;
		}
		// END Check if Username is free
		
		if(!validatePassword($_POST['password'], $_POST['confirmPassword'])) {
			$hasError = true;
		}  else { // good password
			$passwordhash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		
		if(!isset($_POST['i-agree-to-behave'])) {
			displayErrorMessage("Please agree to behave and <a href=\"signup.php\">try again</a>");
			$hasError = true;
		} // user agrees to behave
		
		// If we have not encountered an error, we will add the user to the DB
		if(!$hasError) {
			if(add_user_to_db($username, $passwordhash, $db_handler)) {
				displaySuccessMessage("Account successfully created! <a href=\"login.php\">Please login!</a>");
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
			
			<label for="inputConfirmPassword" class="sr-only">Password</label>
			<input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" name="confirmPassword" required>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" value="true" name="i-agree-to-behave">I agree to behave
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit" formmethod="post">Login</button>
		</form>
	</div>
	<?php }
displayFooter();