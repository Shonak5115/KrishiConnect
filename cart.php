<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT p.id,p.name,p.price,c.quantity
FROM cart c
JOIN products p ON c.product_id=p.id
WHERE c.user_id=$user_id
");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="main-container">
<div class="glass-card">

<h2>🛒 My Shopping Cart</h2>

<?php if($result->num_rows > 0){ ?>

<table>
<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php while($row=$result->fetch_assoc()){ 
$lineTotal = $row['price'] * $row['quantity'];
$total += $lineTotal;
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td>₹<?php echo $lineTotal; ?></td>

<td>
<form method="POST" action="remove_from_cart.php">
<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
<button type="submit" class="danger">Remove</button>
</form>
</td>

</tr>

<?php } ?>

</table>

<div class="summary-box">
<h3>Grand Total: ₹<?php echo $total; ?></h3>
<br>
<a href="checkout.php">
<button>Proceed to Checkout</button>
</a>
</div>

<?php } else { ?>

<p>Your Cart is Empty 🥲</p>

<?php } ?>

</div>
</div>

<footer>
© 2026 KrishiConnect 🌾
</footer>

</body>
</html>