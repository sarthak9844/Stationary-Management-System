<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];

    mysqli_query($conn,"INSERT INTO items (name, quantity, price) VALUES ('$name','$qty','$price')");
    header("Location: manage_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Item</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <a href="index.php">Dashboard</a>
    <a href="add_item.php">Add Item</a>
    <a href="manage_items.php">Manage Items</a>
    <a href="issue_item.php">Issue Item</a>
    <a href="transactions.php">Transactions</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
<h1 style="color:rgb(12, 211, 237); font-weight:70px;">Add Item</h1>
<form method="POST">
<input type="text" name="name" placeholder="Item Name" required style="width: 550px;">
<input type="number" name="quantity" placeholder="Quantity" required style="width: 550px;">
<input type="number" name="price" placeholder="Price" required style="width: 550px;">
<button name="add" style="width: 572px; backgound-color:rgb(53, 117, 117);">Add Item</button>
</form>
</div>

</body>
</html>