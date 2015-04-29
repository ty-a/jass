<?php

	function confirmUsernameNotEmpty( $username ) {
		if(empty($username)) {
			displayErrorMessage("No username provided, <a href=\"login.php\">please try again.</a>");
			return false;
		} else {
			return true;
		}
	}
	
	function confirmPasswordNotEmpty( $password ) {
		if(empty($password)) {
			displayErrorMessage("No password provided, <a href=\"login.php\">please try again.</a>");
			return false;
		} else {
			return true;
		}
	}
	
	function performLogin( $username, $password, $db_handler ) {
		// http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		if(!($prepared_statement = $db_handler->prepare("SELECT userId, password, isAdmin, disabled FROM user WHERE userName = ?"))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end prepare sql statement 
		
		// 's' shows that $username is a string
		if(!($prepared_statement->bind_param( 's', $username ))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end bind params to statement
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end actually perform query
		
		$prepared_statement->store_result(); // store our result
		if($prepared_statement->num_rows == 0) {
			displayErrorMessage("Username does not exist, <a href=\"login.php\">please try again.</a>");
			return false;
		}
		$prepared_statement->bind_result($userId, $password_from_db, $isAdmin, $isDisabled);
		$prepared_statement->fetch();
		
		if($isDisabled) {
			displayErrorMessage("Your account has been disabled<br /> due to abuse or by request.");
			return false;
		}
		
		if(!password_verify($password, $password_from_db)) {
			displayErrorMessage("Invalid password, <a href=\"login.php\">please try again.</a>");
			return false;
		} else {
			$_SESSION['username'] = $username;
			$_SESSION['userId'] = $userId;
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['isAdmin'] = $isAdmin;
		}
		return true;
	}