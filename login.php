<?php
session_start();
include("db.php");

if(isset($_POST['email'])){

$email=$_POST['email'];
$password=$_POST['password'];

$result=mysqli_query($conn,
"SELECT * FROM users WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($result)>0){

$user=mysqli_fetch_assoc($result);

$_SESSION['user_id']=$user['id'];
$_SESSION['user_name']=$user['name'];
$_SESSION['role']=$user['role'];

if($user['role']=="admin"){

$_SESSION['admin']=$user['id'];
header("Location: admin/admin_dashboard.php");
exit();

}
elseif($user['role']=="farmer"){

header("Location: farmer_dashboard.php");
exit();

}
else{

header("Location: index.php");
exit();

}

}else{
echo "<script>alert('Invalid Credentials');</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="main-container">
<div class="form-card">

<h2>Welcome Back 👋</h2>

<form method="POST">

<div class="input-group">
<input type="email" name="email" placeholder="Enter Email" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Enter Password" required>
</div>

<button type="submit">Login</button>

</form>

<p>Don't have account? <a href="register.php">Create Account</a></p>

</div>
</div>

<footer>
© 2026 KrishiConnect | Farmer to Consumer 🌾
</footer>

</body>
</html>