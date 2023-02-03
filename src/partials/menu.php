<ul class="nav-header">
	<?php
	if ($user) {
	?>
		<li>
			<a href="/index.php">Accueil</a>
		</li>
		<?php
		if ($user['function'] == 1000) { ?>
			<li>
				<a href="/admin_panel.php">Admin panel</a>
			</li>
		<?php }else{ ?>
			<li>
				<a href="/user_panel.php">User panel</a>
			</li>
		<?php } ?>
		<li>
			<a href="/actions/logout.php">Logout</a>
		</li>
	<?php } else { ?>
		<li>
			<a href="/login.php">Login</a>
		</li>
		<li>
			<a href="/register.php">Register</a>
		</li>
	<?php } ?>
</ul>