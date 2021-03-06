<?php

	function disableAccount( $userName, $db_handler ) {
		// http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		if(!($prepared_statement = $db_handler->prepare("UPDATE user set disabled=1 WHERE userName = ?"))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end prepare sql statement 
		
		// 's' shows that $username is a string
		if(!($prepared_statement->bind_param( 's', $userName))) {
			displayErrorMessage("Database error, please try again later.");
		return false;
		} // end bind params to statement
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end actually perform query
		
		return $prepared_statement->insert_id;
	}