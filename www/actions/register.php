<?php

require_once __DIR__ . '/../../src/init.php';

unset($errors);

if (!isset($_POST['email'], $_POST['fullname'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '/index.php?pageName=register');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/index.php?pageName=register');
}

if($dbManager->getBy('account','email',$_POST['email'],'Account')->id){
	set_errors('Email invalide', '/index.php?pageName=register');
}

if (empty($_POST['fullname']) || strlen($_POST['fullname']) > 100) {
	set_errors('Fullname invalide', '/index.php?pageName=register');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Mot de passe invalide', '/index.php?pageName=register');
}


$_POST['fullname'] = htmlentities($_POST['fullname'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['password'] = hash('sha256', $_POST['password']);

#genération iban
function genereriban(){
 $caracter = '0123456789';
 $chaine = 'FR';
 for ($i = 0; $i < 25; ++$i) {
 $chaine .= $caracter[rand(0, 9)];
 }
 return $chaine;
}



// retirer cpassword de $_POST
unset($_POST['cpassword']);

// DEBUG
// var_dump($_POST);
// die();
$new_account = new Account();
$new_account->fullname = $_POST['fullname'];
$new_account->email = $_POST['email'];
$new_account->password = $_POST['password'];
$new_account->IBAN = genereriban();
var_dump($new_account);
try{
	$idInsertedAdvanced = $dbManager->insert_advanced($new_account);
}catch(PDOException $e){
	$new_account->IBAN = null;
	$new_account->IBAN = genereriban();
}


// bonus : si on veut connecte l'utilisateur immediatement
$_SESSION['user_id'] = $db->lastInsertId();
header('Location: /index.php?pageName=login');