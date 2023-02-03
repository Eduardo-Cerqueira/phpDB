<h2>Convertissez vos monnaies :</h2>

<form name="C" method="post">
    <input type="number" name="amount"> 
    <select name="Currency">
        Currency:
        <?php
        $forms = $dbManager->select('SELECT name FROM currency', 'Currency', []);
        foreach ($forms as $key => $value) {
            $name = ($value->name); ?>
            <option value= <?php echo($name) ?> > <?php echo($name) ?> </option>
            <?php
        }?>
    </select>

CONVERT TO
    <select name="Currency2">
        Currency:
        <?php
        $forms = $dbManager->select('SELECT name FROM currency', 'Currency', []);
        foreach ($forms as $key => $value) {
            $name = ($value->name); ?>
            <option value= <?php echo($name) ?> > <?php echo($name) ?> </option>
            <?php
        }?>
    </select>
    
    <?php
if (isset($_POST['Currency']) && isset($_POST['Currency2']) && isset($_POST['amount'])) {
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


    foreach ($receiviedMoney as $key => $value) {
        $all_currency[$value->currency] += intval($value->amount);
    }

    foreach ($depositMoney as $key => $value) {
        $all_currency[$value->currency] += intval($value->amount);
    }

    foreach ($sendMoney as $key => $value) {
        $all_currency[$value->currency] -= intval($value->amount);
    }

    foreach ($withdrawMoney as $key => $value) {
        $all_currency[$value->currency] -= intval($value->amount);
    }


    if (($all_currency[$_POST['Currency']] - (float) $_POST['amount']) < 0) {
        echo("You don't have this money :(");
    } else if (($_POST['Currency'] != $_POST['Currency2']) && (int) $_POST['amount'] > 0) {
            $currency_multiplier = $dbManager->select("SELECT multiplier FROM currency WHERE name = ?", 'Currency', [$_POST['Currency']]);
        
            foreach ($currency_multiplier as $key => $value) {
                $currency = ($value->multiplier);
            }
        
            $currency_multiplier2 = $dbManager->select("SELECT multiplier FROM currency WHERE name = ?", 'Currency', [$_POST['Currency2']]);
            foreach ($currency_multiplier2 as $key => $value) {
                $currency2 = ($value->multiplier);
            }

            $calc = (((float) $currency)/((float) $currency2)*((float)$_POST['amount']));
            echo(number_format($calc, 8));

            $dbManager->insert(
                'INSERT INTO transactions(type, user_id, amount , currency, status, processed, processed_at, processed_by) VALUES(?, ?, ?, ?, 1, 1, current_timestamp(), "convertion")',
                ['retrait', $user['id'], $_POST['amount'], $_POST['Currency']]
            );

            $dbManager->insert(
                'INSERT INTO transactions(type, user_id, amount , currency, status, processed, processed_at, processed_by) VALUES(?, ?, ?, ?, 1, 1, current_timestamp(), "convertion")',
                ['depot', $user['id'], number_format($calc, 8), $_POST['Currency2']]
            );
        }
    }

?>
    <br><br>
	<button type="submit">Convert</button>
</form>

