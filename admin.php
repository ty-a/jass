<!DOCTYPE html>
<?php
	require_once("includes/AutoLoader.php");
	displayHeader( "Admin" );
	
	if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) { //gives error message if not admin
		displayErrorMessage( "You are not allowed to view this page.");
	} elseif (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) { //if admin it will show the page
	
	?> 
		<div class="container">

			<h2>Admin Functions</h2>
			<ul>
				<li><a href="/delete.php">Delete a submission</a></li>
				<li><a href="/disable.php">Disable a user account</a></li>
				<li><a href="/log.php">View Admin Logs</a></li>
				<li><a href="/rename.php">Rename a user account</a></li>
			</ul>

		</div>
<?php }
displayFooter();

?>