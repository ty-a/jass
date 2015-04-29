<?php
	
	function displayErrorMessage( $text ) {
		?>
		<div class="container">
			<p class="bg-danger text-center"><?php echo( $text ) ?></p>
		</div>
		<?php
	}
	
	function displaySuccessMessage( $text ) {
		?>
		<div class="container">
			<p class="bg-success text-center"><?php echo( $text ) ?></p>
		</div>
		<?php
	}
	
	function get_username_from_userid($user_id) {
		global $db_host, $db_user, $db_password, $db_name;
		$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);
		
		// http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
		if(!($prepared_statement = $db_handler->prepare("SELECT userName FROM user WHERE userId = ?"))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end prepare sql statement 
		
		// 's' shows that $username is a string
		if(!($prepared_statement->bind_param( 'i', $user_id ))) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end bind params to statement
		
		if(!$prepared_statement->execute()) {
			displayErrorMessage("Database error, please try again later.");
			return false;
		} // end actually perform query
		
		$prepared_statement->store_result(); // store our result
		if($prepared_statement->num_rows == 0) {
			return false;
		}
		$prepared_statement->bind_result($username);
		$prepared_statement->fetch();
		
		return $username;
	}
	
	function get_submission_vote_count($submissionId) {
		global $db_host, $db_user, $db_password, $db_name;
		$db_handler = new mysqli($db_host, $db_user, $db_password, $db_name);
		
		// totes sql injection problem spot, should totes fix later
		$sql = "SELECT sum(vote) FROM votes WHERE submissionId = " . $submissionId;

		if($result = $db_handler->query($sql)) {
			$row = $result->fetch_row();
			$count = $row[0];
		}
		
		if(empty($count)) {
			$count = 0;
		}
		
		return $count;
	}