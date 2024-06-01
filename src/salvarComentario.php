<?php
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estabelecimento_id = $_POST['estabelecimento_id'];
    $comentario = $_POST['comentario'];
    $usuario_email = $_SESSION['email']; 

    // Insert comment into the database
    $sql = "INSERT INTO comentario_estabelecimento (texto, usuario_email, estabelecimento_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $comentario, $usuario_email, $estabelecimento_id);

    if ($stmt->execute()) {
        header("Location: estabelecimento.php?id=$estabelecimento_id");
        exit();
    } else {
        echo 'Erro ao executar a consulta SQL: ' . $stmt->error;
        echo 'Estabelecimento ID: ' . $estabelecimento_id;
        echo 'Comentário: ' . $comentario;
        echo 'Email do Usuário: ' . $usuario_email;
    }
    
}
?>
