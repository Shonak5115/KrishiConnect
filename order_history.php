<?php
session_start();
include("db.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI';
    background:linear-gradient(to right,#74ebd5,#acb6e5);
}

.container{
    width:85%;
    margin:auto;
    padding:40px;
}

.order-card{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
}

.status{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:13px;
}

.Pending{ background:#f39c12; }
.Confirmed{ background:#3498db; }
.Shipped{ background:#9b59b6; }
.Delivered{ background:#2ecc71; }
.Cancelled{ background:#e74c3c; }

.cancel-btn{
    background:#e74c3c;
    color:white;
    padding:8px 15px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.cancel-btn:hover{
    background:#c0392b;
}

</style>
</head>
<body>

<div class="container">

<h2>🛒 My Orders</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="order-card">

<div>
    <h4>Order #<?php echo $row['id']; ?></h4>
    <p>Total: ₹<?php echo $row['total_amount']; ?></p>
</div>

<div>
    <span class="status <?php echo $row['status']; ?>">
        <?php echo $row['status']; ?>
    </span>
</div>

<div>
<?php if($row['status']=='Pending' || $row['status']=='Confirmed'){ ?>
    <form method="POST" action="cancel_order.php">
        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
        <button class="cancel-btn">Cancel</button>
    </form>
<?php } ?>
</div>

</div>

<?php } ?>

</div>

</body>
</html>