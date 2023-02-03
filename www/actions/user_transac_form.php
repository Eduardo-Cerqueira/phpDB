<?php
require_once __DIR__ . '/../../src/init.php';

if ($_POST['type_transaction'] == 'transfer') {
    $dbManager->insert(
        'INSERT INTO transfers(sender, receiver, amount, currency, created_by) VALUES(?, ?, ?, ?, ?)',
        [$user['IBAN'], $_POST['iban'], $_POST['amount'], $_POST['Currency'], $user['id']]
    );}
else {
    $dbManager->insert(
        'INSERT INTO transactions(type, user_id, amount , currency, created_by) VALUES(?, ?, ?, ?, ?)',
        [$_POST['type_transaction'], $user['id'], $_POST['amount'], $_POST['Currency'], $user['id']]
    );
}

header("Location: /index.php?pageName=user_panel");
