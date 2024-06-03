<?php
include_once('config.php');

session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.html');
    }

$where = "";

// Verifica se há categorias selecionadas via GET
if (isset($_GET['categorias']) && !empty($_GET['categorias'])) {
    $categorias = $_GET['categorias'];
    // Prepara a cláusula WHERE com base nas categorias selecionadas
    $where = " WHERE ";
    $where .= "e.id_tipo IN (SELECT id_tipo FROM tipo WHERE tipoLocal IN ('" . implode("','", $categorias) . "'))";
}
// Monta a consulta SQL
$sql = "SELECT e.id_estabelecimento, e.nome, e.descricao, i.imagem 
        FROM estabelecimento e
        LEFT JOIN imagem i ON e.imagem_id = i.id_imagem";
$sql .= $where;

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Erro na consulta SQL: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
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
 .tamanho-imagem-card {
      width: 210px;
      height: 210px;
      border-radius: 10px;
}

</style>


</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="..\image\logo.svg" alt="Bootstrap" width="100" height=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <ul class="navbar-nav d-flex justify-content-around w-100">
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="explorarHTML.php">Explorar</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark cabin2" aria-current="page" href="#">Eventos</a>
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
                        echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="data:image/jpeg;base64,' . base64_encode($imagem) . '" alt="Perfil do usuário" width="50" height=""></a>';
                    } else {
                        // Se não houver imagem, exibir uma padrão
                        echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height=""></a>';
                    }
                } else {
                    echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height=""></a>';
                }

                mysqli_stmt_close($stmt);
            ?>
        </div>
    </nav>
    <!-- cabeçalho -->
    <div class="container mt-4">
        <div class="row">
            <!-- Botão de colapso para os filtros -->
            <div class="col-lg-3 mb-4">
                <button class="btn btn-outline-light cabin2 color-btn2 color-btn w-100 mb-2 cabin2" type="button" data-bs-toggle="collapse" data-bs-target="#filtroCollapse" aria-expanded="false" aria-controls="filtroCollapse">
                    Filtros
                </button>
                <!-- Filtros -->
                <div class="filtro-container curvaborda-superior collapse" id="filtroCollapse">
                    <h5 class="filtro-titulo cabin2">Locais:</h5>
                    <form method="GET" action="">
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Restaurantes" id="filtro1">
                            <label class="form-check-label cabin2" for="filtro1">Restaurantes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Restaurantes Veganos" id="filtro2">
                            <label class="form-check-label cabin2" for="filtro2">Restaurantes Veganos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Restaurantes com Opções Veganas" id="filtro3">
                            <label class="form-check-label cabin2" for="filtro3">Restaurantes com Opções Veganas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Cafés" id="filtro4">
                            <label class="form-check-label cabin2" for="filtro4">Cafés</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Cafés com Opções Veganas" id="filtro5">
                            <label class="form-check-label cabin2" for="filtro5">Cafés com Opções Veganas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Entretenimento" id="filtro6">
                            <label class="form-check-label cabin2" for="filtro6">Entretenimento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filtro" type="checkbox" name="categorias[]" value="Pontos Turísticos" id="filtro7">
                            <label class="form-check-label cabin2" for="filtro7">Pontos Turísticos</label>
                        </div>
                        <!-- Adicionar mais checkboxes se for necessário -->

                        </br><button type="submit" class='btn btn-outline-light cabin2 color-btn cabin2'>Aplicar Filtros</button>
                    </form>
                </div>
            </div>
          
            <!-- Cards de lugares -->
            <div class="col-lg-9">
                <h1 class="mb-4 cabin2">Explore nossos destinos turísticos</h1>
                <div class="row">
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_estabelecimento = $row['id_estabelecimento'];
                            $nome = $row['nome'];
                            $descricao = $row['descricao'];
                            $imagem_src = isset($row['imagem']) && !empty($row['imagem']) ? 'data:image;base64,' . base64_encode($row['imagem']) : '';
                            $categorias = ''; 

                            echo "<div class='col-md-4 p-3 estabelecimento-card' data-categorias='$categorias'>";
                            echo "<div class='card'>";
                            echo "<div class='text-center'>";
                            echo "<img src='$imagem_src' class='card-img-top m-2 mt-4 tamanho-imagem-card' alt='Imagem do estabelecimento'>";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title cabin2'>$nome</h5>";
                            echo "<a href='LocalHTML.php?id=$id_estabelecimento' class='btn btn-outline-light cabin2 color-btn cabin2'>Saiba mais</a>"; 
                            echo "<a href='edicaoLocalHTML.php?id=$id_estabelecimento' class='btn btn-outline-light cabin2 color-btn cabin2'>ADM</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Nenhum estabelecimento encontrado.</p>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
          
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
