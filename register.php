<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard - Stationery Management</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="login-body">
<h1 style="color= red; text-align:center;">Stationary Management System</h1>
<div class="login-box">
<h2 style="text-align:center;">Register</h2>
<form method="POST">
<input type="text" name="username" placeholder="Username" required style="width:280px;">
<input type="password" name="password" placeholder="Password" required style="width:280px;">
<button name="reg">Register</button>
</form>

<?php
if(isset($_POST['reg'])){
    mysqli_query($conn,"INSERT INTO users(username,password)
    VALUES('$_POST[username]','$_POST[password]')");
    echo "Registered!";
}
?>
</body>
</html>