<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT p.name,p.price,c.quantity
FROM cart c
JOIN products p ON c.product_id=p.id
WHERE c.user_id=$user_id
");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="main-container">
<div class="glass-card">

<h2>💳 Checkout</h2>

<table>
<tr>
<th>Product</th>
<th>Quantity</th>
<th>Total</th>
</tr>

<?php while($row=$result->fetch_assoc()){ 
$lineTotal = $row['price'] * $row['quantity'];
$total += $lineTotal;
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td>₹<?php echo $lineTotal; ?></td>
</tr>

<?php } ?>

</table>

<div class="summary-box">
<h3>Total Payable: ₹<?php echo $total; ?></h3>

<form method="POST" action="place_order.php">

<br>

<label>
<input type="radio" name="payment" value="COD" required>
 Cash On Delivery
</label>

<br><br>

<label>
<input type="radio" name="payment" value="UPI">
 UPI Payment
</label>

<br><br>

<button type="submit">Confirm & Place Order</button>

</form>

</div>

</div>
</div>

<footer>
© 2026 KrishiConnect 🌾
</footer>

</body>
</html>