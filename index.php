<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>KrishiConnect - Home</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    font-family: Arial, sans-serif;
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

header h2{ margin:0; }

.nav-links a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-weight:bold;
}

.filter-buttons{
    text-align:center;
    margin:30px 0;
}

.filter-buttons a{
    padding:10px 18px;
    margin:5px;
    text-decoration:none;
    background:#3498db;
    color:white;
    border-radius:20px;
    transition:0.3s;
}

.filter-buttons a:hover{
    background:#2980b9;
}

/* SEARCH BAR */
.search-bar{
    text-align:center;
    margin-bottom:20px;
}

.search-bar input{
    padding:10px;
    width:250px;
    border-radius:20px;
    border:1px solid #ccc;
}

.search-bar button{
    padding:10px 15px;
    border:none;
    border-radius:20px;
    background:#2ecc71;
    color:white;
    cursor:pointer;
}

.products{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    padding:30px;
}

.product-card{
    background:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.product-card:hover{
    transform:translateY(-8px);
}

.product-icon{
    font-size:50px;
    margin-bottom:15px;
}

.category{
    font-size:14px;
    color:gray;
    margin-bottom:10px;
}

/* PROFESSIONAL QUANTITY */
.qty-box{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin:10px 0;
}

.qty-box button{
    width:30px;
    height:30px;
    border:none;
    background:#3498db;
    color:white;
    border-radius:50%;
    cursor:pointer;
}

.qty-box input{
    width:50px;
    text-align:center;
    border:1px solid #ccc;
    border-radius:8px;
    padding:5px;
}

.btn{
    background:#2ecc71;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:#27ae60;
}
</style>
</head>

<body>

<header>
<h2>🌾 KrishiConnect</h2>
<div class="nav-links">
<a href="cart.php">Cart</a>
<a href="logout.php">Logout</a>
</div>
</header>

<!-- CATEGORY FILTER -->
<div class="filter-buttons">
<a href="index.php">All</a>
<a href="index.php?category=Dairy">Dairy</a>
<a href="index.php?category=Grains">Grains</a>
<a href="index.php?category=Vegetables">Vegetables</a>
<a href="index.php?category=Fruits">Fruits</a>
</div>

<!-- SEARCH BAR -->
<form method="GET" class="search-bar">
<input type="text" name="search" placeholder="Search Products...">
<button type="submit">Search</button>
</form>

<div class="products">

<?php

$where = [];

if(isset($_GET['category'])){
    $category = mysqli_real_escape_string($conn,$_GET['category']);
    $where[] = "category='$category'";
}

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
    $where[] = "name LIKE '%$search%'";
    $where[] = "stock > 0";
}

$condition = "";
if(count($where) > 0){
    $condition = "WHERE " . implode(" AND ", $where);
}

$query = "SELECT * FROM products $condition";
$result = mysqli_query($conn, $query);


while($row = mysqli_fetch_assoc($result)) {

$icon = "";
$color = "";

if($row['category'] == "Dairy"){
    //$icon = "fa-solid fa-droplet";
    $color = "#3498db";
}
elseif($row['category'] == "Grains"){
    //$icon = "fa-solid fa-seedling";
    $color = "#d35400";
}
elseif($row['category'] == "Vegetables"){
    //$icon = "fa-solid fa-carrot";
    $color = "#27ae60";
}
elseif($row['category'] == "Fruits"){
    //$icon = '<i class="fa-solid fa-basket-shopping"></i> <i class="fa-solid fa-apple-whole"></i>';
    $color = "#e74c3c";
}
else{
    //$icon = "fa-solid fa-box";
    $color = "#7f8c8d";
}
?>

<div class="product-card">

<div class="product-icon" style="color:<?php echo $color; ?>">
<i class="<?php echo $icon; ?>"></i>
</div>

<h3><?php echo $row['name']; ?></h3>

<p><strong>₹<?php echo $row['price']; ?>/<?php echo $row['unit'];  ?></strong></p>

<p class="category"><?php echo $row['category']; ?></p>
<p>Stock : <?php echo $row['stock']; ?></p>
<form method="POST" action="add_to_cart.php">

<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

<div class="qty-box">
<button type="button" onclick="this.nextElementSibling.stepDown()">-</button>
<input type="number" name="quantity" value="1" min="1" max="<?php echo $row['stock']; ?>" required>
<button type="button" onclick="this.previousElementSibling.stepUp()">+</button>
</div>


<?php if($row['stock'] > 0){ ?>

<button type="submit" class="btn">Add to Cart</button>

<?php } else { ?>

<button class="btn" style="background:red;" disabled>Out of Stock</button>

<?php } ?>

</form>

</div>

<?php } ?>

</div>

</body>
</html>
