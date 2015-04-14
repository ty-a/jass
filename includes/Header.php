<?php
function displayHeader( $pageTitle ) {
?>	
<html lang="en">
<head>
	<title><?php echo($pageTitle); ?> - JASS: Just Another Submission Site</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse">
			<div id="navbar">
				<div class="navbar-header">
					<ul class="nav navbar-nav navbar">
						<li><p class="navbar-text"><strong>JASS</strong></p></li>
						<li><a href="/index.php">Home</a></li>
						<li><a href="/submit.php">Submit</a></li>
						<li><a href="/admin.php">Admin</a></li>
						<?php
						if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
							?><li><a href="/logout.php">Logout</a></li>
							<li><p class="navbar-text">Logged in as: <?php echo($_SESSION['username']); ?></p></li> 
						<?php
						} else {
							?><li><a href="/login.php">Login</a></li> <?php
						} ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>
<?php } ?>