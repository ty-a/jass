<?php
function verify_hasnt_voted($submissionId, $userId, $db_handler) {
	// BEGIN Check if Username is free 
	// According to http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
	// Using prepared statements can help prevent SQL injection as the SQL statement is created
	// without the input to have it mess with it
	if(!($prepared_statement = $db_handler->prepare("SELECT * FROM votes WHERE userId = ? AND submissionId = ?"))) {
		die("{\"status\": \"error\", \"reason\": \"failed to prepare query\"}");
	} // end prepare sql statement 
	
	// 's' shows that $username is a string
	if(!($prepared_statement->bind_param( 'ss', $userId, $submissionId ))) {
		die("{\"status\": \"error\", \"reason\": \"failed to bind params\"}");
	} // end bind params to statement
	
	if(!$prepared_statement->execute()) {
		die("{\"status\": \"error\", \"reason\": \"failed to execute query\"}");
	} // end actually perform query
	
	$prepared_statement->store_result(); // store our result
	if($prepared_statement->num_rows == 1) {
		die("{\"status\": \"error\", \"reason\": \"already voted\"}");
	}
	return true;
}

function make_vote($submissionId, $userId, $vote, $db_handler) {
	if(!($prepared_statement = $db_handler->prepare("INSERT INTO votes(submissionId, userId, vote) VALUES (?,?,?)"))) {
		die("{\"status\": \"error\", \"reason\": \"failed to prepare query\"}");
	}
	
	if($vote == "up") {
		$x = 1;
	} else {
		$x = -1;
	}
	if(!($prepared_statement->bind_param( 'ssi', $submissionId, $userId, $x))) {
		die("{\"status\": \"error\", \"reason\": \"failed to bind params\"}");
	}
	
	if(!$prepared_statement->execute()) {
		die("{\"status\": \"error\", \"reason\": \"failed to execute query\"}");
	}
	
	return true;
}