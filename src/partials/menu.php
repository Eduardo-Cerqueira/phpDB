<ul>
	<?php 
	if ($user) {
	?>
	<li>
		<a href="/index.php">Accueil</a>
	</li>
	<li>
		<a href="/actions/logout.php">Logout</a>
	</li>
	<?php }
	else { ?>
	<li>
		<a href="/login.php">Login</a>
	</li>
	<li>
		<a href="/register.php">Register</a>
	</li>
	<?php } ?>
</ul>