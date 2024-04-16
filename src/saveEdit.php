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

        $result = $conn->query($sqlUpdate);
        
    }
    header("Location:meusdados.php");
?>