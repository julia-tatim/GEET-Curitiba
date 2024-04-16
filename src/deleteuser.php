<?php
  
    $servername = "localhost";
    $username = "root";
    $password = "A992176566kemi_";
    $database = "geet";
    
    $conn = new mysqli($servername, $username, $password, $database);

    $email = $_POST["email"];

    $sql = "DELETE FROM usuario where email = ".$email;

    if(mysql_query($sql,$con)){
        header("Location: index.html");
        exit();
    }else{
        $msg = "Erro ao deletar!";
    }
    mysql_close($con);

    ?>
