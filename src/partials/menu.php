<ul class="nav-header">
	<li>
		<a href="/index.php?pageName=home">Accueil</a>
	</li>
	<?php
	if ($user) {
	?>
		<?php
		if ($user['function'] == 1000) { ?>
			<li>
				<a href="/index.php?pageName=admin_panel">Admin panel</a>
			</li>
		<?php }else{ ?>
			<li>
				<a href="/index.php?pageName=user_panel">User panel</a>
			</li>
			<li>
				<a href="/index.php?pageName=dashboard&page=0">dashboard</a>
			</li>
			<li>
				<a href="/index.php?pageName=convert">conversions</a>
			</li>
		<?php } ?>
		<li>
			<a href="/actions/logout.php">Logout</a>
		</li>
	<?php } else { ?>
		<li>
			<a href="/index.php?pageName=login">Login</a>
		</li>
		<li>
			<a href="/index.php?pageName=register">Register</a>
		</li>
	<?php } ?>
</ul>