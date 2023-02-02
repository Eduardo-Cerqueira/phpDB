<?php
require_once __DIR__ . '/../src/init.php';

$admin = $dbManager->select('SELECT * FROM account WHERE function = 1000', 'Account');

if (empty($admin)) {
    header('Location: /admin_register.php');
}elseif($_SESSION['user_function'] != 1000){
    header('Location: /login.php');
}



$page_title = 'Accueil';
require_once __DIR__ . '/../src/partials/header.php';

?>

<body>
    <?php require_once __DIR__ . '/../src/pages/admin_dashboard.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>