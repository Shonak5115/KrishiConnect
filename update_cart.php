<?php
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_POST['product_id']) || !isset($_POST['qty'])){
    header("Location: cart.php");
    exit();
}

$user = $_SESSION['user_id'];
$product = intval($_POST['product_id']);
$qty = intval($_POST['qty']);

if($qty < 1){
    $qty = 1;
}

$conn->query("UPDATE cart 
              SET quantity=$qty 
              WHERE user_id=$user AND product_id=$product");

header("Location: cart.php");
exit();
?>