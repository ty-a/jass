<!DOCTYPE html>
<?php
	require_once("includes/AutoLoader.php");
	displayHeader( "Admin" );
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
<?php
displayFooter();