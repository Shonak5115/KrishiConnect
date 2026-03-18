<?php
include "db.php";
$cid=$_POST['cid'];
$q=$_POST['quantity'];
$conn->query("UPDATE cart SET quantity=$q WHERE id=$cid");
header("Location:cart.php");
?>