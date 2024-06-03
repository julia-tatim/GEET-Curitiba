<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['email']) && isset($_POST['estabelecimento_id']) && isset($_POST['comentario'])) {
        $estabelecimento_id = $_POST['estabelecimento_id'];
        $comentario = $_POST['comentario'];
        $usuario_email = $_SESSION['email'];

        // Insert comment into the database
        $sql = "INSERT INTO comentario_estabelecimento (texto, usuario_email, estabelecimento_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssi', $comentario, $usuario_email, $estabelecimento_id);
            if ($stmt->execute()) {
                header("Location: LocalHTML.php?id=$estabelecimento_id");
                exit();
            } else {
                echo 'Erro ao executar a consulta SQL: ' . $stmt->error;
            }
        } else {
            echo 'Erro ao preparar a consulta SQL: ' . $conn->error;
        }
    } else {
        echo 'Dados incompletos ou sessão não iniciada.';
    }
} else {
    echo 'Método de requisição inválido.';
}
?>
