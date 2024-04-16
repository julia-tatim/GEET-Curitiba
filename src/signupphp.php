<?php
include "config.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nascimento = $_POST["nascimento"];

    $crypt = password_hash($senha, PASSWORD_BCRYPT);
    echo($crypt);

    $sql = "INSERT INTO usuario (nome, senha, email, data_nascimento) VALUES ('$nome', '$crypt', '$email', '$nascimento')";

    if(mysqli_query($conn, $sql)){
        //adicionar mensagem de sucesso
        header("Location: login.html");
        exit();
    }else{
        $msg = "Erro ao gravar: " . mysqli_error($conn);//adicionar mensagem de erro
    }

    mysqli_close($conn);
?>
