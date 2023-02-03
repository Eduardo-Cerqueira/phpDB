<?php
require_once __DIR__ . '/../../src/init.php';

if (isset($_POST['yes'])) {
    $status = 1;
    $id = $_POST['yes'];
}
else if (isset($_POST['no'])) {
    $status = 0;
    $id = $_POST['no'];
}
$dbManager->update('transactions',['processed_at' => date('Y-m-d H:i:s'), 'status' => $status, 'processed_by' => $user['fullname'], 'processed' => 1], $id);
header('Location: /index.php?pageName=admin_panel');
?>