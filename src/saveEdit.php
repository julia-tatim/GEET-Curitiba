<?php 
    include_once('config.php');

    if (isset($_POST['update'])) {
        $email_antigo = $_POST['email_antigo']; // E-mail antigo fornecido pelo formulário
        $email_novo = $_POST['email_novo']; // Novo e-mail fornecido pelo formulário
        $nome = $_POST['nome']; // Nome do usuário fornecido pelo formulário
        $senha = $_POST['senha']; // Senha fornecida pelo formulário
        $data_nascimento = $_POST['data_nascimento']; // Data de nascimento fornecida pelo formulário

        // Verificando se o novo e-mail já existe na tabela
        $sqlCheckEmail = "SELECT COUNT(*) AS count FROM usuario WHERE email='$email_novo'";
        $resultCheckEmail = $conn->query($sqlCheckEmail);
        $row = $resultCheckEmail->fetch_assoc();
        $emailExistente = $row['count'];

        if ($emailExistente > 0) {
            echo "O e-mail fornecido já está em uso. Por favor, escolha outro.";
        } else {
            $crypt = password_hash($senha, PASSWORD_BCRYPT);

            // Consulta SQL para atualizar o e-mail e outras informações do usuário
            $sqlUpdate = "UPDATE usuario SET email='$email_novo', nome='$nome', senha='$crypt', data_nascimento='$data_nascimento' WHERE email='$email_antigo'";

            $result = $conn->query($sqlUpdate); // Executa a consulta SQL

            // Verifica se a consulta foi bem-sucedida e adiciona uma mensagem de usuário editado com sucesso, se necessário
            if ($result) {
                echo "Usuário editado com sucesso!";
            } else {
                echo "Erro ao editar usuário: " . $conn->error;
            }
        }
    }

    // Redireciona para a página 'meusdados.php' após a conclusão do processo
    header("Location: meusdados.php");
    exit();
?>
