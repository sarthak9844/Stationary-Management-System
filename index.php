<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

// Fetch data
$total_items = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM items"));
$low_stock = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM items WHERE quantity < 5"));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard - Stationery Management</title>
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
<h2 id="head1">Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
<p  id="head2">This is your Stationery Management Dashboard.</p>

<!-- DASHBOARD CARDS -->
<div class="cards">

    <div class="card blue">
        <h3>Total Items</h3>
        <p><?php echo $total_items; ?></p>
    </div>

    <div class="card red">
        <h3>Low Stock</h3>
        <p><?php echo $low_stock; ?></p>
    </div>

    <div class="card green">
        <h3>Status</h3>
        <p>Active</p>
    </div>

</div>

</div>

<footer>
<p>© 2026 Stationery Management System | Developed for Web Dev Mini Project</p>
</footer>

</body>
</html>