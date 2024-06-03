<?php
session_start();
include_once('config.php');

//UPDATE
if (isset($_POST['update'])) {

    $email_antigo = $_SESSION['email']; 
    $email_novo = $_POST['email']; 
    $nome = $_POST['nome']; 
    $senha = $_POST['senha']; 
    $confirmaSenha = $_POST['confirmaSenha']; 
    $data_nascimento = $_POST['data_nascimento']; 
    $imagem = $_FILES['imagem']['tmp_name'];
    $imagem_data = null;

    if ($imagem) {
        $imagem_data = file_get_contents($imagem);
    }

    if ($senha !== $confirmaSenha) {
        echo '<script>alert("As senhas não coincidem.");</script>';
        exit();
    } else {
        $crypt = password_hash($senha, PASSWORD_BCRYPT);

        $sqlSenha = "UPDATE usuario SET senha=? WHERE email=?";
        $stmtSenha = mysqli_prepare($conn, $sqlSenha);
        mysqli_stmt_bind_param($stmtSenha, 'ss', $crypt, $email_antigo);
        mysqli_stmt_execute($stmtSenha);
    }

    if ($email_antigo !== $email_novo) {
        $sqlCheckEmail = "SELECT COUNT(*) AS count FROM usuario WHERE email=?";
        $stmtCheckEmail = mysqli_prepare($conn, $sqlCheckEmail);
        mysqli_stmt_bind_param($stmtCheckEmail, 's', $email_novo);
        mysqli_stmt_execute($stmtCheckEmail);
        $resultCheckEmail = mysqli_stmt_get_result($stmtCheckEmail);
        $row = mysqli_fetch_assoc($resultCheckEmail);
        $emailExistente = $row['count'];
        if ($emailExistente > 0) {
            echo '<script>alert("Este email já está sendo utilizado.");</script>';
        } else {
            $sqlEmail = "UPDATE usuario SET email=? WHERE email=?";
            $stmtEmail = mysqli_prepare($conn, $sqlEmail);
            mysqli_stmt_bind_param($stmtEmail, 'ss', $email_novo, $email_antigo);
            mysqli_stmt_execute($stmtEmail);

            if (mysqli_stmt_affected_rows($stmtEmail) > 0) {
                $_SESSION['email'] = $email_novo;
                echo '<script>alert("Email editado com sucesso.");</script>';
            } else {
                echo "Erro ao editar usuário: " . $conn->error;
            }
            header("Location: meusdados.php");
            exit();
        }
    }

    $sqlUpdate = "UPDATE usuario SET nome=?, data_nascimento=? WHERE email=?";
    $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
    mysqli_stmt_bind_param($stmtUpdate, 'sss', $nome, $data_nascimento, $email_antigo);
    mysqli_stmt_execute($stmtUpdate);

    if ($imagem_data) {
        $sqlImagem = "UPDATE usuario SET imagem=? WHERE email=?";
        $stmtImagem = mysqli_prepare($conn, $sqlImagem);
        mysqli_stmt_bind_param($stmtImagem, 'bs', $imagem_data, $email_antigo);
        mysqli_stmt_send_long_data($stmtImagem, 0, $imagem_data);
        mysqli_stmt_execute($stmtImagem);
    }

    header("Location: meusdados.php");
    exit();

//DELETE
} elseif (isset($_POST['delete'])) {

    if (!empty($_POST['email'])) {
        
        $email = $_POST['email'];

        $sql = "DELETE FROM usuario WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Usuário deletado com sucesso.");</script>';
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
        } else {
            $msg = "Erro ao deletar: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
        header("Location: login.html");
        exit();

    } else {
        $msg = "Email não fornecido.";
    }
} elseif (isset($_POST['logout'])) {

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.html');
    exit();
}
?>