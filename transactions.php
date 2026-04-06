<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

// Join items table to show item names
$result = mysqli_query($conn, "
    SELECT t.id, i.name AS item_name, t.user_name, t.type, t.quantity, t.date
    FROM transactions t
    LEFT JOIN items i ON t.item_id = i.id
    ORDER BY t.date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transactions</title>
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
<h1 style="color:rgb(12, 211, 237); font-weight:170px;">Transactions</h1>
<table border="1" cellpadding="10" 
style="border-collapse:collapse; width:100%; text-align:center; background-color:#f2f2f2;">

<tr style="background-color:#2c3e50; color:white;">
<th>ID</th><th>Item Name</th><th>User</th><th>Type</th><th>Quantity</th><th>Date/Time</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){

    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['item_name']}</td>
    <td>{$row['user_name']}</td>
    <td>{$row['type']}</td>
    <td>{$row['quantity']}</td>
    <td>{$row['date']}</td>
    </tr>";
} ?>
</table>
</div>

</body>
</html>