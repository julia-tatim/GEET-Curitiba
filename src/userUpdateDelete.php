<?php
session_start();
include_once('config.php');

if (isset($_POST['update'])) {

    //se trocar nome -> troca nome
    //se trocar data nascimento -> troca data nascimento
    //se trocar senha -> troca senha e deve trocar a confirmação de senha 
    //confirmação de senha tem que ser igual a senha
    //se troca email -> troca email que não existe e os outros dados continueam iguais

        $email_antigo = $_SESSION['email']; 
        $email_novo = $_POST['email']; 
        $nome = $_POST['nome']; 
        $senha = $_POST['senha']; 
        $confirmaSenha = $_POST['confirmaSenha']; 
        $data_nascimento = $_POST['data_nascimento']; 

        //--update nome e data
        
        $sqlUpdate = "UPDATE usuario SET nome='$nome', data_nascimento='$data_nascimento' WHERE email='$email_antigo'";
        $resultUpdate = $conn->query($sqlUpdate);
        
        $crypt = password_hash($senha, PASSWORD_BCRYPT);
        $cryptConfirma = password_hash($confirmaSenha, PASSWORD_BCRYPT);

        if ($senha != $confirmaSenha) {
            echo "presta mais atenção filho da puta (ou akemi que é trouxa e errou no código)";
        }else{
            $sqlSenha = "UPDATE usuario SET senha='$crypt', confirmaSenha='$cryptConfirma' WHERE email='$email_antigo'";
            $resultSenha = $conn->query($sqlSenha);
        }
        
        if ($email_antigo!== $email_novo) {

            $sqlCheckEmail = "SELECT COUNT(*) AS count FROM usuario WHERE email='$email_novo'";
            $resultCheckEmail = $conn->query($sqlCheckEmail);
            $row = $resultCheckEmail->fetch_assoc();
            $emailExistente = $row['count'];

            if ($emailExistente > 0) {
                echo "O e-mail fornecido já está em uso. Por favor, escolha outro.";//mandar mensagem de email já existente
            } else {

                $sqlEmail = "UPDATE usuario SET email='$email_novo' WHERE email='$email_antigo'";

                $resultEmail = $conn->query($sqlEmail); 

                if ($resultEmail) {

                    $_SESSION['email'] = $email_novo;
                    echo "Usuário editado com sucesso!";
                } else {
                    echo "Erro ao editar usuário: " . $conn->error;
                }
                header("Location: meusdados.php");
                exit();
            }
        }
        header("Location: meusdados.php");
        exit();

} elseif (isset($_POST['delete'])) {

    if (!empty($_POST['email'])) {
        
        $email = $_POST['email'];

        $sql = "DELETE FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $msg = "Deletado com sucesso!";//enviar mensagem
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
         
        } else {
            $msg = "Erro ao deletar: " . $conn->error;
        }
        
        $stmt->close();
        $conn->close();
        header("Location:login.html");
        exit();

    } else {
        $msg = "Email não fornecido.";
    }
} elseif (isset($_POST['logout'])) {

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.html');
    exit();
}

?>