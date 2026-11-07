<?php
session_start();
include "components/core.php";

if(!isset($_SESSION['user']) || empty($_SESSION['cart'])){
    header("Location: cart.php");
    exit;
}

foreach($_SESSION['cart'] as $state_id){
    $link->query("UPDATE `states` SET `status_id` = 2 WHERE `id` = '$state_id'");
}

$_SESSION['cart'] = [];

header("Location: main.php");
exit;