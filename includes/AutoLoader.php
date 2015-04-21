<?php
define("JASS", 1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_name("JassSession");
session_start();
$autoLoadClasses = array(
	'config.php',
	'includes/Header.php',
	'includes/GlobalFunctions.php'
);

foreach($autoLoadClasses as $class) {
	require($class);
}