<h2>Récapitulatif de votre compte :</h2>
<?php
require_once __DIR__ . '/../src/init.php';
?>
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
?>
    <br><br>
	<button type="submit">Convert</button>
</form>