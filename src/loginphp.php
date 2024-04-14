<?php
$servername = "localhost";
$username = "root";
$password = "A992176566kemi_";
$database = "geet";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

$email = $_POST["email"];
$entrar = $_POST["login"];
$senha = $_POST["senha"];

if (isset($entrar)) {
    $query_user = "SELECT * FROM usuario WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
    $result_user = mysqli_query($conn, $query_user);

    $query_admin = "SELECT * FROM administrador WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
    $result_admin = mysqli_query($conn, $query_admin);

    if (!$result_user || !$result_admin || (mysqli_num_rows($result_user) <= 0 && mysqli_num_rows($result_admin) <= 0)){
        echo "<script language='javascript'>alert('email e/ou senha incorretos');window.location.href='login.php';</script>";
        die();
    } else {
        setcookie("email", $email);
        header("Location:index.php");
    }
}


?>