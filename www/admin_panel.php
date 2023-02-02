<?php
require_once __DIR__ . '/../src/init.php';

$admin = $dbManager->select('SELECT * FROM account WHERE function = 1000', 'Account');

if (empty($admin)) {
    header('Location: /admin_register.php');
} elseif ($_SESSION['user_function'] != 1000) {
    header('Location: /login.php');
}



$page_title = 'Manager panel';
require_once __DIR__ . '/../src/partials/header.php';

?>

<body>
    <?php require_once __DIR__ .  '/../src/partials/menu.php'; ?>

    <h2>Utilisateurs à confirmer :</h2>

    <?php
    $all_user = $dbManager->select('SELECT * FROM account WHERE function = ?', 'Account', [0]);
    if ($all_user) {
    ?>
        <form action="/actions/valid_user.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>IBAN</th>
                        <th>Function</th>
                        <th>Last connection</th>
                        <th>Valider</th>
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
                            <td>
                                <label>
                                    <input type="checkbox" name="toConfirm[]" value="<?php echo $user->id ?>">
                                </label>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        <?php } else {
        echo "<p> Vous n'avez aucun utilisateurs à confirmer ! </p>";
    } ?>
        <button type="submit">Valider</button>
        </form>

        <h2>Dépôts à confirmer :</h2>

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

        $all_transac = $dbManager->select('SELECT * FROM transactions WHERE type = ? AND processed = 0', 'Transactions', ['depot']);
        ?>
        <form action="/actions/valid_depot.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th>Valider</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_transac as $transac) { ?>
                        <tr>
                            <?php foreach ($transac as $key => $value) {

                                if ($key != 'created_at' && $key != 'status' && $key != 'processed' && $key != 'processed_at'  && $key != 'processed_by') {
                                    echo "<td>$value</td>";
                                }
                            }

                            ?>
                            <td><button type="submit" name="yes" value=<?php echo ($transac->id) ?>>Oui</button>
                                <button type="submit" name="no" value=<?php echo ($transac->id) ?>>Non</button>
                            </td>

                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </form>

        <?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>