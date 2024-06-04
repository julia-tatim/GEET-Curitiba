<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica na tabela de usuários
    $queryUser = "SELECT email, senha FROM usuario WHERE email = ?";
    $stmtUser = $conn->prepare($queryUser);
    $stmtUser->bind_param("s", $email);
    $stmtUser->execute();
    $stmtUser->bind_result($dbEmailUser, $dbSenhaUser);
    $stmtUser->fetch();
    $stmtUser->close();

    // Verifica na tabela de administradores
    $queryAdmin = "SELECT email, senha FROM administrador WHERE email = ?";
    $stmtAdmin = $conn->prepare($queryAdmin);
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();
    $stmtAdmin->bind_result($dbEmailAdmin, $dbSenhaAdmin);
    $stmtAdmin->fetch();
    $stmtAdmin->close();

    // Verifica se é um usuário
    if ($dbEmailUser) {
        if (password_verify($senha, $dbSenhaUser)) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: index.php'); // Página para usuários
            exit();
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            echo '<script>alert("Usuário não encontrado ou credenciais inválidas. Por favor, tente novamente."); window.location.href = "login.html";</script>';
            exit();
        }
    }

    // Verifica se é um administrador
    if ($dbEmailAdmin) {
        if ($senha === $dbSenhaAdmin) { // Certifique-se de usar a mesma lógica de senha (plain text ou hash) para admin
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: cadastroLocalhtml.php'); // Página para administradores
            exit();
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            echo '<script>alert("Administrador não encontrado ou credenciais inválidas. Por favor, tente novamente."); window.location.href = "login.html";</script>';
            exit();
        }
    }

    // Se não encontrou em nenhuma das tabelas
    echo '<script>alert("Usuário ou administrador não encontrado ou credenciais inválidas. Por favor, tente novamente."); window.location.href = "login.html";</script>';
    exit();
}
else {
    header('Location: login.html');
    exit();
}
?>
