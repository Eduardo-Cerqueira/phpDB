<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['fullname'], $_POST['email'], $_POST['message'])) {
	set_errors('Pas de formulaire recu', '/contact.php');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/contact.php');
}

if (empty($_POST['fullname']) || strlen($_POST['fullname']) > 100) {
	set_errors('Fullname invalide', '/contact.php');
}

if (empty($_POST['message']) || strlen($_POST['message']) > 1000) {
	set_errors('Message invalide', '/contact.php');
}

$_POST['fullname'] = htmlentities($_POST['fullname'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['message'] = htmlentities($_POST['message'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);

$query = $db->prepare('INSERT INTO contactforms (fullname, email, message) VALUES(:fullname, :email, :message)');
// $query->execute([
// 	'fullname' => $_POST['fullname'],
// 	'email' => $_POST['email'],
// 	'message' => $_POST['message']
// ]);
$query->execute($_POST);

header('Location: /contact.php');