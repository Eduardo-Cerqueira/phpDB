<h2>Récapitulatif de votre compte :</h2>

<?php
echo "<h3> IBAN : $user[IBAN] </h3>";

//récupération de toutes les currency dispo sur le site
$all_currency = array();
$db_currency = $dbManager->select("SELECT * FROM currency", 'Currency');

foreach ($db_currency as $key => $currency) {
    $all_currency[$currency->name] = 0;
}
//calcul des soldes

//Via Transfers

//récupération des profits
$receiviedMoney = $dbManager->select("SELECT * FROM transfers WHERE receiver = ?", 'Transfers', [$user['IBAN']]);

//récupération des deficits
$sendMoney = $dbManager->select("SELECT * FROM transfers WHERE sender = ?", 'Transfers', [$user['IBAN']]);

//Via Transactions

//récupération des profits
$depositMoney = $dbManager->select("SELECT * FROM transactions WHERE user_id = ? AND type = 'depot' AND status = 1", 'Transactions', [$user['id']]);

//récupération des deficits
$withdrawMoney = $dbManager->select("SELECT * FROM transactions WHERE user_id = ? AND type = 'retrait' AND status = 1", 'Transactions', [$user['id']]);



echo "<p> Vous avez :<p>";

foreach ($receiviedMoney as $key => $value) {
    $all_currency[$value->currency] += intval($value->amount);
}

foreach ($depositMoney as $key => $value) {
    $all_currency[$value->currency] += intval($value->amount);
}

foreach ($withdrawMoney as $key => $value) {
    $all_currency[$value->currency] -= intval($value->amount);
}
?>

<ul>
    <?php
    foreach ($all_currency as $key => $value) {
    ?>
        <li>
            <?php echo $value . ' ' . $key; ?>
        </li>
    <?php }?>
</ul>