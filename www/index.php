<?php
require_once __DIR__ . '/../src/init.php';

$pageTitles = [
	'login' => 'Se connecter',
	'register' => 'S\'inscire',
	'home' => 'Accueil',
	'admin_panel' => 'Manager panel',
	'user_panel' => 'User panel',
	'admin_register' => 'Manager register',
	'dashboard' => 'Dernières transactions'
];


// pages accessibles si on est pas co
$guest_pages = ['login', 'register'];
$loggedin_pages = ['user_panel', 'dashboard'];
// pages qui sont accessibles a tous
$everyone_pages = ['contact', 'home'];
// pages qui sont accessibles aux managers
$manager_pages = ['admin_panel', 'admin_register'];

// page par defaut si on est co ou pas

if(!isset($_GET['pageName'])){
	$pageName = "home";
} else{
	if ($user_id && in_array($_GET["pageName"], $loggedin_pages)) {
		$pageName = $_GET["pageName"];
	}
	elseif ($user_id === false && in_array($_GET["pageName"], $guest_pages)) {
		$pageName = $_GET["pageName"];
	}
	elseif (in_array($_GET["pageName"], $everyone_pages)) {
		$pageName = $_GET["pageName"];
	}
	elseif (in_array($_GET["pageName"], $manager_pages)) {
		$pageName = $_GET["pageName"];
	}
}

if(isset($_GET['pageName'])){
	$pageName = $_GET["pageName"];
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