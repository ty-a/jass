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
		if(!($prepared_statement = $db_handler->prepare("SELECT userId, password, isAdmin FROM user WHERE userName = ?"))) {
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
		$prepared_statement->bind_result($userId, $password_from_db, $isAdmin);
		$prepared_statement->fetch();
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