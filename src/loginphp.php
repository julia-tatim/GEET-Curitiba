<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "A992176566kemi_";
$database = "geet";

$conn = new mysqli($servername, $username, $password, $database);

$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT email, senha FROM usuario WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($dbEmail, $dbSenha);
$stmt->fetch();

if ($dbEmail) {
    // Compare the provided password with the hashed password from the database
    if (password_verify($senha, $dbSenha)) {
        // Authentication successful, set session variables
        $_SESSION["email"] = $email;
        header("Location: index.html");
        exit();
    } else {
        // Invalid password
        echo "<script>alert('Email e/ou senha incorretos');window.location.href='login.html';</script>";
        exit();
    }
} else {
    // Email not found in the database
    echo "<script>alert('Email e/ou senha incorretos');window.location.href='login.html';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>
