<!DOCTYPE html>
<?php
require_once("includes/AutoLoader.php");
require_once("includes/IndexHelper.php");
displayHeader( "Home" );

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

$submissions = get_submissions($offset, $limit);


?>
	<div class="container">
	
	<ol id="submission-list" class="feed">
	
		<?php 
		foreach($submissions as $submission) {
			show_submission(
				$submission["submissionId"], 
				$submission["userName"],
				$submission["title"],
				$submission["content"],
				$submission["date"]
			);
		}
		?>
	</ol>
		<nav>
			<ul class="pager">
				<li><a href="?offset=<?php echo($offset - $limit); ?>&limit=<?php echo($limit); ?>">Previous</a></li>
				<li><a href="?offset=<?php echo($offset + $limit); ?>&limit=<?php echo($limit); ?>">Next</a></li>
			</ul>
		</nav>
	</div>
<?php
displayFooter();