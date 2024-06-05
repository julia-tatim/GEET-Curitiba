<?php
session_start();
include 'config.php';  // Inclua seu script de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estabelecimento_id = $_POST['estabelecimento_id'];
    $usuario_email = $_SESSION['email'];

    // Verifica se o favorito já existe
    $sql_check = "SELECT * FROM favorito_estabelecimento WHERE fk_usuario_email = ? AND fk_estabelecimento_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('si', $usuario_email, $estabelecimento_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Favorito já existe, então remover
        $sql_remove = "DELETE FROM favorito_estabelecimento WHERE fk_usuario_email = ? AND fk_estabelecimento_id = ?";
        $stmt_remove = $conn->prepare($sql_remove);
        $stmt_remove->bind_param('si', $usuario_email, $estabelecimento_id);

        if ($stmt_remove->execute()) {
            echo json_encode(['status' => 'removed']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }

        $stmt_remove->close();
    } else {
        // Favorito não existe, então adicionar
        $sql_add = "INSERT INTO favorito_estabelecimento (fk_usuario_email, fk_estabelecimento_id) VALUES (?, ?)";
        $stmt_add = $conn->prepare($sql_add);
        $stmt_add->bind_param('si', $usuario_email, $estabelecimento_id);

        if ($stmt_add->execute()) {
            echo json_encode(['status' => 'added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }

        $stmt_add->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>
