<?php
function verify_hasnt_voted($submissionId, $userId, $db_handler) {
	// BEGIN Check if Username is free 
	// According to http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
	// Using prepared statements can help prevent SQL injection as the SQL statement is created
	// without the input to have it mess with it
	if(!($prepared_statement = $db_handler->prepare("SELECT * FROM votes WHERE userId = ? AND submissionId = ?"))) {
		die("database error");
	} // end prepare sql statement 
	
	// 's' shows that $username is a string
	if(!($prepared_statement->bind_param( 'ss', $userId, $submissionId ))) {
		die("database error");
	} // end bind params to statement
	
	if(!$prepared_statement->execute()) {
		die("database error");
	} // end actually perform query
	
	$prepared_statement->store_result(); // store our result
	if($prepared_statement->num_rows == 1) {
		die("already voted");
	}
	return true;
}

function make_vote($submissionId, $userId, $vote, $db_handler) {
	if(!($prepared_statement = $db_handler->prepare("INSERT INTO votes(submissionId, userId, vote) VALUES (?,?,?)"))) {
		die("database error");
	}
	
	if($vote == "up") {
		$x = 1;
	} else {
		$x = -1;
	}
	if(!($prepared_statement->bind_param( 'ssi', $submissionId, $userId, $x))) {
		die("database error - bind");
	}
	
	if(!$prepared_statement->execute()) {
		die("database error - execute");
	}
	
	return true;
}