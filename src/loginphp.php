<?php
$servername = "localhost";
$username = "root";
$password = "A992176566kemi_";
$database = "geet";

$conn = new mysqli($servername, $username, $password, $database);

$email = $_POST["email"];
$entrar = $_POST["login"];
$senha = $_POST["senha"];

$query = "SELECT senha from usuario where email = '$email'";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
         setcookie("email", $email);
         header("Location:index.html");
     }else {
         echo "<script language='javascript'>alert('email e/ou senha incorretos');window.location.href='login.html';</script>";
     }
}
// if (isset($entrar)) {
//     if (password_verify($input_hash, $stored_hash)) {
//         setcookie("email", $email);
//         header("Location:index.html");
//     }else {
//         echo "<script language='javascript'>alert('email e/ou senha incorretos');window.location.href='login.html';</script>";
//     }
// }


?>