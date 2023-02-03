<h2>Vos dépôts :</h2>

<?php

$all_transac = $dbManager->select('SELECT * FROM transactions WHERE type = ? AND user_id = ?', 'Transactions', ['depot', $user['id']]);
?>
<form action="/actions/valid_depot.php" method="post">
    <?php if ($all_transac) { ?>
        <table>
            <thead>
                <tr>
                    <th>Montant</th>
                    <th>Devise</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_transac as $transac) { ?>
                    <tr>
                        <?php foreach ($transac as $key => $value) {
                            if ($key == 'status') {
                                switch ($value) {
                                    case '0':
                                        echo "<td>Refusé</td>";
                                        break;
                                    case '1':
                                        echo "<td>Effectué</td>";
                                        break;
                                    default:
                                        echo "<td>En cours</td>";
                                        break;
                                }
                            } elseif ($key == 'amount' || $key == 'currency' || $key == 'status') {
                                echo "<td>$value</td>";
                            }
                        }

                        ?>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    <?php } else {
        echo "<p> Vous n'avez aucun depots :(</p>";
    } ?>
    </form>