<?php
require_once __DIR__ . '/../../src/init.php';

if(isset($_POST['toConfirm'])){
    $userToConfirm = $_POST['toConfirm'];
    foreach ($userToConfirm as $key => $value) {
        $user = $dbManager->getById_advanced($value, 'Account');
        $user->function = 1;
        var_dump($user);
        $dbManager->update_advanced($user);
    }
}


header('Location: /index.php?pageName=admin_panel');