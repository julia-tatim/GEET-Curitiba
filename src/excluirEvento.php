<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    include_once('config.php');

    // Verifica se o id do evento foi enviado
    if (isset($_POST['id_evento'])) {
        $id_evento = $_POST['id_evento'];

        $sql_delete_evento = "DELETE FROM evento WHERE id_evento = ?";
        $stmt = $conn->prepare($sql_delete_evento);
        $stmt->bind_param("i", $id_evento);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Obtem o id da imagem vinculada ao evento
            $sql_select_imagem = "SELECT imagem_id FROM evento WHERE id_evento = ?";
            $stmt_select = $conn->prepare($sql_select_imagem);
            $stmt_select->bind_param("i", $id_evento);
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


            echo '<script>alert("Dados do evento excluídos com sucesso!");window.location.href = "explorarEventosHTML.php";
            </script>';

        } else {
            echo "Erro ao excluir o evento: " . $conn->error;
            echo '<script>window.location.href = "explorarEventosHTML.php";</script>';
        }

        $stmt->close(); 
        $conn->close(); 
    } else {
        echo '<script>alert("ID do evento não foi especificado.");window.location.href = "explorarEventosHTML.php";</script>';
    }
} else {
    echo '<script>alert("Solicitação inválida.");window.location.href = "explorarEventosHTML.php";</script>';
}
?>
