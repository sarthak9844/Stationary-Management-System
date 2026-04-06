<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

$result = mysqli_query($conn,"SELECT * FROM items");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Manage Items</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
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
<h1 style="color:rgb(12, 211, 237); font-weight:70px;">Manage Items</h1>
<input type="text" id="search" placeholder="Search item..." onkeyup="searchItem()">

<table border="1" cellpadding="10"
style="border-collapse:collapse; width:100%; text-align:center; background-color:#f2f2f2;">
<tr>
<th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
    $color = ($row['quantity'] < 5) ? "style='background-color:#ffcccc;'" : "style='background-color:#ccffcc;'";
    echo "<tr $color>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['quantity']}</td>
    <td>{$row['price']}</td>
    <td>
        <a href='edit_item.php?id={$row['id']}'>Edit</a> |
        <a href='delete_item.php?id={$row['id']}'>Delete</a>
    </td>
    </tr>";
}
?>

</table>
</div>
</body>
</html>