<?php
include_once('config.php');

if (isset($_POST['delete'])) {

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        $sql = "DELETE FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $msg = "Deletado com sucesso!";//enviar mensagem
        } else {
            $msg = "Erro ao deletar: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $msg = "Email não fornecido.";
    }
} else {
    $msg = "Ação de exclusão não acionada.";
}

header("Location:login.html");
exit();
?>

