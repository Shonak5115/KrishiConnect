<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$conn->query("DELETE FROM cart WHERE user_id=$user_id AND product_id=$product_id");

header("Location: cart.php");
exit();
?>