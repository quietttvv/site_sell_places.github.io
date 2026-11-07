<?php
session_start();
include "components/core.php";

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

if($_POST){
    $state_id = $_POST['state_id'];
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
    
    if(!in_array($state_id, $_SESSION['cart'])){
        $_SESSION['cart'][] = $state_id;
    }
}

header("Location: main.php");
exit;