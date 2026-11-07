<?php
session_start();

if($_POST){
    $state_id = $_POST['state_id'];
    
    if(isset($_SESSION['cart'])){
        $key = array_search($state_id, $_SESSION['cart']);
        if($key !== false){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}

header("Location: cart.php");
exit;