<?php
$page_title = 'Requests Users';
require_once __DIR__ . '/../src/partials/header.php';


?>
<br>
<form id="L" method="post">
   <select name="Type">
   <option value="depot">Dêpot</option>
   <option value="retrait">Retrait</option>
  </select>
<input type="submit" name="Submit" value="Submit">
</form>
<br>

<?php
if(isset($_POST['Type'])) {
    requestsUsers($_POST['Type']);
}

function updateRequestUser($id,$status) {
    require_once __DIR__ . '/../src/init.php';
    $forms = $dbManager->update(
        'transaction',
        //input session id on processed_by
        ['id'=> $id, 'processed_at' => date('Y-m-d H:i:s'), 'status' => $status, 'processed_by' => 'me', 'processed' => 1]
    );
}

function requestsUsers($type){
require_once __DIR__ . '/../src/init.php';
$forms = $dbManager->select('SELECT * FROM transaction WHERE processed = 0 AND type = ?','Transaction', [$type]);
foreach ($forms as $key => $value) {
    echo('Emitter : ');    $id = ($value->id);
    echo($value->emitter_id);
    echo(' Amount : ');
    echo($value->emitter_amount);
    echo(' Receiver : ');
    echo($value->receiver_id);
    echo(' Amount : ');
    ?>
    <form id="Y" method="post">
        <input type="submit" name="yesno" value="Yes" />
        <input type="submit" name="yesno" value="No" />
    </form><?php
/*
    if (($_POST['yesno']) == "No") {
        updateRequestUser(($value->id),0);
    }
    else if (($_POST['yesno']) == "Yes") {
            updateRequestUser(($value->id),1);
        }*/
    }
}
?>