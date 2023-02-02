<?php

require_once __DIR__ . '/../src/init.php';

$page_title = 'Dashboard';
require_once __DIR__ . '/../src/partials/header.php';

$id = 1;
$i = 0;
$forms = $dbManager->select('SELECT * FROM transaction WHERE (emitter_id = ? AND receiver_id = ?) OR emitter_id = ? OR receiver_id = ?', 'Transaction', [$id,$id,$id,$id]);
foreach ($forms as $key => $value) {
    if ($i < 10) {
    echo('Emitter : ');
    echo($value->emitter_id);
    echo(' Amount : ');
    echo($value->emitter_amount);
    echo(' Receiver : ');
    echo($value->receiver_id);
    echo(' Amount : ');
    echo($value->receiver_amount);
    ?>
    <br>
    <?php
    $i++;
    }
    else {
        break;
    }
}

/*
function sumAllTypeByID()
$total = 0;
$forms = $dbManager->select('SELECT * FROM transaction WHERE type = ? AND emitter_id = ?', 'Transaction', [$id,$type]);
foreach ($forms as $key => $value) {
    $total = $total + ($value->emitter_amount);
}
echo ($total)
//echo($forms[0]->emitter_amount);
?>*/