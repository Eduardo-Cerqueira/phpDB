<?php

require_once __DIR__ . '/../../src/init.php';


unset($errors);

if (!isset($_POST['email'], $_POST['password'])) {
	set_errors('Pas de formulaire recu', '/index.php?pageName=login');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/index.php?pageName=login');
}

if(!$dbManager->getBy('account','email',$_POST['email'],'Account')->id){
	set_errors('Email invalide', '/index.php?pageName=login');
}

$password = hash('sha256', $_POST['password']);

// DEBUG
//var_dump($_POST);
//die();

$getby =  $dbManager->getBy('account','email',$_POST['email'],'Account');

if ($getby->password !== $password) {
	set_errors('Mauvais mot de passe', '/index.php?pageName=login');
}

$_SESSION['user_id'] = $getby->id;
$_SESSION['user_function'] = $getby->function;


header('Location: /index.php?pageName=home');