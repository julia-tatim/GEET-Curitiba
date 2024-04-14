<?php
include "../php/config.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nascimento = $_POST["nascimento"];

    $crypt = password_hash($senha, PASSWORD_BCRYPT);
    echo($crypt);

    $sql = "INSERT INTO usuario (nome, senha, email, data_nascimento) VALUES ('$nome', '$crypt', '$email', '$nascimento')";

    if(mysqli_query($conn, $sql)){
        $msg = "Gravado com sucesso!";
        // Redirect to login page
        header("Location: login.html");
        exit(); // Make sure to exit after redirecting
    }else{
        $msg = "Erro ao gravar: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
