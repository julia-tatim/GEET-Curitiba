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
            echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuário Login</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            </head>
            <body>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Usuário não encontrado ou credenciais inválidas.",
                    text: "Por favor, tente novamente.",
                    confirmButtonColor: "#1E659B"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.html";
                    }
                });
            </script>
            </body>
            </html>';
            exit();
        }
    }

    // Verifica se é um administrador
    if ($dbEmailAdmin) {
        if ($senha === $dbSenhaAdmin) { // Certifique-se de usar a mesma lógica de senha (plain text ou hash) para admin
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: paginaADM.php'); // Página para administradores
            exit();
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Admin Login</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            </head>
            <body>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Administrador não encontrado ou credenciais inválidas.",
                    text: "Por favor, tente novamente.",
                    confirmButtonColor: "#1E659B"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.html";
                    }
                });
            </script>
            </body>
            </html>';
            exit();
        }
    }

    // Se não encontrou em nenhuma das tabelas
    echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Usuário Login</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        </head>
        <body>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
            <script>
            Swal.fire({
                icon: "error",
                title: "Usuário ou administrador não encontrado ou credenciais inválidas.",
                text: "Por favor, tente novamente.",
                confirmButtonColor: "#1E659B"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.html";
                }
            });
        </script>
        </body>
        </html>';
    exit();
}
else {
    header('Location: login.html');
    exit();
}
?>
