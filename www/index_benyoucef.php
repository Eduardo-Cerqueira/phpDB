<?php
require_once __DIR__ . '/../src/init.php';

$pageTitles = [
	'login' => 'Se connecter',
	'register' => 'S\'inscire',
	'home' => 'Accueil',
	'contact' => 'Contactez-nous'
];

// pages accessibles si on est pas co
$guest_pages = ['login', 'register'];
// pages accessibles si on est co:
$loggedin_pages = ['home'];
// pages qui sont accessibles a tous
$everyone_pages = ['contact'];

// page par defaut si on est co ou pas
if ($user_id === false) {
	$pageName = 'login';
}
else{
	$pageName = 'home';
}

// verifier le contenu de $_GET['page'] ou $_GET['name']
if ($user_id !== false && in_array($_GET['name'], $loggedin_pages)) {
	$pageName = $_GET["name"];
}
elseif ($user_id === false && in_array($_GET['name'], $guest_pages)) {
	$pageName = $_GET['name'];
}
elseif (in_array($_GET['name'], $everyone_pages)) {
	$pageName = $_GET['name'];
}

$page_title = $pageTitles[$pageName];

require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/pages/' . $pageName . '.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>