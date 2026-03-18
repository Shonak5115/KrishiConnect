<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];
$payment = $_POST['payment'];

$total = 0;

/* Fetch Cart */
$cart = $conn->query("
SELECT p.id,p.name,p.price,p.stock,c.quantity
FROM cart c
JOIN products p ON c.product_id=p.id
WHERE c.user_id=$user_id
");

if($cart->num_rows == 0){
die("Cart Empty");
}

/* Calculate Total */
while($row=$cart->fetch_assoc()){
$total += $row['price'] * $row['quantity'];
}

/* Create Order */
$conn->query("
INSERT INTO orders(user_id,total,payment_method,status)
VALUES($user_id,$total,'$payment','Confirmed')
");

$order_id = $conn->insert_id;

/* Insert Order Items + Reduce Stock */
$cart = $conn->query("
SELECT p.id,p.price,c.quantity
FROM cart c
JOIN products p ON c.product_id=p.id
WHERE c.user_id=$user_id
");

while($row=$cart->fetch_assoc()){

$conn->query("
INSERT INTO order_items(order_id,product_id,quantity,price)
VALUES($order_id,".$row['id'].",".$row['quantity'].",".$row['price'].")
");

$conn->query("
UPDATE products
SET stock = stock - ".$row['quantity']."
WHERE id=".$row['id']."
");
}

/* Clear Cart */
$conn->query("DELETE FROM cart WHERE user_id=$user_id");

?>
<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="main-container">
<div class="form-card" style="width:600px;">

<h2>🧾 Order Invoice</h2>

<p><strong>Order ID:</strong> #<?php echo $order_id; ?></p>
<p><strong>Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
<p><strong>Payment:</strong> <?php echo $payment; ?></p>

<hr style="margin:20px 0;">

<?php
$items = $conn->query("
SELECT p.name,oi.quantity,oi.price
FROM order_items oi
JOIN products p ON oi.product_id=p.id
WHERE oi.order_id=$order_id
");

while($item=$items->fetch_assoc()){
echo "<p>".$item['name']." (x".$item['quantity'].") - ₹".
($item['quantity']*$item['price'])."</p>";
}
?>

<hr style="margin:20px 0;">

<h3>Total: ₹<?php echo $total; ?></h3>

<a href="generate_invoice.php?order_id=<?php echo $order_id; ?>">
    <button onclick="downloadInvoice()" style="margin-top:15px;">Download Invoice PDF</button>
</a>
<script>
function downloadInvoice() {
    window.print();
}
</script>

<a href="index.php">
<button>Continue Shopping</button>
</a>

</div>
</div>

<footer>
© 2026 KrishiConnect 🌾
</footer>

</body>
</html>