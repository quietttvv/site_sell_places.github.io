<?php
include "components/core.php";
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

if($_POST){
    $link->query("DELETE FROM `states` 
    WHERE `id` = '{$_POST['state_id']}' 
    AND `user_id` = '{$_SESSION['user']['id']}'");
}

header("Location: my_states.php");
exit;