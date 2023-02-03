<?php

require_once __DIR__ . '/../src/init.php';

$page_title = 'Dashboard';
require_once __DIR__ . '/../src/partials/header.php';
?>
<h2>Top 10</h2>
<br><br>
<?php
$tableau = $dbManager->select('SELECT "transfer" as "type", sender, receiver, created_by as "user_id", amount, currency, created_at FROM transfers WHERE created_by = ?
UNION 
SELECT type, "", "", user_id, amount, currency, created_at FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 10', 'Tableau', [$user['id'], $user['id']]);

if ($tableau) { ?>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableau as $transfer) { ?>
                <tr>
                    <?php foreach ($transfer as $key => $value) {
                        if ($key == 'sender') {
                            $senderName = $dbManager->select('SELECT fullname FROM account WHERE IBAN = ?', 'Account', [$value])[0];
                            echo "<td>$senderName->fullname</td>";
                        } elseif($key == 'receiver'){
                            $receiver = $dbManager->select('SELECT fullname FROM account WHERE IBAN = ?', 'Account', [$value])[0];
                            echo "<td>$receiver->fullname</td>";
                        } elseif ($key != 'user_id') {
                            echo "<td>$value</td>";
                        }
                    }
                    ?>
                </tr>
            <?php } ?>

        </tbody>
    </table>
<?php } else {
    echo "<p> Vous n'avez aucunne transaction :|</p>";
} ?>