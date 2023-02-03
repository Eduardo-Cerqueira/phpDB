
<h2>Top 10</h2>
<br><br>
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}
$tableau = $dbManager->select('SELECT "transfer" as "type", sender, receiver, created_by as "user_id", amount, currency, created_at FROM transfers WHERE created_by = ?
UNION
SELECT type, "", "", user_id, amount, currency, created_at FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT '. ($page * 10) .', 10', 'Tableau', [$user['id'], $user['id']]);

if ($tableau) {?>
    <table class="table-style">
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
                <tr class="table-row-style">
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
    <form method="post">
        <?php if ($_GET['page'] > 0) {?>
        <a href=http://localhost/dashboard.php?<?php $newpage = $page - 1; echo("page=".$newpage);?>><button type="button">previous</button></a>
        <?php
    }
    ?>
        <a href=http://localhost/dashboard.php?<?php $newpage = 0; echo("page=".$newpage);?>><button type="button">reset</button></a>
        <?php if ($_GET['page'] < 2) {?>
        <a href=http://localhost/dashboard.php?<?php $newpage = $page + 1; echo("page=".$newpage);?>><button type="button">next</button></a>
        <?php
    }
}
    ?>
	</form>