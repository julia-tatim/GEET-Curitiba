<?php
include_once('config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_estabelecimento = $_POST['id_estabelecimento'];
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $localizacao = $_POST['localizacao'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $horario_abertura = $_POST['horario_abertura'] ?? '';
    $horario_fechamento = $_POST['horario_fechamento'] ?? '';
    $idadeMinima = $_POST["idadeMinima"];
    $redeSocial = $_POST['redeSocial'] ?? '';
    $site = $_POST['site'] ?? '';
    $tipoLocal = $_POST['tipoLocal'] ?? '';

    // Formatando os valores para salvar no formato hh:mm:ss
    // Formatação dos horários
    $horario_abertura_formatado = date('H:i:s', strtotime($horario_abertura));
    $horario_fechamento_formatado = date('H:i:s', strtotime($horario_fechamento));

    // Construção da query de atualização
    $sql_update_estabelecimento = "
        UPDATE estabelecimento 
        SET 
            localizacao='$localizacao', 
            nome='$nome', 
            descricao='$descricao', 
            telefone='$telefone', 
            rede_social='$redeSocial', 
            site='$site', 
            idadeMinima='$idadeMinima', 
            horario_abertura='$horario_abertura_formatado', 
            horario_fechamento='$horario_fechamento_formatado', 
            id_tipo='$tipoLocal' 
        WHERE 
            id_estabelecimento='$id_estabelecimento'
    ";

    // Execução da query
    $result = mysqli_query($conn, $sql_update_estabelecimento);

    // Verificação do resultado
    if ($result) {
        echo '<script>
                alert("Dados do estabelecimento atualizados com sucesso!");
                window.location.href = "explorarHTML.php";
            </script>';
    } else {
        echo "Erro ao atualizar os dados do estabelecimento: " . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_close($stmt_update_estabelecimento);

    // Verificar se um arquivo de imagem foi enviado
    if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        
        $imagem = file_get_contents($imagem_temp);

        if ($imagem !== false) {
            // Obter o ID da imagem associada a este estabelecimento
            $sql_select_imagem_id = "SELECT imagem_id FROM estabelecimento WHERE id_estabelecimento=?";
            $stmt_select_imagem_id = mysqli_prepare($conn, $sql_select_imagem_id);
            mysqli_stmt_bind_param($stmt_select_imagem_id, 'i', $id_estabelecimento);
            mysqli_stmt_execute($stmt_select_imagem_id);
            mysqli_stmt_bind_result($stmt_select_imagem_id, $imagem_id);

            if (mysqli_stmt_fetch($stmt_select_imagem_id)) {
                mysqli_stmt_close($stmt_select_imagem_id);

                $sql_update_imagem = "UPDATE imagem SET imagem=? WHERE id_imagem=?";
                $stmt_update_imagem = mysqli_prepare($conn, $sql_update_imagem);

                if (!$stmt_update_imagem) {
                    die("Falha ao preparar a consulta de atualização da imagem: " . mysqli_error($conn));
                }

                mysqli_stmt_bind_param($stmt_update_imagem, 'si', $imagem, $imagem_id);

                if (mysqli_stmt_execute($stmt_update_imagem)) {
                    echo '<script>alert("Imagem atualizada com sucesso!");</script>';
                } else {
                    echo "Erro ao atualizar a imagem: " . mysqli_stmt_error($stmt_update_imagem);
                }

                // Fechar a declaração preparada de atualização da imagem
                mysqli_stmt_close($stmt_update_imagem);
            } else {
                echo "ID da imagem não encontrado para este estabelecimento.";
            }
        } else {
            echo "Falha ao ler o conteúdo da imagem.<br>";
        }
    }
} else {
    echo "Método inválido para acessar esta página.";
}
?>

