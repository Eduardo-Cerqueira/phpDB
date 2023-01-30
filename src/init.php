<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

require_once __DIR__ . '/utils/errors.php';
require_once __DIR__ . '/utils/auth.php';


$user_id = get_session_user();
$user = false;
if ($user_id !== false) {
	$user = get_user_by_id($user_id);
}
