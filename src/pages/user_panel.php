<h2>Récapitulatif de votre compte :</h2>

<?php
    echo "<h3> IBAN : $user[IBAN] </h3>";

    //récupération de toutes les currency dispo sur le site
    $all_currency = array();
    $db_currency = $dbManager->select("SELECT * FROM currency", 'Currency');

    foreach ($db_currency as $key => $currency) {
        $all_currency[$currency->name] = 0;
    }

    var_dump($all_currency);

    //calcul des soldes

    //récupération des profits
    $receiviedMoney = $dbManager->select("SELECT * FROM transfers WHERE receiver = ?", 'Transfers',[$user['IBAN']]);
    var_dump($receiviedMoney);

    //récupération des deficits
    $sendMoney = $dbManager->select("SELECT * FROM transfers WHERE sender = ?", 'Transfers',[$user['IBAN']]);

    echo "<p> Vous avez :<p>";

    foreach ($receiviedMoney as $key => $value) {
        $all_currency[$value->currency] += intval($value->amount);
    }

    foreach ($sendMoney as $key => $value) {
        $all_currency[$value->currency] -= intval($value->amount);
    }

    foreach ($all_currency as $key => $value) {
        echo $value .' ' .$key;
        echo "<br>";
    }

?>