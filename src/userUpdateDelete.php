<?php
session_start();
include_once('config.php');

function safeRedirect($url) {
    if (!headers_sent()) {
        header("Location: $url");
        exit();
    } else {
        echo "<script>window.location.href='$url';</script>";
        exit();
    }
}

// UPDATE
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
        echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Usuário Update</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        </head>
        <body>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
            <script>
            Swal.fire({
                icon: "error",
                title: "As senhas não coincidem.",
                text: "Por favor, tente novamente.",
                confirmButtonColor: "#1E659B"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "userUpdateDelete.php";
                }
            });
        </script>
        </body>
        </html>';
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
            echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuário Update</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            </head>
            <body>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Email já esta sendo utilizado!",
                    confirmButtonColor: "#1E659B"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "meusdados.html";
                    }
                });
            </script>
            </body>
            </html>';
            exit();
        } else {
            $sqlEmail = "UPDATE usuario SET email=? WHERE email=?";
            $stmtEmail = mysqli_prepare($conn, $sqlEmail);
            mysqli_stmt_bind_param($stmtEmail, 'ss', $email_novo, $email_antigo);
            mysqli_stmt_execute($stmtEmail);

            if (mysqli_stmt_affected_rows($stmtEmail) > 0) {
                $_SESSION['email'] = $email_novo;
                echo '<!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Usuário Update</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                </head>
                <body>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Email editado com sucesso.",
                        confirmButtonColor: "#1E659B"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "meusdados.html";
                        }
                    });
                </script>
                </body>
                </html>';
                exit();
            } else {
                echo "Erro ao editar usuário: " . $conn->error;
            }
            safeRedirect("meusdados.php");
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

    safeRedirect("meusdados.php");

// DELETE
} elseif (isset($_POST['delete']) && $_POST['delete'] === 'true') {

    $email = $_SESSION['email'] ?? null;

    if ($email) {
        // Excluir comentários antes de deletar o usuário
        $sqlDeleteComments = "DELETE FROM comentario_estabelecimento WHERE usuario_email = ?";
        $stmtDeleteComments = mysqli_prepare($conn, $sqlDeleteComments);
        mysqli_stmt_bind_param($stmtDeleteComments, "s", $email);
        mysqli_stmt_execute($stmtDeleteComments);
        mysqli_stmt_close($stmtDeleteComments);

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

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        safeRedirect("login.html");

    } else {
        $msg = "Email não fornecido.";
    }
} elseif (isset($_POST['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    safeRedirect('login.html');
}
?>
