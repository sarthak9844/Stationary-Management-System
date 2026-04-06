<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

$id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * FROM items WHERE id=$id");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE items SET name='$_POST[name]', quantity='$_POST[quantity]', price='$_POST[price]' WHERE id=$id");
    header("Location: manage_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Item</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <a href="index.php">Dashboard</a>
    <a href="manage_items.php">Manage Items</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
<h2>Edit Item</h2>
<form method="POST">
<input type="text" name="name" value="<?php echo $data['name']; ?>" required>
<input type="number" name="quantity" value="<?php echo $data['quantity']; ?>" required>
<input type="number" name="price" value="<?php echo $data['price']; ?>" required>
<button name="update">Update</button>
</form>
</div>

</body>
</html>