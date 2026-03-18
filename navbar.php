<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <div class="logo">KrishiConnect 🌾</div>

    <div class="links">

        <?php
        if(isset($_SESSION['role'])){

            if($_SESSION['role']=="farmer"){
                echo '<a href="farmer_dashboard.php">Dashboard</a>';
            }else{
                echo '<a href="index.php">Shop</a>';
                echo '<a href="cart.php">Cart</a>';
                echo '<a href="my_orders.php">My Orders</a>';
            }

            echo '<a href="logout.php">Logout</a>';

        }else{
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        }
        ?>

    </div>
</div>