<?php
if ($errors !== false) {
	echo '<p>'.$errors.'</p>';
} ?>
<form action="/actions/login.php" method="post" class="login-form">
	<span class="connexion">Connexion</span>
	Email : <input type="text" name="email"><br>
	Password : <input type="password" name="password"><br>
	<button type="submit">Login</button>
</form>