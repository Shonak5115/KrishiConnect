<?php
include("db.php");

if(isset($_POST['name'])){

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$role=$_POST['role'];

mysqli_query($conn,
"INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','$role')");

header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="main-container">
<div class="form-card">

<h2>Create Your Account 🚀</h2>

<form method="POST">

<div class="input-group">
<input type="text" name="name" placeholder="Full Name" required>
</div>

<div class="input-group">
<input type="email" name="email" placeholder="Email Address" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Create Password" required>
</div>

<div class="input-group">
<select name="role" required>
<option value="">Select Role</option>
<option value="customer">Customer</option>
<option value="farmer">Farmer</option>
</select>
</div>

<button type="submit">Register</button>

</form>

<p>Already have account? <a href="login.php">Login</a></p>

</div>
</div>

<footer>
© 2026 KrishiConnect | Farmer to Consumer 🌾
</footer>

</body>
</html>