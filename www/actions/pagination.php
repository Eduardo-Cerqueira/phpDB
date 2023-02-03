<?php

require_once __DIR__ . '/../../src/init.php';

$page = 0;
if (isset($_POST['previous']) || $page >= 1){
    $page--;
    echo($page);
    
}

if (isset($_POST['reset'])){
    $page = 0;
}

if (isset($_POST['next'])){
    $page ++;
    echo($page);
}
