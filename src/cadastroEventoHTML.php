<?php
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEET Curitiba</title>
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
            border-color: #F1835E;
            background-color: #F1835E;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .color-btn:hover {
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
          color: #fff;
      }

      .cabin3 {
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
    h2, strong{
        color: #F1835E;
    }
    strong{
        color: #1E659B;
    }

    .btnn:hover {
            color: #fff; /* Ou a cor desejada ao passar o mouse */
        }

    .rounded-circle {
        width: 50px;
        height: auto; 
        aspect-ratio: 1 / 1; 
        object-fit: cover;
        border-radius: 50%;
    }
    </style>
    
</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../image\logo.svg" alt="Bootstrap" width="100" height=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <ul class="navbar-nav d-flex justify-content-around w-100">
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="explorarHTML.php">Explorar</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="explorarEventosHTML.php">Eventos</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="index.php#contato">Contato</a>
                  </li>
              </ul>
          </div>
          <form class="d-flex">
                <input class="form-control me-2 cabin2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-dark cabin2" type="submit">Buscar</button>
            </form>
            <!-- Imagem do usuario -->
            <?php
                include "config.php";

                if (!isset($_SESSION['email'])) {
                    header("Location: login.html");
                    exit();
                }

                $email = $_SESSION['email'];

                $query = "SELECT imagem FROM usuario WHERE email = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 's', $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $imagem);

                if (mysqli_stmt_fetch($stmt)) {
                    if ($imagem) {
                        // Se houver uma imagem
                        echo '<a class="navbar-brand m-2" href="paginaADM.php"><img src="data:image/jpeg;base64,' . base64_encode($imagem) . '" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
                    } else {
                        // Se não houver imagem, exibir uma padrão
                        echo '<a class="navbar-brand m-2" href="paginaADM.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
}
} else {
echo '<a class="navbar-brand m-2" href="paginaADM.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
}
mysqli_stmt_close($stmt);
?>
</div>
</nav>
<!-- cabeçalho -->
<!-- main -->
<div class="container mt-4 p-4" style="border-radius: 30px; background-color: rgb(104, 104, 104);">
<div class="row justify-content-center">
<div class="col-lg-8">
    <form action="cadastroEvento.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">

            <label for="nomeEvento" class="form-label cabin2">Nome</label>
            <input type="text" class="form-control" id="nomeEvento" name="nomeEvento" required minlength="3" required pattern="^[a-zA-Z\s]+" title="Nome inválido">

        </div>
        <div class="mb-3">
            <label for="tipoEvento" class="form-label cabin2">Tipo de Evento</label>
            <select class="form-select" id="tipoEvento" name="tipoEvento" required>
                <option value="conferencia cabin">Conferências</option>
                <option value="festival cabin">Festivais</option>
                <option value="seminario cabin">Seminários</option>
                <option value="feira cabin">Feiras</option>
                <option value="workshop cabin">Workshops</option>
                <option value="concerto cabin">Concertos</option>
                <option value="exposicao cabin">Exposições</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="descricaoEvento" class="form-label cabin2">Descrição</label>
            <textarea class="form-control" id="descricaoEvento" name="descricaoEvento" rows="3" required minlength="30" title="Descrição muito curta, mínimo 30 palavras"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
            <label for="localizacao" class="form-label cabin2">Localização</label>
            <input type="text" class="form-control" id="localizacao" name="localizacao" required 
                pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\s]+,\s*\d+$" 
                title="Insira um endereço válido, por exemplo: Rua, 123">
            </div>
            <div class="col">
            <label for="telefone" class="form-label cabin2">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" required 
                pattern="^\d{2}\s\d{5}-\d{4}$" 
                title="Insira um número válido, por exemplo: 41 99999-9999">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="data_inicio" class="form-label cabin2">Data de Início</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
            </div>
            <div class="col">
                <label for="data_fim" class="form-label cabin2">Data de Fim</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="idadeMinima" class="form-label cabin2">Classificação Indicativa</label>
            <select class="form-select" id="idadeMinima" name="idadeMinima" required>
                <option value="livre">Livre para todos os públicos</option>
                <option value="10">+10</option>
                <option value="12">+12</option>
                <option value="14">+14</option>
                <option value="16">+16</option>
                <option value="18">+18</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="redeSocial" class="form-label cabin2">Rede Social</label>
            <input type="text" class="form-control" id="redeSocial" name="redeSocial"  title="Insira um link valido" required>
        </div>
        <div class="mb-3">
            <label for="site" class="form-label cabin2">Site Oficial</label>
            <input type="text" class="form-control" id="site" name="site"  title="Insira um link valido" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label cabin2">Imagem do Evento</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin3">Criar</button>
    </form>
</div>
</div>
</div>
<!-- main -->
<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-xxxxxxxxxxxx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-xxxxxxxxxxxx" crossorigin="anonymous"></script>
</body>
</html>
