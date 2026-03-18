<?php

session_start();
include("db.php");

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$unit = $_POST['unit'];
$stock = $_POST['stock'];
$farmer = $_SESSION['user_id'];

mysqli_query($conn,"INSERT INTO products(name,price,category,unit,farmer_id,stock)
VALUES('$name','$price','$category','$unit','$farmer','$stock')");

header("Location: farmer_dashboard.php");

?>
