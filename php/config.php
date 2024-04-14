<?php 
    $servername = "localhost";
    $username = "root";
    $password = "A992176566kemi_";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>