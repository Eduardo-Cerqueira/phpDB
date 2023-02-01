

<h2>Utilisateurs :</h2>
<?php
/*     $new_account = new Account();
    $new_account->fullname = 'fullname';
    $new_account->email = 'test8@gmail.com';
    $new_account->password = '1234';
    $idInsertedAdvanced = $dbManager->insert_advanced($new_account); */

$all_user = $dbManager->select('SELECT * FROM account', 'Account', []);
?>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Function</th>
            <th>Last connection</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_user as $user) { ?>
            <tr>
                <?php foreach ($user as $key => $value) {
                    if ($key != 'password' && $key != 'created_at') {
                        echo "<td>$value</td>";
                    }
                }
                ?>
            </tr>
        <?php } ?>

    </tbody>
</table>

<hr>

<h2>Dépôts :</h2>

<?php
   /*  $new_transacdepot = new Transaction();
    $new_transacdepot->type = "depot";
    $new_transacdepot->emitter_id = "3";
    $new_transacdepot->emitter_amount = "17";
    $new_transacdepot->emitter_currency = "EURO";
    $new_transacdepot->receiver_id = "3";
    $new_transacdepot->receiver_amount = "17";
    $new_transacdepot->receiver_currency = "EURO";
    $new_transacdepot->status = 0;
    $new_transacdepot->processed = 1;
*/

 $all_transac = $dbManager->select('SELECT * FROM transaction WHERE type = ?', 'Transaction', ['depot']);
?>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th>Utilisateur</th>
            <th>Montant</th>
            <th>Devise</th>
            <th>Status</th>
            <th>Validé</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_transac as $transac) { ?>
            <tr>
                <?php foreach ($transac as $key => $value) {
                    if ($key == 'emitter_id') {
                        $name = $dbManager->getById_advanced($transac->emitter_id,'Account');
                        echo '<td>'. $name->fullname . '</td>';
                    }elseif($key == 'receiver_id') {
                        $name = $dbManager->getById_advanced($transac->receiver_id,'Account');
                        echo '<td>'. $name->fullname . '</td>';
                    }elseif($key != 'created_at' ) {
                        echo "<td>$value</td>";
                    }
                }
                ?>
            </tr>
        <?php } ?>

    </tbody>
</table>



<hr>

<h2>Transactions :</h2>

<?php
   /*  $new_transacdepot = new Transaction();
    $new_transacdepot->type = "depot";
    $new_transacdepot->emitter_id = "3";
    $new_transacdepot->emitter_amount = "17";
    $new_transacdepot->emitter_currency = "EURO";
    $new_transacdepot->receiver_id = "3";
    $new_transacdepot->receiver_amount = "17";
    $new_transacdepot->receiver_currency = "EURO";
    $new_transacdepot->status = 0;
    $new_transacdepot->processed = 1;
*/

 $all_transac = $dbManager->select('SELECT * FROM transaction', 'Transaction', []);



?>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th>Envoyeur</th>
            <th>Montant</th>
            <th>Devise</th>
            <th>Destinataire</th>
            <th>Montant</th>
            <th>Devise</th>
            <th>Status</th>
            <th>Validé</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_transac as $transac) { ?>
            <tr>
                <?php foreach ($transac as $key => $value) {
                    if ($key == 'emitter_id') {
                        $name = $dbManager->getById_advanced($transac->emitter_id,'Account');
                        echo '<td>'. $name->fullname . '</td>';
                    }elseif($key == 'receiver_id') {
                        $name = $dbManager->getById_advanced($transac->receiver_id,'Account');
                        echo '<td>'. $name->fullname . '</td>';
                    }elseif($key != 'created_at') {
                        echo "<td>$value</td>";
                    }
                }
                ?>
            </tr>
        <?php } ?>

    </tbody>
</table>