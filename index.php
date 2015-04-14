<!DOCTYPE html>
<?php
require_once("includes/AutoLoader.php");
displayHeader( "Home" );
?>
	<div class="container">
	
	<ol id="submission-list" class="feed">
		<li class="well">
			<h2 class="submission-title">Title</h2>
			
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu leo dictum, placerat ante id, lacinia mauris. Vivamus sed sem nisi. Vestibulum volutpat, arcu convallis vehicula consequat, leo nulla sodales arcu, non ullamcorper nunc ante in odio. Duis sodales enim elit, ut congue dui pharetra at. Proin consectetur dapibus nulla non maximus. Nullam nec ipsum in sapien vestibulum volutpat nec et sem. Proin pretium lacinia lectus. Fusce auctor at risus eu varius. Nullam non quam cursus orci tristique commodo. Vestibulum lorem ipsum, tincidunt in commodo at, porta non lorem. Ut lobortis purus non neque tempor facilisis. Donec mattis neque nec eros malesuada mattis. Sed cursus lobortis rhoncus. Integer finibus urna quis tristique congue. Ut ultrices mattis enim, quis blandit justo porttitor rhoncus.</p>
			
			<div class="text-muted text-right">-- Author Name, date</div>
			
			<p class="text-right;"><a href="/submission.php?id=x" title="Permalink">Permalink</a></p>
		
		</li>
	</ol>
		<nav>
			<ul class="pager">
				<li><a href="#">Previous</a></li>
				<li><a href="#">Next</a></li>
			</ul>
		</nav>
	</div>
	<footer class="footer">
		<div class="container">
			<p class="text-muted">JASS was created for a school DB project. Ironically, the DB is the smallest part of the project.</p>
		</div>
	</footer>
	
</body>
</html>