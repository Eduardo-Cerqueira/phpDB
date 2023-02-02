<?php

require_once __DIR__ . '/../src/init.php';

$page_title = 'Accueil';
require_once __DIR__ . '/../src/partials/header.php';
?>

<body>
    <?php require_once __DIR__ . '/../src/pages/admin_dashboard.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>