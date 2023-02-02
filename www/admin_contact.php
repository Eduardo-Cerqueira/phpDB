<?php

require_once __DIR__ . '/../src/init.php';

// verify if user is connected
// verify is admin

$query = $db->prepare('SELECT * FROM contactforms');
$query->execute();
$query->setFetchMode(PDO::FETCH_ASSOC);
$forms = $query->fetchAll();

echo '<pre>';
var_dump($forms);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Contacts</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<?php

?>
<body>
	<?php
	foreach($forms as $form) {
		echo '<p>'. $form['fullname'].'</p>';
		echo '<p>'. $form['message'].'</p>';
	} ?>

	<?php
	for($i = 0; $i < count($forms); $i++) {
		$form = $forms[$i];
		echo '<p>'. $form['fullname'].'</p>';
		echo '<p>'. $form['message'].'</p>';
	}
	?>
</body>
</html>