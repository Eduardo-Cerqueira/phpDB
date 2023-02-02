<?php
if ($errors !== false) {
	echo '<p>'.$errors.'</p>';
} ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
<form action="/actions/login.php" method="post">
	Email : <input type="text" name="email"><br>
	Password : <input type="password" name="password"><br>
	<button type="submit">Login</button>
</form>