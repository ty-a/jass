<?php

	function deleteSubmission( $submissionID, $db_handler ) {
		// http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		if(!($prepared_statement = $db_handler->prepare("DELETE FROM submissions WHERE submissionID = ?"))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end prepare sql statement 
		
		// 's' shows that $username is a string
		if(!($prepared_statement->bind_param( 'i', $submissionID))) {
			displayErrorMessage("Database error, please try again later.");
		return false;
		} // end bind params to statement
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end actually perform query
		
		return $prepared_statement->insert_id;
	}