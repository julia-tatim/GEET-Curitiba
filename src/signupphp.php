<?php
include "config.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$confirmaSenha = $_POST["confirmaSenha"];
$senha = $_POST["senha"];
$nascimento = $_POST["nascimento"];

if(empty($nome) || empty($email) || empty($confirmaSenha) || empty($senha) || empty($nascimento)){
    header("Location: Login.html");
    exit();
}

// Verifique se o email já existe no banco de dados
$query_check_email = "SELECT * FROM usuario WHERE email = ?";
$stmt_check_email = mysqli_prepare($conn, $query_check_email);
mysqli_stmt_bind_param($stmt_check_email, 's', $email);
mysqli_stmt_execute($stmt_check_email);
mysqli_stmt_store_result($stmt_check_email);

if (mysqli_stmt_num_rows($stmt_check_email) > 0) {
    echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuário Cadastrado</title>
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
                        window.location.href = "login.html";
                    }
                });
            </script>
            </body>
            </html>';
    exit();
}

$cryptSenha = password_hash($senha, PASSWORD_BCRYPT);
$cryptConfirma = password_hash($confirmaSenha, PASSWORD_BCRYPT);

        $id_usuario = $email; // Assume o email como identificador único
        
        // Verifica se a imagem foi enviado
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK && $_FILES['imagem']['size'] > 0) {
            // Se a imagem foi enviada
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            $max_size = 5 * 1024 * 1024; // 5MB
            
            if (!in_array($_FILES['imagem']['type'], $allowed_types)) {
                echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuário Cadastrado</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            </head>
            <body>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Tipo de arquivo não suportado. Apenas JPEG, PNG e GIF são permitidos.",
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
            
            if ($_FILES['imagem']['size'] > $max_size) {
                echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuário Cadastrado</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            </head>
            <body>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                Swal.fire({
                    icon: "error",
                    title: "O tamanho do arquivo excede o limite permitido (5MB).",
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
            
            $conteudo_imagem = file_get_contents($imagem_temp);
            
            $sql_insert_user = "INSERT INTO usuario (nome, senha, email, data_nascimento, confirmaSenha) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert_user = mysqli_prepare($conn, $sql_insert_user);

            if ($stmt_insert_user) {

                mysqli_stmt_bind_param($stmt_insert_user, 'sssss', $nome, $cryptSenha, $email, $nascimento, $cryptConfirma);

                if(mysqli_stmt_execute($stmt_insert_user)){ 

                    $sql_insert_image = "UPDATE usuario SET imagem = ? WHERE email = ?";
                    $stmt_insert_image = mysqli_prepare($conn, $sql_insert_image);
                    
                    if ($stmt_insert_image) {
                        mysqli_stmt_bind_param($stmt_insert_image, 'ss', $conteudo_imagem, $id_usuario);
                        if (mysqli_stmt_execute($stmt_insert_image)) {
                            echo '<!DOCTYPE html>
                                <html lang="pt-br">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Usuário Cadastrado</title>
                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                                </head>
                                <body>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Usuário registrado com sucesso.",
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
                        } else {

                            $_SESSION["error"] = "Erro ao inserir imagem do usuário.";
                            header("Location: Login.html");
                            exit();
                        }
                    } else {
                        echo "Erro ao preparar a consulta de inserção de imagem: " . mysqli_error($conn);
                        exit();
                    }

                } else {
                    $_SESSION["error"] = "Erro ao inserir dados do usuário.";
                    header("Location: Login.html");
                    exit();
                }
            } else {
                echo "Erro ao preparar a consulta de inserção de usuário: " . mysqli_error($conn);
                exit();
            }

            
        } else {
            // se a imagem nao foi enviada
            $sql_insert_user = "INSERT INTO usuario (nome, senha, email, data_nascimento, confirmaSenha) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert_user = mysqli_prepare($conn, $sql_insert_user);
            if ($stmt_insert_user) {
                mysqli_stmt_bind_param($stmt_insert_user, 'sssss', $nome, $cryptSenha, $email, $nascimento, $cryptConfirma);
                if(mysqli_stmt_execute($stmt_insert_user)){
                    echo '<!DOCTYPE html>
                            <html lang="pt-br">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Usuário Cadastrado</title>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                            </head>
                            <body>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                <script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Usuário registrado com sucesso.",
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
                } else {
                    $_SESSION["error"] = "Erro ao inserir dados do usuário.";
                    header("Location: Login.html");
                    exit();
                }
            } else {
                echo "Erro ao preparar a consulta de inserção de usuário: " . mysqli_error($conn);
                exit();
            }
        }
        echo '<!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Usuário Cadastrado</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                </head>
                <body>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Usuário registrado com sucesso.",
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
    

?>
