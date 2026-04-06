<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM items WHERE id=$id");
header("Location: manage_items.php");
exit();
?>