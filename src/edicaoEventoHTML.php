<?php
// Iniciar o buffer de saída no início do arquivo
ob_start();
session_start();
include "config.php";

if (!isset($_SESSION['email'])) {
    // Certifique-se de que nenhuma saída foi enviada antes desta chamada ao header
    header("Location: login.html");
    exit();
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
        .color-btn:hover, .color-btn-cofirm:hover {
        background-color: rgb(104, 104, 104);
        color: #fff; 
    }

    .color-btn-cofirm {
        color: white;
        border-color: #F1835E;
        background-color: #F1835E;
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

      .cabin4 {
        font-family: "Cabin", sans-serif;
        display: inline;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
        font-variation-settings:
          "wdth" 100;
          color: #fff;
      }

      .cabin5 {
        font-family: "Cabin", sans-serif;
        display: inline;
        font-variation-settings:
          "wdth" 100;
          color: #fff;
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
            color: #fff; 
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
            $email = $_SESSION['email'];

            $query = "SELECT imagem FROM usuario WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $imagem);

            if (mysqli_stmt_fetch($stmt)) {
                if ($imagem) {
                    // Se houver uma imagem
                    echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="data:image/jpeg;base64,' . base64_encode($imagem) . '" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
                } else {
                    // Se não houver imagem, exibir uma padrão
                    echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
                }
            } else {
                echo '<a class="navbar-brand m-2" href="meusdados.php"><img src="../image/perfil_padrao.jpg" alt="Perfil do usuário" width="50" height="" class="rounded-circle"></a>';
            }

            mysqli_stmt_close($stmt);
        ?>
    </div>
</nav>
<?php
include_once('config.php');
$imagem_src = '';

if (isset($_GET['id'])) {
    $id_evento = $_GET['id'];

    $sql = "SELECT e.*, t.tipoLocal, i.imagem FROM evento e
    INNER JOIN tipo t ON e.id_tipo = t.id_tipo
    LEFT JOIN imagem i ON e.imagem_id = i.id_imagem
    WHERE e.id_evento = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a consulta SQL: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id_evento);

    $result = mysqli_stmt_execute($stmt);

    if ($result === false) {
        die('Erro ao executar a consulta SQL: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $dados = mysqli_fetch_assoc($result);
        $tipoEvento = $dados['tipoLocal'];
        $idadeMinima = $dados['idadeMinima'];
        if (!empty($dados['imagem'])) {
            $imagem_base64 = base64_encode($dados['imagem']);
            $imagem_src = 'data:image;base64,' . $imagem_base64;
        }
    } else {
        echo "Nenhum evento encontrado com o ID fornecido.";
    }

    mysqli_stmt_close($stmt);
}

// Consulta SQL para obter todos os tipos de evento disponíveis
$sqlTipos = "SELECT id_tipo, tipoLocal FROM tipo WHERE local = 'Evento'";
$resultTipos = mysqli_query($conn, $sqlTipos);
if (!$resultTipos) {
    die('Erro na consulta SQL: ' . mysqli_error($conn));
}

$tiposEvento = [];
if (mysqli_num_rows($resultTipos) > 0) {
    while ($rowTipo = mysqli_fetch_assoc($resultTipos)) {
        $tiposEvento[$rowTipo['id_tipo']] = $rowTipo['tipoLocal'];
    }
} else {
    echo "Nenhum tipo de evento encontrado.";
}

mysqli_free_result($resultTipos);
?>
<!-- informações atuais -->
<!-- formulario de edição -->
<div class="container mt-4 p-4" style="border-radius: 30px; background-color: rgb(104, 104, 104);">
    <div class="row justify-content-center">
        <div class="col-lg-8">
        <form action="editarEvento.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">

            <div class="p-1">
                <p class="cabin4">Imagem atual:</p>
                <?php
                if (!empty($imagem_src)) {
                    echo "<img src='$imagem_src' class='cabin5' style='max-width: 100%;' alt='Imagem do evento'>";
                } else {
                    echo "<p>Imagem não disponível</p>";
                }
                ?>
            </div>
            
            <div class="mb-3">
                <label for="imagem" class="form-label cabin2">Nova Imagem do Evento</label></br>                
                <input type="file" name="imagem" id="imagem" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label cabin2">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required minlength="3" value="<?php echo $dados['nome']; ?>">
            </div>
            <div class="mb-3">
                <label for="tipoLocal" class="form-label cabin2">Tipo de Evento</label>
                <select class="form-select" id="tipoLocal" name="tipoEvento" required>
                    <?php foreach ($tiposEvento as $idTipo => $tipoLocal) : ?>
                        <option value="<?php echo $idTipo; ?>" <?php echo ($idTipo == $dados['id_tipo']) ? 'selected' : ''; ?>>
                            <?php echo $tipoLocal; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="descricao" class="form-label cabin2">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required minlength="50" title="Descrição muito curta, mínimo 30 palavras"><?php echo $dados['descricao']; ?></textarea>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="localizacao" class="form-label cabin2">Endereço</label>
                    <input type="text" class="form-control" id="localizacao" name="localizacao" 
                        required pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\s]+,\s*\d+$" 
                        title="Insira um endereço válido, por exemplo: Rua, 123" 
                        value="<?php echo $dados['localizacao']; ?>">
                </div>
                <div class="col">
                    <label for="telefone" class="form-label cabin2">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone"
                        required pattern="^\d{2}\s\d{5}-\d{4}$"  
                        title="Insira um número válido, por exemplo: 41 99999-9999"
                        value="<?php echo $dados['telefone']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="data_inicio" class="form-label cabin2">Data de Início</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo date('Y-m-d', strtotime($dados['data_inicio'])); ?>" required>
                </div>
                <div class="col">
                    <label for="data_fim" class="form-label cabin2">Data de Enceramento</label>
                    <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo date('Y-m-d', strtotime($dados['data_fim'])); ?>" required>
                </div>
            </div>


            <div class="mb-3">
                <label for="idadeMinima" class="form-label cabin2">Classificação Indicativa</label>
                <select class="form-select" id="idadeMinima" name="idadeMinima" required>
                    <option value="Livre para todos os públicos" <?php echo ($idadeMinima === 'Livre') ? 'selected' : ''; ?>>Livre para todos os públicos</option>
                    <option value="10" <?php echo ($idadeMinima === '10') ? 'selected' : ''; ?>>+10</option>
                    <option value="12" <?php echo ($idadeMinima === '12') ? 'selected' : ''; ?>>+12</option>
                    <option value="14" <?php echo ($idadeMinima === '14') ? 'selected' : ''; ?>>+14</option>
                    <option value="16" <?php echo ($idadeMinima === '16') ? 'selected' : ''; ?>>+16</option>
                    <option value="18" <?php echo ($idadeMinima === '18') ? 'selected' : ''; ?>>+18</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="redeSocial" class="form-label cabin2">Rede Social</label>
                <input type="url" class="form-control" id="redeSocial" name="redeSocial" value="<?php echo $dados['rede_social']; ?>" pattern="^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$">
            </div>

            <div class="mb-3">
                <label for="site" class="form-label cabin2">Site Oficial</label>
                <input type="url" class="form-control" id="site" name="site" value="<?php echo $dados['site']; ?>" pattern="^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$">
            </div>

            <!-- Botões de editar e excluir -->
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-light cabin2 color-btn cabin3" data-bs-toggle="modal" data-bs-target="#ConfirmarExclusao">Excluir</button>

                <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin3" id="update" name="update">Finalizar</button>                
            </div>
            
        </form>

        </div>
    </div>
</div>
<!-- formulario de edição -->
<!-- confirmar exclusão -->
<div class="modal fade" id="ConfirmarExclusao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="modal-title">Deseja mesmo excluir este local?</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<p>Você está prestes a excluir este local permanentemente. Tem certeza que deseja prosseguir?</p>
<p>Clique em 'Confirmar' para excluir ou 'Cancelar' para manter.</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
<form action="excluirLocal.php" method="POST">
                    <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">
                    <button type="submit" class="btn btn-danger" name="delete">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- confirmar exclusão -->
<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-xxxxxxxxxxxx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-xxxxxxxxxxxx" crossorigin="anonymous"></script>
</body>
</html>