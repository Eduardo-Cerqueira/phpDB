<?php
require_once __DIR__ . '/../src/init.php';

if ($user_id === false) {
	header('Location: /login.php');
	die();
}

$page_title = 'User panel';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/user_transac_form.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/user_recap.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/user_depot_history.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/user_withdraw_history.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/user_transfert_history.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>