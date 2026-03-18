<?php
include 'navbar.php';
include 'db.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!='farmer'){
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM products");
?>

<style>
body{
font-family:Poppins;
background:#e8f5e9;
display:flex;
flex-direction:column;
min-height:100vh;
}

.container{
flex:1;
padding:40px;
}

.card{
background:white;
padding:20px;
margin:15px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
</style>

<div class="container">
<h2>Your Products</h2>

<?php while($row=$result->fetch_assoc()){ ?>
<div class="card">
<h3><?php echo $row['name']; ?></h3>
<p><?php echo $row['description']; ?></p>
<p>₹<?php echo $row['price']; ?></p>
</div>
<?php } ?>

</div>

<div class="footer">
© 2026 KrishiConnect | Direct Farmer to Consumer Platform
</div>