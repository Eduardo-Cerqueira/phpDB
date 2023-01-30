<?php 
require_once __DIR__ . '/../src/init.php';

if ($user_id) {
	header('Location: /index.php');
	die();
}

$errors = get_errors();

$page_title = 'Login';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php
	if ($errors !== false) {
		echo '<p>'.$errors.'</p>';
	} ?>
	<form action="/actions/login.php" method="post">
		Email : <input type="text" name="email"><br>
		Password : <input type="password" name="password"><br>
		<button type="submit">Login</button>
	</form>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>