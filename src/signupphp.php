<?php
include "config.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$confirmaSenha = $_POST["confirmaSenha"];
$senha = $_POST["senha"];
$nascimento = $_POST["nascimento"];

// Check if the email already exists in the database
$query = "SELECT * FROM usuario WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Email already exists, redirect back to signup page with an error message
    echo '<script>alert("Este email já está sendo utilizado."); window.location.href = "login.html";</script>';
    exit();
} else {
    // Email doesn't exist, proceed with insertion
    if ($senha !== $confirmaSenha) {
        echo '<script>alert("As senhas não coincidem."); window.location.href = "login.html";</script>';//mandar mensagem as senhas não coincidem
    } else {
        $cryptSenha = password_hash($senha, PASSWORD_BCRYPT);
        $cryptConfirma = password_hash($confirmaSenha, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuario (nome, senha, email, data_nascimento, confirmaSenha) VALUES ('$nome', '$cryptSenha', '$email', '$nascimento', '$cryptConfirma')";

        if(mysqli_query($conn, $sql)){
            // Insertion successful, redirect to login page
            echo '<script>alert("Usuário registrado com sucesso."); window.location.href = "login.html";</script>';
            exit();
        } else {
            // Insertion failed, redirect back to signup page with an error message
            $_SESSION["error"] = "Erro ao inserir registro no banco de dados.";
            header("Location: Login.html");
            exit();
        }
    }
}

mysqli_close($conn);
?>
