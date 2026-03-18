<?php
session_start();
include("db.php");

$order_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$conn->query("
UPDATE orders 
SET status='Cancelled'
WHERE id=$order_id AND user_id=$user_id
");

header("Location: my_orders.php");
exit();
?>