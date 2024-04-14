<?php 
$servername = "localhost";
$username = "root";
$password = "A992176566kemi_";
$database = "geet";

$conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

?>