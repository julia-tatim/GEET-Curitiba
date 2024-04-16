<?php

include_once('config.php');

if (isset($_POST['update'])) {
    $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data_nascimento = $_POST['data_nascimento'];

        $crypt = password_hash($senha, PASSWORD_BCRYPT);
        echo($crypt);       

        $sqlUpdate = "UPDATE usuario SET nome='$nome',senha='$crypt',data_nascimento='$data_nascimento' WHERE email='$email'";

        $result = $conn->query($sqlUpdate);//adicionar mensagem de usuário editado com sucesso

        header("Location:meusdados.php");
        exit();
        
} elseif (isset($_POST['delete'])) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        $sql = "DELETE FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $msg = "Deletado com sucesso!";//enviar mensagem
            header("Location:login.html");
            exit();
        } else {
            $msg = "Erro ao deletar: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $msg = "Email não fornecido.";
    }
}

?>