<?php 
require_once __DIR__ . '/../src/init.php';

if ($user_id) {
	header('Location: /index.php');
	die();
}

$errors = get_errors();

$page_title = 'Register TEST';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php
	if ($errors !== false) {
		echo '<p>'.$errors.'</p>';
	} ?>
	<form action="/actions/register.php" method="post">
		Pseudo : <input type="text" name="fullname"><br>
		Email : <input type="text" name="email"><br>
		Password : <input type="password" name="password"><br>
		C.Password : <input type="password" name="cpassword"><br>
		<button type="submit">Register</button>
	</form>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>