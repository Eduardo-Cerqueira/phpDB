<h2>Vos transferts :</h2>

<?php

$all_transfer = $dbManager->select('SELECT * FROM transfers WHERE sender = ? OR receiver = ? ', 'Transfers', [$user['IBAN'], $user['IBAN']]);
?>
    <?php if ($all_transfer) { ?>
        <table class="table-style">
            <thead>
                <tr>
                    <th>Expediteur</th>
                    <th>Destinataire</th>
                    <th>Montant</th>
                    <th>Devise</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_transfer as $transfer) { ?>
                    <tr class="table-row-style">
                        <?php foreach ($transfer as $key => $value) {
                            if ($key == 'sender') {
                                $senderName = $dbManager->select('SELECT fullname FROM account WHERE IBAN = ?', 'Account', [$value])[0];
                                echo "<td>$senderName->fullname</td>";
                            }elseif($key == 'receiver'){
                                $receiver = $dbManager->select('SELECT fullname FROM account WHERE IBAN = ?', 'Account', [$value])[0];
                                echo "<td>$receiver->fullname</td>";
                            }elseif ($key != 'created_at' && $key != 'type' && $key != 'id' && $key != 'created_by') {
                                echo "<td>$value</td>";
                            }
                        }
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {
        echo "<p> Vous n'avez aucun tranferts :|</p>";
    } ?>