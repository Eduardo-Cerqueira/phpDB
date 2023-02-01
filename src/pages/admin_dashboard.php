<h2>Utilisateurs :</h2>
<?php
    $new_account = new Account();
    $new_account->fullname = 'fullname';
    $new_account->email = 'test2@gmail.com';
    $new_account->password = '1234';
    $idInsertedAdvanced = $dbManager->insert_advanced($new_account);

    $all_user = $dbManager->select('SELECT * FROM contact_forms', [], 'Account')
?>

