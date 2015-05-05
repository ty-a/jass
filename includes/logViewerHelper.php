<?php

	function show_logs($content_id, $username, $content) {
		?><li><?php echo($content);?> by <?php echo($username);?> <a href="/log.php?id=<?php echo($content_id)?>" title="Permalink">Permalink</a></li><?php
		
	}
	
	function get_logs($offset, $limit) {
		$logs = array();
		// http://php.net/manual/en/mysqli.query.php
		
		global $db_host, $db_user, $db_password, $db_name;
		$db_handler = new mysqli($db_host, $db_user, $db_password, $db_name);
		
		$sql = "SELECT LogID, logs.userId, action, userName FROM logs, user WHERE user.userId = logs.userId AND logID > " . $offset . " LIMIT " . $limit;
		
		if($result = $db_handler->query($sql)) {
			
			while($row = $result->fetch_row()) {
				$logs[] = array (
					"logID" => $row[0],
					"UserId" => $row[1],
					"action" => $row[2],
					"userName" => $row[3]
					);
			}
		}
		
		return $logs;
	}