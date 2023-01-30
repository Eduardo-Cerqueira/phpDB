<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['email'], $_POST['pseudo'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '/register.php');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/register.php');
}

if (empty($_POST['pseudo']) || strlen($_POST['pseudo']) > 100) {
	set_errors('Fullname invalide', '/register.php');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Message invalide', '/register.php');
}

$_POST['pseudo'] = htmlentities($_POST['pseudo'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['password'] = hash('sha256', $_POST['password']);

// retirer cpassword de $_POST
unset($_POST['cpassword']);

// DEBUG
// var_dump($_POST);
// die();

$query = $db->prepare('INSERT INTO users (email, pseudo, password) VALUES(:email, :pseudo, :password)');
$query->execute($_POST);

// bonus : si on veut connecte l'utilisateur immediatement
$_SESSION['user_id'] = $db->lastInsertId();

header('Location: /register.php');