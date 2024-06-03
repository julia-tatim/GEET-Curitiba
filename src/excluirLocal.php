<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    include_once('config.php');

    // Verifica se o id do estabelecimento foi enviado
    if (isset($_POST['id_estabelecimento'])) {
        $id_estabelecimento = $_POST['id_estabelecimento'];

        $sql_delete_estabelecimento = "DELETE FROM estabelecimento WHERE id_estabelecimento = ?";
        $stmt = $conn->prepare($sql_delete_estabelecimento);
        $stmt->bind_param("i", $id_estabelecimento);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Obtem o id da imagem vinculada ao estabelecimento
            $sql_select_imagem = "SELECT imagem_id FROM estabelecimento WHERE id_estabelecimento = ?";
            $stmt_select = $conn->prepare($sql_select_imagem);
            $stmt_select->bind_param("i", $id_estabelecimento);
            $stmt_select->execute();
            $stmt_select->bind_result($imagem_id);
            $stmt_select->fetch();
            $stmt_select->close();

            // Se houver uma imagem, exclui a imagem
            if ($imagem_id !== null) {
                $sql_delete_imagem = "DELETE FROM imagem WHERE id_imagem = ?";
                $stmt_delete_imagem = $conn->prepare($sql_delete_imagem);
                $stmt_delete_imagem->bind_param("i", $imagem_id);
                $stmt_delete_imagem->execute();
                $stmt_delete_imagem->close();
            }


            echo '<script>alert("Dados do estabelecimento excluídos com sucesso!");window.location.href = "explorarHTML.php";
            </script>';

        } else {
            echo "Erro ao excluir o estabelecimento: " . $conn->error;
            echo '<script>window.location.href = "explorarHTML.php";</script>';
        }

        $stmt->close(); 
        $conn->close(); 
    } else {
        echo '<script>alert("ID do estabelecimento não foi especificado.");window.location.href = "explorarHTML.php";</script>';
    }
} else {
    echo '<script>alert("Solicitação inválida.");window.location.href = "explorarHTML.php";</script>';
}
?>
