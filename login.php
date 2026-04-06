<?php
session_start();
include 'db.php';

// If already logged in, redirect to dashboard
if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = mysqli_query($conn,"SELECT * FROM users WHERE username='$u' AND password='$p'");
    
    if(mysqli_num_rows($res) > 0){
        $_SESSION['user'] = $u;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login - Stationery Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
<h1 style="color= red; text-align:center;">Stationary Management System</h1>
<div class="login-box">
<h2 style="text-align:center;">Login</h2>
<form method="POST">
<input type="text" name="username" placeholder="Username" required style="width:280px;">
<input type="password" name="password" placeholder="Password" required style="width:280px;">
<button type="submit" name="login">Login</button>
<p style="text-align:center;">
  New user? Click here to <a href="register.php">register</a>
</p>
</form>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
</div>
<footer>
<p>© 2026 Stationery Management System | Developed for Web Dev Mini Project</p>
</footer>
</body>
</html>