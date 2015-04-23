<?php

	function show_submission($content_id, $username, $content_title, $content, $date) {
		?><li class="well">
			<h2 class="submission-title"><?php echo($content_title) ?></h2>
			
			<p><?php echo($content) ?></p>
			
			<div class="text-muted text-right">-- <?php echo($username) ?>, <?php echo($date) ?></div>
			
			<p class="text-right;"><a href="/index.php?id=<?php echo($content_id)?>" title="Permalink">Permalink</a></p>
		
		</li><?php
		
	}
	
	function get_submissions($offset, $limit) {
		$submissions = array();
		// http://php.net/manual/en/mysqli.query.php
		
		global $db_host, $db_user, $db_password, $db_name;
		$db_handler = new mysqli($db_host, $db_user, $db_password, $db_name);
		
		// totes sql injection problem spot, should totes fix later
		$sql = "SELECT submissionId, title, content, userName, submissionDate FROM submissions, user WHERE user.userId = submissions.userId AND submissionId > " . $offset . " LIMIT " . $limit;
		
		if($result = $db_handler->query($sql)) {
			
			while($row = $result->fetch_row()) {
				$submissions[] = array (
					"submissionId" => $row[0],
					"title" => $row[1],
					"content" => $row[2],
					"userName" => $row[3],
					"date" => $row[4]
				);
			}
		}
		
		return $submissions;
	}