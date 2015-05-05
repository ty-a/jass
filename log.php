<!DOCTYPE html>
<?php
require_once("includes/AutoLoader.php");
require_once("includes/logViewerHelper.php");
displayHeader( "Admin");

if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) { //gives error message if not admin
		displayErrorMessage( "You are not allowed to view this page.");
	} elseif (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) { //if admin it will show the page

// maximum amount of submissions per page, default 10
if(isset($_GET['limit']) && $_GET['limit'] < 100 && $_GET['limit'] > 0 ) {
	$limit = $_GET['limit'];
} else {
	$limit = 10;
}

// if user provides a offset, use that
if(isset($_GET['offset']) && $_GET['offset'] > -1) {
	$offset = $_GET['offset'];
} else {
	$offset = 0;
}

if(isset($_GET['id'])) {
	$limit = 1;
	$offset = $_GET['id'] - 1;
}

$logs = get_logs($offset, $limit);


?>
	<div class="container">
	
	<ul id="logs-list" class="feed">
	
		<?php 
		foreach($logs as $logs) {
			show_logs(
				$logs["logID"], 
				$logs["userName"],
				$logs["action"]
				
			);
		}
		?>
	</ul>
		<nav>
			<ul class="pager">
				<li><a href="?offset=<?php echo($offset - $limit); ?>&limit=<?php echo($limit); ?>">Previous</a></li>
				<li><a href="?offset=<?php echo($offset + $limit); ?>&limit=<?php echo($limit); ?>">Next</a></li>
			</ul>
		</nav>
	</div>
<?php
}
displayFooter();