<?php
include_once('config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_evento = $_POST['id_evento'];
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim = $_POST['data_fim'] ?? '';
    $localizacao = $_POST['localizacao'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $idadeMinima = $_POST["idadeMinima"] ?? '';
    $redeSocial = $_POST['redeSocial'] ?? '';
    $site = $_POST['site'] ?? '';
    $tipoEvento = $_POST['tipoEvento'] ?? '';

    // Verifique se id_tipo está vazio ou não é um número
    if (empty($tipoEvento) || !is_numeric($tipoEvento)) {
        echo "Erro: Tipo de evento inválido.";
        exit;
    }

    // Formatação das datas para o formato MySQL
    $data_inicio_formatada = date('Y-m-d', strtotime($data_inicio));
    $data_fim_formatada = date('Y-m-d', strtotime($data_fim));

    // Manipulação da imagem
    if (!empty($_FILES['imagem']['name'])) {
        $imagem = $_FILES['imagem']['tmp_name'];
        $imagem_data = addslashes(file_get_contents($imagem));
        $imagem_tipo = 'Evento';

        // Insert image into imagem table
        $sql_insert_imagem = "INSERT INTO imagem (imagem, tipo) VALUES ('$imagem_data', '$imagem_tipo')";
        $result_imagem = mysqli_query($conn, $sql_insert_imagem);

        if ($result_imagem) {
            // Get the last inserted image id
            $imagem_id = mysqli_insert_id($conn);

            // Construção da query de atualização com a nova imagem
            $sql_update_evento = "
                UPDATE evento 
                SET 
                    nome='$nome', 
                    descricao='$descricao', 
                    data_inicio='$data_inicio_formatada', 
                    data_fim='$data_fim_formatada', 
                    localizacao='$localizacao', 
                    telefone='$telefone', 
                    idadeMinima='$idadeMinima', 
                    rede_social='$redeSocial', 
                    site='$site', 
                    id_tipo='$tipoEvento',
                    imagem_id='$imagem_id'
                WHERE 
                    id_evento='$id_evento'
            ";
        } else {
            echo "Erro ao inserir a imagem: " . mysqli_error($conn);
            exit;
        }
    } else {
        // Construção da query de atualização sem a nova imagem
        $sql_update_evento = "
            UPDATE evento 
            SET 
                nome='$nome', 
                descricao='$descricao', 
                data_inicio='$data_inicio_formatada', 
                data_fim='$data_fim_formatada', 
                localizacao='$localizacao', 
                telefone='$telefone', 
                idadeMinima='$idadeMinima', 
                rede_social='$redeSocial', 
                site='$site', 
                id_tipo='$tipoEvento'
            WHERE 
                id_evento='$id_evento'
        ";
    }

    // Execução da query
    $result = mysqli_query($conn, $sql_update_evento);

    // Verificação do resultado
    if ($result) {
        echo '<!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Evento Update</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                </head>
                <body>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Dados do evento atualizados com sucesso!",
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
        echo "Erro ao atualizar os dados do evento: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Método inválido para acessar esta página.";
}
?>
