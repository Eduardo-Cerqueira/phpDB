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

if(!isset($_GET['pageName'])){
	$pageName = "home";
}
/*if ($user_id === false) {
	$pageName = 'login';
}
else{
	$pageName = 'home';
}*/
else{
	if ($user_id !== false && in_array($_GET['pageName'], $loggedin_pages)) {
		$pageName = $_GET["pageName"];
	}
	elseif ($user_id === false && in_array($_GET['pageName'], $guest_pages)) {
		$pageName = $_GET['pageName'];
	}
	elseif (in_array($_GET['pageName'], $everyone_pages)) {
		$pageName = $_GET['pageName'];
	}
}
//verifier le contenu de $_GET['page'] ou $_GET['name']

$page_title = $pageTitles[$pageName];

require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/pages/' . $pageName . '.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>