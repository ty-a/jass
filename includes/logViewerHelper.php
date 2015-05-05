<?php

	function show_logs($content_id, $username, $content_title, $content) {
		?><li class="well">
			<h2 class="log-title"><?php echo($content_title) ?></h2>
			<?php $wordWrapContent = wordwrap($content, 40, "<br />\n"); ?>
			<p><?php echo($wordWrapContent) ?></p>
			
			<div class="text-muted text-right">-- <?php echo($username) ?>, </div>
			
			<p class="text-right;"><a href="/index.php?id=<?php echo($content_id)?>" title="Permalink">Permalink</a> &bull; </p>
		
		</li><?php
		
	}
	
	function get_logs($offset, $limit) {
		$logs = array();
		// http://php.net/manual/en/mysqli.query.php
		
		global $db_host, $db_user, $db_password, $db_name;
		$db_handler = new mysqli($db_host, $db_user, $db_password, $db_name);
		
		// totes sql injection problem spot, should totes fix later
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