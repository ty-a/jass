<?php
require_once("includes/AutoLoader.php");
require_once("includes/VoteHelper.php");

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && $_SERVER['REQUEST_METHOD'] === 'POST') {
	
} else {
	die("{\"status\": \"error\", \"reason\": \"not logged in or not POST'd\"}");
}

if(isset($_GET['submissionId']) && !empty($_GET['submissionId'])) {
	$submissionId = $_GET['submissionId'];
} else {
	die("{\"status\": \"error\", \"reason\": \"no submission id\"}");
}

if(isset($_GET['vote']) && ($_GET['vote'] == "up" || $_GET['vote'] == "down")) {
	$vote = $_GET['vote'];
} else {
	die("{\"status\": \"error\", \"reason\": \"no vote\"}");
}

global $db_host, $db_user, $db_password, $db_name;
$db_handler = mysqli_connect($db_host, $db_user, $db_password, $db_name);

verify_hasnt_voted($submissionId, $_SESSION['userId'], $db_handler);

if(make_vote($submissionId, $_SESSION['userId'], $vote, $db_handler)) {
	die("{\"status\": \"success\", \"count\": \"" . get_submission_vote_count($submissionId) .  "\"}");
}