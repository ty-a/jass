<!DOCTYPE html>
<?php
	require_once("includes/AutoLoader.php");
	require_once("includes/SubmitHelper.php");
	displayHeader( "Submit" );
	if(!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
		displayErrorMessage( "You are not logged in. Please <a href=\"login.php\">login</a> to submit a new submission.");
	} elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
		
		if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			global $db_host, $db_user, $db_password, $db_name;
			$hasError = false;
			$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);
			
			if( $db_handler->connect_error ) {
				displayErrorMessage("Unable to connect to Database, please try again later.");
				$hasError = true;
				if(!isset($_POST['title']) && empty($_POST['title'])) {
					displayErrorMessage("Please provide a title and <a href=\"submit.php\">try again</a>");
					$hasError = true;
				}
			}
				
			if(!isset($_POST['content']) && empty($_POST['content'])) {
				displayErrorMessage("Please provide a submission and <a href=\"submit.php\">try again</a>");
				$hasError = true;
			}
			
			if(!$hasError) {
				$id = addSubmission($_POST['title'], $_POST['content'], $db_handler);
				
				if( $id != 0 && $id !== false ) {
					Logger($_SESSION['userId'], "created new submission id " . $id,  $db_handler);
					displaySuccessMessage("Submission successfully submitted! It can be viewed at <a href=\"index.php?id=" . $id . "&limit=1\">here</a>");
				} 
			}
		} else { // show non-post form
			
	?> 
		<div class="container">
			<form class="form-inline">
				<div class="form-group center">
					<h2>Submit a new Submission</h2>
					<label for="inputTitle" class="sr-only">Title</label>
					<input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title" required autofocus>

					<label for="inputContent" class="sr-only">Submission Content</label>
					<textarea id="inputContent" class="form-control" placeholder="Type your submission here" rows="5" name="content" required></textarea>

					<button class="btn btn-large btn-primary btn-block" formmethod="post" type="submit" required>Submit</button>
				</div>
			</form>
		</div>
	<?php } 
	}
displayFooter();