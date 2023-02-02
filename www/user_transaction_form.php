<?php
require_once __DIR__ . '/../src/init.php';
/*
function requestTransaction($type, $emitter_id, $emitter_amount, $emitter_currency, $receiver_id, $receiver_amount, $receiver_currency) {
    $dbManager->insert(
        'INSERT INTO transaction(type, emitter_id, emitter_amount ,emitter_currency, receiver_id, receiver_amount, receiver_currency) VALUES(?, ?, ?, ?, ?, ?, ?)',
        [$type, $emitter_id, $emitter_amount, $emitter_currency, $receiver_id, $receiver_amount, $receiver_currency]
    );}
*/
?>

<h2>Transaction Form</h2>
<form id="T" method="post">
    Account : <input type="number" name="id">
    <br><br>
    Amount : <input type="number"  name="amount">
    <br><br>
    Currency : 
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
    <br><br>
    Type transaction:
    <input type="radio" name="type_transaction" value="depot">Dêpot
    <input type="radio" name="type_transaction" value="retrait">Retrait
    <input type="radio" name="type_transaction" value="transfer">Transfer
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php

if ($_POST['type_transaction'] == 'transfer') {
    // add iban
    $dbManager->insert(
        'INSERT INTO transaction(type, emitter_id, emitter_amount ,emitter_currency, receiver_id, receiver_amount, receiver_currency) VALUES(?, ?, ?, ?, ?, ?, ?)',
        [$_POST['type_transaction'], 1, $_POST['amount'], $_POST['Currency'], 1, $_POST['amount'], $_POST['Currency']]
    );}
else {
    // add iban
    $dbManager->insert(
        'INSERT INTO transaction(type, emitter_id, emitter_amount ,emitter_currency, receiver_id, receiver_amount, receiver_currency) VALUES(?, ?, ?, ?, ?, ?, ?)',
        [$_POST['type_transaction'], 1, $_POST['amount'], $_POST['Currency'], 1, $_POST['amount'], $_POST['Currency']]
    );
}
