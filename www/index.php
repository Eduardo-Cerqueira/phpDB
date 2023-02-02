<?php
require_once __DIR__ . '/../src/init.php';
if ($user_id === false) {
	header('Location: /login.php');
	die();
}

$page_title = 'Accueil';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/home.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>