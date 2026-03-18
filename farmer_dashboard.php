<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Farmer Dashboard</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f6f9;
}

/* HEADER */

header{
background:#2ecc71;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

header h2{
margin:0;
}

.nav a{
color:white;
text-decoration:none;
margin-left:20px;
font-weight:bold;
}

/* CONTAINER */

.container{
display:flex;
gap:30px;
padding:30px;
}

/* ADD PRODUCT */

.add-product{
flex:1;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.add-product input,
.add-product select{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
}

/* BUTTON */

.btn{
background:#2ecc71;
color:white;
padding:10px 15px;
border:none;
border-radius:6px;
cursor:pointer;
}

.btn:hover{
background:#27ae60;
}

/* PRODUCT LIST */

.products{
flex:2;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.product-card{
background:white;
padding:20px;
border-radius:10px;
text-align:center;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

</style>
</head>

<body>

<header>

<h2>🌾 Farmer Dashboard</h2>

<div class="nav">
<a href="farmer_dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</div>

</header>

<div class="container">

<!-- ADD PRODUCT -->

<div class="add-product">

<h3>Add Product</h3>

<form method="POST" action="add_product.php">

<input type="text" name="name" placeholder="Product Name" required>

<input type="number" name="price" placeholder="Price" required>

<select name="category" required>
<option value="">Select Category</option>
<option value="Dairy">Dairy</option>
<option value="Grains">Grains</option>
<option value="Vegetables">Vegetables</option>
<option value="Fruits">Fruits</option>
</select>

<select name="unit" required>
<option value="">Select Unit</option>
<option value="kg">kg</option>
<option value="gram">gram</option>
<option value="liter">liter</option>
<option value="dozen">dozen</option>
<option value="piece">piece</option>
</select>

<input type="number" name="stock" placeholder="Enter Quantity" required>


<button type="submit" class="btn">Add Product</button>

</form>

</div>


<!-- VIEW PRODUCTS -->

<div class="products">

<?php

$user = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM products WHERE farmer_id='$user'");

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card">

<h4><?php echo $row['name']; ?></h4>

<p><b>₹<?php echo $row['price']; ?> / <?php echo $row['unit']; ?></b></p>

<p><?php echo $row['category']; ?></p>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
