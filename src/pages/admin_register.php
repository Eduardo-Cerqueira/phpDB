<?php

$errors = get_errors();


if ($errors !== false) {
	echo '<p>' . $errors . '</p>';
} ?>
<form action="/actions/admin_register.php" method="post" class="login-form">
	<span class="connexion">Manager</span>
	Pseudo : <input type="text" name="fullname"><br>
	Email : <input type="text" name="email"><br>
	Password : <input type="password" name="password"><br>
	C.Password : <input type="password" name="cpassword"><br>
	<button type="submit">Register</button>
</form>