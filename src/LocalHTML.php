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


    </style>
</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="../image\logo.svg" alt="Bootstrap" width="100" height=""></a>
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center">
                <?php
                    include_once('config.php');

                    // Verificar se o parâmetro 'id' foi passado na URL
                    if (isset($_GET['id'])) {
                        $id_estabelecimento = $_GET['id'];

                        // Consulta para obter os detalhes do estabelecimento pelo ID
                        $sql = "SELECT e.*, i.imagem, t.tipoLocal AS tipo_nome
                                FROM estabelecimento e
                                LEFT JOIN imagem i ON e.imagem_id = i.id_imagem
                                LEFT JOIN tipo t ON e.id_tipo = t.id_tipo
                                WHERE e.id_estabelecimento = $id_estabelecimento";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Exibir os detalhes do estabelecimento
                            $dados_estabelecimento = $result->fetch_assoc();

                            // Verificar se a imagem está disponível
                            $imagem_src = isset($dados_estabelecimento['imagem']) && !empty($dados_estabelecimento['imagem']) ? 'data:image;base64,' . base64_encode($dados_estabelecimento['imagem']) : '';

                            // Exibir a imagem se estiver disponível, senão exibir uma mensagem
                            if (!empty($imagem_src)) {
                                echo '<img src="' . $imagem_src . '" class="img-fluid" alt="Imagem do Local">';
                            } else {
                                echo '<p>Imagem não disponível</p>';
                            }
                        } else {
                            echo "Nenhum estabelecimento encontrado com o ID fornecido.";
                        }
                    } else {
                        echo "ID do estabelecimento não especificado.";
                    }
                ?>
                    <!-- Informações -->
                    <div class="conteiner col-md-12">
                        <h2 class="cabin2"><?php echo $dados_estabelecimento['nome']; ?></h2>
                        <p class="cabin2"><strong>Tipo do Local: </strong><?php echo $dados_estabelecimento['tipo_nome']; ?></p>
                        <p class="cabin2"><strong>Endereço: </strong><?php echo $dados_estabelecimento['localizacao']; ?></p>
                        <p class="cabin2"><strong>Descrição: </strong><?php echo $dados_estabelecimento['descricao']; ?></p>
                        <p class="cabin2"><strong>Horário de Funcionamento: </strong><?php echo $dados_estabelecimento['horario_abertura']; ?> - <?php echo $dados_estabelecimento['horario_fechamento']; ?>.</p>
                        <p class="cabin2"><strong>Restrição de Idade: </strong><?php echo $dados_estabelecimento['idadeMinima']; ?></p>
                        <p class="cabin2"><strong>Telefone: </strong><?php echo $dados_estabelecimento['telefone']; ?></p>
                        <p class="cabin2"><strong>Rede Social: </strong><a href="#"><?php echo $dados_estabelecimento['rede_social']; ?></a></p>
                        <p class="cabin2"><strong>Site: </strong><a href="<?php echo $dados_estabelecimento['site']; ?>"><?php echo $dados_estabelecimento['site']; ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
           
            
        </div>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
