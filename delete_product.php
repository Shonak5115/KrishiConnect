<?php
session_start();
include("db.php");

if(isset($_POST['product_id'])){

    $product_id = intval($_POST['product_id']);
    $farmer_id = $_SESSION['user_id'];

    mysqli_query($conn,
        "DELETE FROM products 
         WHERE id='$product_id' 
         AND farmer_id='$farmer_id'"
    );

    header("Location: farmer_dashboard.php");
}
?>