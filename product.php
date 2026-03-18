<?php
include 'navbar.php';
include 'db.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");

if($result->num_rows == 0){
    echo "Product not found";
    exit();
}

$row = $result->fetch_assoc();
?>

<style>
body{
font-family:Poppins;
background:#f9fbe7;
display:flex;
flex-direction:column;
min-height:100vh;
}

.container{
flex:1;
display:flex;
justify-content:center;
align-items:center;
}

.product-card{
background:white;
width:350px;
padding:25px;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
text-align:center;
}

.price{
color:green;
font-weight:bold;
font-size:20px;
}
</style>

<div class="container">
<div class="product-card">
<img src="<?php echo $row['image']; ?>" width="250"><br><br>
<h3><?php echo $row['name']; ?></h3>
<p><?php echo $row['description']; ?></p>
<p class="price">₹<?php echo $row['price']; ?></p>

<form action="add_to_cart.php" method="POST">
<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
<input type="number" name="qty" value="1" min="1">
<br><br>
<button type="submit">Add to Cart</button>
</form>

</div>
</div>

<div class="footer">
© 2026 KrishiConnect | Direct Farmer to Consumer Platform
</div>