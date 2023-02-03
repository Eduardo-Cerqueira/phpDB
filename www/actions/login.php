<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['email'], $_POST['password'])) {
	set_errors('Pas de formulaire recu', '/login.php');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/login.php');
}

$password = hash('sha256', $_POST['password']);

// DEBUG
// var_dump($_POST);
// die();

$getby =  $dbManager->getBy('account','email',$_POST['email'],'Account');

if ($getby->password !== $password) {
	set_errors('Mauvais mot de passe', '/index.php?pageName=login');
}

$_SESSION['user_id'] = $getby->id;
$_SESSION['user_function'] = $getby->function;


header('Location: /index.php?pageName=home');