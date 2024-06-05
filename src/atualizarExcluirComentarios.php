<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comentario_id'])) {
        // Se o ID do comentário estiver definido, verifica se é uma exclusão ou uma edição
        $comentario_id = $_POST['comentario_id'];

        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            // Exclui o comentário
            $sql = "DELETE FROM comentario_estabelecimento WHERE id_comentario = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('i', $comentario_id);
                if ($stmt->execute()) {
                    // Redireciona de volta para a página anterior após a exclusão
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    exit();
                } else {
                    echo 'Erro ao excluir o comentário: ' . $stmt->error;
                    exit();
                }
            } else {
                echo 'Erro ao preparar a consulta SQL: ' . $conn->error;
                exit();
            }
        } 
    } else {
        echo 'ID do comentário não fornecido.';
        exit();
    }
} else {
    echo 'Método de requisição inválido.';
    exit();
}
?>