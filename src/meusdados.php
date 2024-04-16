<?php

include_once('config.php');

session_start();

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.html');
}

    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];

    $sql = "SELECT nome, data_nascimento, confirmaSenha FROM usuario WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $dataNascimento = $row['data_nascimento'];
        $confirmaSenha = $row["confirmaSenha"];
    } else {
        // Handle if no user found
        $nome = "Nome não encontrado";
        $dataNascimento = "Data de Nascimento não encontrada";
        $confirmaSenha = "Confirmação de senha não encontrada";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEET Curitiba</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('../image/fundo1.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .navbar {
            border: 2px solid rgb(191 219 254);
        }
        .color-btn {
            color: white;
            border-color: #1E659B;
            background-color: #1E659B;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .color-btn:hover {
        background-color: rgb(104, 104, 104);
        color: #fff; 
        }


        .color-btn3 {
            color: white;
            border-color: #F1835E;
            background-color: #F1835E;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .color-bt3n:hover {
        background-color: rgb(104, 104, 104);
        color: #fff; 
        }

        .color-btn2:hover {
        background-color: #F1835E;
        color: #fff
        }

        .cabin {
        font-family: "Cabin", sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
        font-variation-settings:
          "wdth" 100;
        }
        .cabin2 {
        font-family: "Cabin", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
        font-variation-settings:
          "wdth" 100;
      }
      
    .button-color{
        background-color: #1E659B;
        color: #fff;
    }

    .curvaborda{
        border-radius: 30px;
    }

    .filtro-container {
      background-color: rgb(165, 165, 165);
      color: #fff;
      
      padding: 20px; 
    }

    .filtro-titulo {
      margin-bottom: 20px;
    }

    .card-img-top {
        max-width: 70%; 
        height: auto; 
    }

    .form-check-input:checked {
    background-color: #F1835E; 
    }
    .form-check-input:focus {
    outline: none;
    box-shadow: none;
    border-color: #F1835E;
}

    .corfundo{
        background-color: #ecf0f1;;
    }

    </style>
</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="..\image\logo.svg" alt="Bootstrap" width="100" height=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <ul class="navbar-nav d-flex justify-content-around w-100">
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="explorar.html">Explorar</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="#">Eventos</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="index.html#contato">Contato</a>
                  </li>
              </ul>
          </div>
            <form class="d-flex">
                <input class="form-control me-2 cabin2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-dark cabin2" type="submit">Buscar</button>
            </form>
            <a class="navbar-brand m-2" href="login.html"><img src="..\image\perfil.svg" alt="Bootstrap" width="50" height=""></a>
        </div>
    </nav>
    <!-- cabeçalho -->

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5 bg-light p-5" style="border-radius: 20px;">
                <!-- Seu conteúdo aqui -->
                <form method="POST" action="userUpdateDelete.php">
                    <div class="form-group">
                        <label for="inputNome" class="cabin2">Nome</label>
                        <input type="text" class="form-control cabin2 corfundo" name="nome" id="inputNome" value="<?php echo $nome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputSenha4" class="cabin2">Senha</label>
                        <input type="password" class="form-control cabin2 corfundo" name="senha" id="inputSenha4" value="<?php echo $senha; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputSenha4" class="cabin2">Confirme sua senha</label>
                        <input type="password" class="form-control cabin2 corfundo" name="confirmaSenha" id="confirmaSenha" value="<?php echo $confirmaSenha; ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="cabin2">Email</label>
                            <input type="email" class="form-control cabin2 corfundo" name="email" id="inputEmail4" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNascimento" class="cabin2">Data de Nascimento 2</label>
                            <input type="date" class="form-control cabin2 corfundo" name="data_nascimento" id="inputNascimento" value="<?php echo $dataNascimento; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin2 mr-2 " name="update" id="update">Editar</button>
                    <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin2 color-btn3 mr-2" name="delete" id="delete">Deletar</button>
                    <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin2 " name="logout" id="logout">Deslogar</button>
                </form>
            </div>
        </div>
    </div>


          
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>

