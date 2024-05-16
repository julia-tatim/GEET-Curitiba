<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    include_once('config.php'); // Inclui arquivo de configuração do banco de dados

    // Verifica se o ID do estabelecimento foi enviado
    if (isset($_POST['id_estabelecimento'])) {
        $id_estabelecimento = $_POST['id_estabelecimento'];

        // Prepara e executa a exclusão do estabelecimento
        $sql_delete_estabelecimento = "DELETE FROM estabelecimento WHERE id_estabelecimento = ?";
        $stmt = $conn->prepare($sql_delete_estabelecimento);
        $stmt->bind_param("i", $id_estabelecimento);
        $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            // Obtem o ID da imagem associada ao estabelecimento excluído
            $sql_select_imagem = "SELECT imagem_id FROM estabelecimento WHERE id_estabelecimento = ?";
            $stmt_select = $conn->prepare($sql_select_imagem);
            $stmt_select->bind_param("i", $id_estabelecimento);
            $stmt_select->execute();
            $stmt_select->bind_result($imagem_id);
            $stmt_select->fetch();
            $stmt_select->close();

            // Se houver uma imagem associada, exclui a imagem
            if ($imagem_id !== null) {
                $sql_delete_imagem = "DELETE FROM imagem WHERE id_imagem = ?";
                $stmt_delete_imagem = $conn->prepare($sql_delete_imagem);
                $stmt_delete_imagem->bind_param("i", $imagem_id);
                $stmt_delete_imagem->execute();
                $stmt_delete_imagem->close();
            }

            echo "<div class='w3-responsive w3-card-4'>";
            echo "<p>&nbsp;Estabelecimento excluído com sucesso! </p>";
            echo "</div>";
        } else {
            echo "Erro ao excluir o estabelecimento: " . $conn->error;
        }

        $stmt->close(); // Fecha o statement
        $conn->close(); // Fecha a conexão com o banco de dados
    } else {
        echo "ID do estabelecimento não foi especificado.";
    }
} else {
    echo "Solicitação inválida.";
}
?>
