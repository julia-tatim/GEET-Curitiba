<?php

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $localizacao = $_POST["localizacao"];
    $nome = $_POST["nomeLocal"];
    $descricao = $_POST["descricaoLocal"];
    $telefone = $_POST["telefone"];
    $redeSocial = $_POST["redeSocial"];
    $site = $_POST["site"];
    $idadeMim = $_POST["idadeMim"];
    $horario_abertura = $_POST["horario_abertura"];
    $horario_fechamento = $_POST["horario_fechamento"];

    // Dados do tipo
    $tipoMapping = [
        "restaurante cabin" => 1,
        "restaurante_vegano cabin" => 2,
        "restaurante_opcao_vegana cabin" => 3,
        "cafe cabin" => 4,
        "cafe_vegano cabin" => 5,
        "entretenimento cabin" => 6,
        "pontos_turisticos cabin" => 7
    ];
    $tipoSelecionado = $_POST['tipoLocal'];
    $id_tipo = $tipoMapping[$tipoSelecionado];

    // Verifica se as imagens foram enviadas
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Caminho temporário do arquivo
        $imagem_temp = $_FILES['imagem']['tmp_name'];

        $conteudo_imagem = file_get_contents($imagem_temp);

        $sql_imagem = "INSERT INTO imagem (imagem, tipo) VALUES (?, 'Estabelecimento')";
        $stmt_imagem = mysqli_prepare($conn, $sql_imagem);

        if ($stmt_imagem) {
            mysqli_stmt_bind_param($stmt_imagem, 's', $conteudo_imagem);
            if (mysqli_stmt_execute($stmt_imagem)) {
                $id_imagem = mysqli_insert_id($conn);
                
                // Verifica se já existe o nome e telefone no banco
                $sql_check_nome = "SELECT * FROM estabelecimento WHERE nome = ?";
                $stmt_check_nome = mysqli_prepare($conn, $sql_check_nome);
                mysqli_stmt_bind_param($stmt_check_nome, 's', $nome);
                mysqli_stmt_execute($stmt_check_nome);
                $result_check_nome = mysqli_stmt_get_result($stmt_check_nome);

                if ($result_check_nome && mysqli_num_rows($result_check_nome) > 0) {
                    echo '<!DOCTYPE html>
                        <html lang="pt-br">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Cadastro Local</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                        </head>
                        <body>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                            <script>
                            Swal.fire({
                                icon: "error",
                                title: "O nome já está em uso.",
                                text: "Por favor, insira outro nome.",
                                confirmButtonColor: "#1E659B"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cadastroLocalhtml.php";
                                }
                            });
                        </script>
                        </body>
                        </html>';
                    exit();
                } else {
                    $sql_check_fone = "SELECT * FROM estabelecimento WHERE telefone = ?";
                    $stmt_check_fone = mysqli_prepare($conn, $sql_check_fone);
                    mysqli_stmt_bind_param($stmt_check_fone, 's', $telefone);
                    mysqli_stmt_execute($stmt_check_fone);
                    $result_check_fone = mysqli_stmt_get_result($stmt_check_fone);

                    if ($result_check_fone && mysqli_num_rows($result_check_fone) > 0) {
                        echo '<!DOCTYPE html>
                        <html lang="pt-br">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Cadastro Local</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                        </head>
                        <body>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                            <script>
                            Swal.fire({
                                icon: "error",
                                title: "O telefone já está em uso.",
                                text: "Por favor, insira outro telefone.",
                                confirmButtonColor: "#1E659B"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cadastroLocalhtml.php";
                                }
                            });
                        </script>
                        </body>
                        </html>';
                        exit();
                    } else {

                        $sql_estabelecimento = "INSERT INTO estabelecimento (localizacao, nome, descricao, telefone, rede_social, site, idadeMinima, horario_abertura, horario_fechamento, imagem_id, id_tipo)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                        $stmt = mysqli_prepare($conn, $sql_estabelecimento);
                        mysqli_stmt_bind_param($stmt, "ssssssssssi", $localizacao, $nome, $descricao, $telefone, $redeSocial, $site, $idadeMim, $horario_abertura, $horario_fechamento, $id_imagem, $id_tipo);

                        if (mysqli_stmt_execute($stmt)) {
                            echo '<!DOCTYPE html>
                                <html lang="pt-br">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Cadastro Local</title>
                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                                </head>
                                <body>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Estabelecimento registrado com sucesso.",
                                        confirmButtonColor: "#1E659B"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "explorarHTML.php";
                                        }
                                    });
                                </script>
                                </body>
                                </html>';
                            exit();
                            echo '<script>alert(""); window.location.href = "explorarHTML.php";</script>';
                            exit();
                        } else {
                            echo '<!DOCTYPE html>
                        <html lang="pt-br">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Cadastro Local</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                        </head>
                        <body>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                            <script>
                            Swal.fire({
                                icon: "error",
                                title: "Erro ao registrar estabelecimento.",
                                confirmButtonColor: "#1E659B"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cadastroLocalhtml.php";
                                }
                            });
                        </script>
                        </body>
                        </html>';
                        exit();
                        }

                        mysqli_stmt_close($stmt);
                    }
                }

                mysqli_stmt_close($stmt_check_nome);
                mysqli_stmt_close($stmt_check_fone);
            } else {
                echo "Erro ao executar a consulta de inserção de imagem: " . mysqli_error($conn);
            }

            // Fechar a declaração da imagem
            mysqli_stmt_close($stmt_imagem);
        } else {
            echo "Erro ao preparar a consulta de inserção de imagem: " . mysqli_error($conn);
        }
    } else {
        echo '<!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Cadastro Local</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                </head>
                <body>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                    <script>
                    Swal.fire({
                        icon: "error",
                        title: "Nenhuma imagem selecionada.",
                        text: "Por favor, selecione pelo menos uma imagem.",
                        confirmButtonColor: "#1E659B"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "cadastroLocalhtml.php";
                        }
                    });
                </script>
                </body>
                </html>';
            exit();
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
} else {
    echo "Método inválido para acessar esta página.";
}
?>
