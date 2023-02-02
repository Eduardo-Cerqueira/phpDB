<?php

require_once __DIR__ . '/../../src/init.php';


if (!isset($_POST['email'], $_POST['fullname'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '/register.php');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/register.php');
}

if (empty($_POST['fullname']) || strlen($_POST['fullname']) > 100) {
	set_errors('Fullname invalide', '/register.php');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Message invalide', '/register.php');
}

$_POST['fullname'] = htmlentities($_POST['fullname'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['password'] = hash('sha256', $_POST['password']);

// retirer cpassword de $_POST
unset($_POST['cpassword']);

// DEBUG
// var_dump($_POST);
// die();
$new_account = new Account();
$new_account->fullname = $_POST['fullname'];
$new_account->email = $_POST['email'];
$new_account->password = $_POST['password'];

$idInsertedAdvanced = $dbManager->insert_advanced($new_account);


// bonus : si on veut connecte l'utilisateur immediatement
$_SESSION['user_id'] = $db->lastInsertId();
set_errors('email ou pseudo déjà existant', '/register.php');
header('Location: /register.php');