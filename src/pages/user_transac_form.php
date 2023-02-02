<h2>Transaction Form</h2>
<form action="/actions/user_transac_form.php" method="post">
    IBAN : <input type="text" name="iban">
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
