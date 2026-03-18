<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: ../login.php");
exit();
}

include("../db.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

header{
background:#2ecc71;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
}

.admin-cards{
display:flex;
justify-content:center;
gap:30px;
margin-top:40px;
}

.card{
padding:25px 40px;
background:#27ae60;
color:white;
text-decoration:none;
font-size:18px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.2);
transition:0.3s;
}

.card:hover{
background:#219150;
transform:scale(1.05);
}


.container{
padding:40px;
display:flex;
gap:30px;
}

.card{
background:grey;
padding:30px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
width:250px;
text-align:center;
}

.card a{
text-decoration:none;
color:white;
background:#3498db;
padding:10px 20px;
border-radius:5px;
display:inline-block;
margin-top:10px;
}

</style>

</head>

<body>

<header>
<h2>Admin Panel</h2>

<div>
<a href="../index.php" style="color:grey;margin-right:20px;">Home</a>
<a href="../logout.php" style="color:grey;">Logout</a>
</div>
</header>

<div class="container">

<div class="card">
<h3>View Products</h3>
<p>(All Available Products)</p>
<a href="manage_products.php">Open</a>
</div>

<div class="card">
<h3>View Users</h3>
<p>(Farmers & Customers)</p>
<a href="manage_users.php">Open</a>
</div>

<div class="card">
<h3>View Orders</h3>
<p>(All Customer Orders)</p>
<a href="view_orders.php">Open</a>
</div>

<div class="card">
<h3>View Farmer Earnings</h3>
<p>(All Farmer Earnings)</p>
<a href="farmer_earnings.php">Open</a>
</div>
</div>

</body>
</html>