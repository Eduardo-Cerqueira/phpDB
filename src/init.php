<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// class
require_once __DIR__ . '/class/DbObject.php';
require_once __DIR__ . '/class/ContactForm.php';
require_once __DIR__ . '/class/User.php';

// db manager
require_once __DIR__ . '/class/DbManager.php';

$dbManager = new DbManager($db);

require_once __DIR__ . '/utils/errors.php';
require_once __DIR__ . '/utils/auth.php';


$user_id = get_session_user();
$user = false;
if ($user_id !== false) {
	$user = get_user_by_id($user_id);
}
