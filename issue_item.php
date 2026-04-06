<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

// Fetch all items
$items_res = mysqli_query($conn, "SELECT * FROM items");

if(isset($_POST['issue'])){
    $item_id = $_POST['item_id'];
    $qty = $_POST['quantity'];

    $item_res = mysqli_query($conn, "SELECT * FROM items WHERE id=$item_id");
    $item = mysqli_fetch_assoc($item_res);

    if($qty > $item['quantity']){
        $error = "Not enough stock!";
    } else {
        // Reduce stock
        mysqli_query($conn, "UPDATE items SET quantity = quantity - $qty WHERE id=$item_id");

        // Record transaction in your table
        mysqli_query($conn, "INSERT INTO transactions (item_id, user_name, type, quantity) 
                             VALUES ('$item_id','{$_SESSION['user']}','issue','$qty')");

        $success = "Item issued successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Issue Item</title>
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
<h1 style="color:rgb(12, 211, 237); font-weight:80px;">Issue Item</h1>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>

<form method="POST">
<select style="height:30px; width: 550px;" name="item_id" required>
<option value="">Select Item</option>
<?php while($row = mysqli_fetch_assoc($items_res)) {
    echo "<option value='{$row['id']}'>{$row['name']} (Stock: {$row['quantity']})</option>";
} ?>
</select>
<input type="number" name="quantity" placeholder="Quantity to Issue" required style="width: 532px;">
<button name="issue" style="width: 550px;">Issue Item</button>
</form>
</div>

</body>
</html>