<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT email, senha FROM usuario WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($dbEmail, $dbSenha);
    $stmt->fetch();
    
    if ($dbEmail) {
        if (password_verify($senha, $dbSenha)) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
            exit();
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.html'); //adicionar mensagem de usuário não encontrado/ não existe
            exit();
        }
    } else {
        echo "<script>alert('Email e/ou senha incorretos');window.location.href='login.html';</script>";//adicionar mensagem de usuário não encontrado/ não existe
        exit();
    }
    
    $stmt->close();
    $conn->close();

}
else {
    header('Location: login.html');
    exit();
}

?>