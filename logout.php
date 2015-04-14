<?php
require_once("includes/AutoLoader.php");

displayHeader( "Logout" );

// http://php.net/manual/en/function.session-destroy.php
$_SESSION = array();
session_destroy();

$cookie_params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000, $cookie_params["path"], $cookie_params["domain"],
	$cookie_params["secure"], $cookie_params["httponly"]);

// redirect user back to homepage, and if they aren't redirected, give them a message and link
header("Location: index.php");
displaySuccessMessage("You have successfully logged out, if you are not automatically redirected, please <a href=\"index.php\">click here</a>.");
?>
