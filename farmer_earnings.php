<?php
include("../db.php");

$query = "
SELECT users.name AS farmer_name,
SUM(products.price) AS earnings
FROM products
JOIN users ON users.id = products.farmer_id
GROUP BY products.farmer_id
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Farmer Earnings</title>

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

<body>

<h2>💰 Farmer Earnings</h2>

<table>

<tr>
<th>Farmer Name</th>
<th>Total Earnings</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['farmer_name']; ?></td>
<td>₹<?php echo $row['earnings']; ?></td>
</tr>

<?php } ?>

</table>

<a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</body>
</html>