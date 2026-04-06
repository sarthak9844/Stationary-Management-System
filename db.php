<?php
$servername = "localhost";
$username = "root";
$password = "Mysql@123";
$dbname = "stationery_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>