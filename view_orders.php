<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
header("Location: ../login.php");
exit();
}

$result=mysqli_query($conn,"
SELECT orders.id,users.name,orders.total,orders.payment_method,orders.status
FROM orders
JOIN users ON orders.user_id=users.id
");
?>

<!DOCTYPE html>
<html>
<head>

<title>View Orders</title>

<style>

body{
font-family:Arial;
background:#f4f6f7;
}

h2{
text-align:center;
margin-top:30px;
}

table{
width:80%;
margin:40px auto;
border-collapse:collapse;
background:white;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

th,td{
padding:14px;
border-bottom:1px solid #ddd;
text-align:center;
}

th{
background:#27ae60;
color:white;
}

tr:hover{
background:#f2f2f2;
}

.back-btn{
display:block;
width:200px;
margin:20px auto;
text-align:center;
padding:12px;
background:#333;
color:white;
text-decoration:none;
border-radius:8px;
}

</style>

</head>

<h2>All Orders</h2>

<table border="1" cellpadding="10">

<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['total']; ?></td>
<td><?php echo $row['payment_method']; ?></td>
<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

<a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>