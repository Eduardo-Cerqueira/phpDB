<?php 

require_once __DIR__ . '/../src/init.php';

$errors = get_errors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<?php 
	if ($errors !== false) {
		echo '<p>'.$errors.'</p>';
	} ?>
	<form action="/actions/send_contact.php" method="post">
		Nom: 
		<input type="text" name="fullname"><br />
		email: 
		<input type="text" name="email"><br>
		Message:
		<textarea name="message" cols="30" rows="10"></textarea>
		<button type="submit" class="btn">Envoyer</button>
	</form>
</body>
</html>