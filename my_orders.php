<?php
session_start();
include("db.php");

$user=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>

<title>My Orders</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f6f9;
}

header{
background:#2ecc71;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

.nav-links a{
color:white;
text-decoration:none;
margin-left:20px;
font-weight:bold;
}

.orders{
padding:30px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:20px;
}

.order-card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

.product{
background:#f9f9f9;
padding:8px;
margin:5px 0;
border-radius:6px;
}

.status{
padding:6px 12px;
border-radius:20px;
color:white;
font-size:12px;
}

.pending{background:#f39c12;}
.completed{background:#2ecc71;}
.cancelled{background:#e74c3c;}

.cancel-btn{
background:#e74c3c;
color:white;
border:none;
padding:8px 12px;
border-radius:6px;
cursor:pointer;
margin-top:10px;
}

</style>
</head>

<body>

<header>

<h2>🧾 My Orders</h2>

<div class="nav-links">
<a href="index.php">Home</a>
<a href="cart.php">Cart</a>
<a href="logout.php">Logout</a>
</div>

</header>

<div class="orders">

<?php

$orders=mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$user' ORDER BY id DESC");

while($order=mysqli_fetch_assoc($orders)){

$statusClass=strtolower($order['status']);

?>

<div class="order-card">

<h3>Order #<?php echo $order['id']; ?></h3>

<p><b>Total:</b> ₹<?php echo $order['total']; ?></p>

<p><b>Payment:</b> <?php echo $order['payment_method']; ?></p>

<p><b>Products:</b></p>

<?php

$oid=$order['id'];

$items=mysqli_query($conn,"
SELECT p.name, oi.quantity 
FROM order_items oi
JOIN products p ON oi.product_id=p.id
WHERE oi.order_id='$oid'
");

while($item=mysqli_fetch_assoc($items)){
?>

<div class="product">
<?php echo $item['name']; ?> × <?php echo $item['quantity']; ?>
</div>

<?php } ?>

<br>

<span class="status <?php echo $statusClass; ?>">
<?php echo $order['status']; ?>
</span>

<?php if($order['status']=="Pending"){ ?>

<form method="POST" action="cancel_order.php">
<input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
<button class="cancel-btn">Cancel Order</button>
</form>

<?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>