<?php

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $localizacao = $_POST["localizacao"];
    $nome = $_POST["nomeEvento"];
    $descricao = $_POST["descricaoEvento"];
    $telefone = $_POST["telefone"];
    $redeSocial = $_POST["redeSocial"];
    $site = $_POST["site"];
    $idadeMinima = $_POST["idadeMinima"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];

    // Dados do tipo
    $tipoMapping = [
        "conferencia cabin" => 1,
        "festival cabin" => 2,
        "seminario cabin" => 3,
        "feira cabin" => 4,
        "workshop cabin" => 5,
        "concerto cabin" => 6,
        "exposicao cabin" => 7
    ];
    $tipoSelecionado = $_POST['tipoEvento'];
    $id_tipo = $tipoMapping[$tipoSelecionado];

    // Verifica se as imagens foram enviadas
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Caminho temporário do arquivo
        $imagem_temp = $_FILES['imagem']['tmp_name'];

        $conteudo_imagem = file_get_contents($imagem_temp);

        $sql_imagem = "INSERT INTO imagem (imagem, tipo) VALUES (?, 'Evento')";
        $stmt_imagem = mysqli_prepare($conn, $sql_imagem);

        if ($stmt_imagem) {
            mysqli_stmt_bind_param($stmt_imagem, 's', $conteudo_imagem);
            if (mysqli_stmt_execute($stmt_imagem)) {
                $id_imagem = mysqli_insert_id($conn);
                
                // Verifica se já existe o nome no banco
                $sql_check_nome = "SELECT * FROM evento WHERE nome = ?";
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
                            <title>Cadastro Evento</title>
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
                                    window.location.href = "cadastroEventohtml.php";
                                }
                            });
                        </script>
                        </body>
                        </html>';
                    exit();
                } else {
                    $sql_evento = "INSERT INTO evento (localizacao, nome, descricao, telefone, rede_social, site, idadeMinima, data_inicio, data_fim, imagem_id, id_tipo)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = mysqli_prepare($conn, $sql_evento);
                    mysqli_stmt_bind_param($stmt, "ssssssssssi", $localizacao, $nome, $descricao, $telefone, $redeSocial, $site, $idadeMinima, $data_inicio, $data_fim, $id_imagem, $id_tipo);

                    if (mysqli_stmt_execute($stmt)) {
                        echo '<!DOCTYPE html>
                                <html lang="pt-br">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Cadastro Evento</title>
                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                                </head>
                                <body>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Evento registrado com sucesso.",
                                        confirmButtonColor: "#1E659B"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "explorarEventosHTML.php";
                                        }
                                    });
                                </script>
                                </body>
                                </html>';
                        exit();
                    } else {
                        echo '<!DOCTYPE html>
                        <html lang="pt-br">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Cadastro Evento</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                        </head>
                        <body>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                            <script>
                            Swal.fire({
                                icon: "error",
                                title: "Erro ao registrar evento.",
                                confirmButtonColor: "#1E659B"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cadastroEventohtml.php";
                                }
                            });
                        </script>
                        </body>
                        </html>';
                        exit();
                    }

                    mysqli_stmt_close($stmt);
                }

                mysqli_stmt_close($stmt_check_nome);
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
                    <title>Cadastro Evento</title>
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
                    }).then
                    ((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "cadastroEventohtml.php";
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
