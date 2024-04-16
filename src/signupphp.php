<?php
include "config.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $confirmaSenha = $_POST["confirmaSenha"];
    $senha = $_POST["senha"];
    $nascimento = $_POST["nascimento"];
//fazer verificação se não está vazio e regex
    if ($senha !== $confirmaSenha) {
        echo "erro";//mandar mensagem as senhas não coincidem
    }else{

    $cryptSenha = password_hash($senha, PASSWORD_BCRYPT);
    $cryptConfirma = password_hash($confirmaSenha, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuario (nome, senha, email, data_nascimento, confirmaSenha) VALUES ('$nome', '$cryptSenha', '$email', '$nascimento', '$cryptConfirma')";

        if(mysqli_query($conn, $sql)){
            //adicionar mensagem de sucesso
            header("Location: login.html");
            exit();
        }else{
            $msg = "Erro ao gravar: " . mysqli_error($conn);//adicionar mensagem de erro
        }
    }
    mysqli_close($conn);
?>
