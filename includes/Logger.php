<?php

	function Logger( $userID, $whatDo, $db_handler ) {
		// http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		if(!($prepared_statement = $db_handler->prepare("INSERT INTO logs(userID, action) VALUES (?,?)"))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
			} // end prepare sql statement 
		
		// 'ss' shows that $userName and $whatDo are strings
		if(!($prepared_statement->bind_param( 'ss', $userID, $whatDo))) {
			displayErrorMessage("Database error, please try again later.");
		return false;
		} // end bind params to statement
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end actually perform query
		
		return $prepared_statement->insert_id;
	}