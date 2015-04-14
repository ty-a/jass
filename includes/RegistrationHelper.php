<?php
	
	function validateUsername( $username, $db_handler ) {
		// BEGIN Check if Username is free 
		// According to http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		// Using prepared statements can help prevent SQL injection as the SQL statement is created
		// without the input to have it mess with it
		if(!($prepared_statement = $db_handler->prepare("SELECT userId FROM user WHERE userName = ?"))) {
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
		if($prepared_statement->num_rows == 1) {
			displayErrorMessage("Username is already in use, <a href=\"signup.php\">please try another one.</a>");
			return false;
		}
		
		return true;
	}
	
	function validatePassword( $password, $confirmPassword ) {
		if($password === $confirmPassword) {
			return true;
		} else {
			displayErrorMessage("Passwords do not match, <a href=\"signup.php\">please try again</a>");
			return false;
		}
	}
	
	function add_user_to_db( $username, $passwordhash, $db_handler ) {
		if(!($prepared_statement = $db_handler->prepare("INSERT INTO user(userName, password) VALUES (?,?)"))) {
			displayErrorMessage("Database error, please try again later. " . $db_handler->error . " " . $db_handler->errno);
			return false;
		}
		
		if(!($prepared_statement->bind_param( 'ss', $username, $passwordhash ))) {
			displayErrorMessage("Database error, please try again later. " . $prepared_statement->error . " " . $prepared_statement->errno);
			return false;
		}
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later. " . $prepared_statement->error . " " . $prepared_statement->errno);
			return false;
		} 
		
		$prepared_statement->store_result();
		if(!empty($prepared_statement->insert_id)) {
			return true;
		} else {
			return false;
		}
	}