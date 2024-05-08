<?php
session_start();
include_once('config.php');

//UPDATE
if (isset($_POST['update'])) {

        $email_antigo = $_SESSION['email']; 
        $email_novo = $_POST['email']; 
        $nome = $_POST['nome']; 
        $senha = $_POST['senha']; 
        $confirmaSenha = $_POST['confirmaSenha']; 
        $data_nascimento = $_POST['data_nascimento']; 
        
        $sqlUpdate = "UPDATE usuario SET nome='$nome', data_nascimento='$data_nascimento' WHERE email='$email_antigo'";
        $resultUpdate = $conn->query($sqlUpdate);
        
        $crypt = password_hash($senha, PASSWORD_BCRYPT);
        $cryptConfirma = password_hash($confirmaSenha, PASSWORD_BCRYPT);

        
        if ($senha != $confirmaSenha) {
            echo '<script>alert("As senhas não conferem.");window.location.href = "meusdados.php;</script>';
            exit();
        } else {
 
            $sqlSenha = "UPDATE usuario SET senha='$crypt', confirmaSenha='$cryptConfirma' WHERE email='$email_antigo'";
            $resultSenha = $conn->query($sqlSenha);
        }
        
        if ($email_antigo!== $email_novo) {

            $sqlCheckEmail = "SELECT COUNT(*) AS count FROM usuario WHERE email='$email_novo'";
            $resultCheckEmail = $conn->query($sqlCheckEmail);
            $row = $resultCheckEmail->fetch_assoc();
            $emailExistente = $row['count'];
            
            if ($emailExistente > 0) {
                echo '<script>alert("Este email já está sendo utilizado.");</script>';
            } else {

                $sqlEmail = "UPDATE usuario SET email='$email_novo' WHERE email='$email_antigo'";

                $resultEmail = $conn->query($sqlEmail); 

                if ($resultEmail) {
                    $_SESSION['email'] = $email_novo;
                    echo 'As senhas não conferem';
                } else {
                    echo "Erro ao editar usuário: " . $conn->error;
                }
                header("Location: meusdados.php");
                exit();
            }
        }
        header("Location: meusdados.php");
        exit();

//DELETE
} elseif (isset($_POST['delete'])) {

    if (!empty($_POST['email'])) {
        
        $email = $_POST['email'];

        $sql = "DELETE FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo '<script>alert("Usuário deletado com sucesso.");</script>'; 
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