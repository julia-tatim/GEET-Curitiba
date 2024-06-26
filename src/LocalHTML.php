<?php
session_start();
include_once('config.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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
    .rounded-circle {
    width: 50px;
    height: auto; 
    aspect-ratio: 1 / 1; 
    object-fit: cover;
    border-radius: 50%;
    }

    .fundoImagInf{
        background-color: rgb(300, 300, 300, 0.4);
        padding: 30px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 15px;
    }

    .save-icon {
      font-size: 30px;
      color: black;
      transition: color 0.3s ease;
      cursor: pointer;
    }
   
    .save-icon:hover {
      color: #F1835E;
    }
    .ajutarH2eI {
      display: flex;
      align-items: center;
      width: 80%;
    }
    .espacoDireita{
        justify-content: space-between;
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
    <!-- cabeçalho -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 color8">
                <div class="d-flex flex-column align-items-center fundoImagInf">
                <?php
                    include_once('config.php');

                    // Verificar se o 'id' foi passado na URL
                    if (isset($_GET['id'])) {
                        $id_estabelecimento = $_GET['id'];

                        // Consulta para obter dados do estabelecimento
                        $sql = "SELECT e.*, i.imagem, t.tipoLocal AS tipo_nome
                                FROM estabelecimento e
                                LEFT JOIN imagem i ON e.imagem_id = i.id_imagem
                                LEFT JOIN tipo t ON e.id_tipo = t.id_tipo
                                WHERE e.id_estabelecimento = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $id_estabelecimento);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Exibir os detalhes do estabelecimento
                            $dados_estabelecimento = $result->fetch_assoc();

                            // Verificar se a imagem está disponível
                            $imagem_src = isset($dados_estabelecimento['imagem']) && !empty($dados_estabelecimento['imagem']) ? 'data:image;base64,' . base64_encode($dados_estabelecimento['imagem']) : '';

                            // Exibir a imagem se estiver disponível
                            if (!empty($imagem_src)) {
                                echo '<img src="' . $imagem_src . '" class="img-fluid" alt="Imagem do Local" style="margin-top: 12px;">';
                            } else {
                                // exibir uma padrao??? !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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
                    <div class="conteiner col-md-12 espacoDireita">
                        <div class="ajutarH2eI d-flex align-items-center justify-content-between w-100">
                            <h2 class="cabin2"><?php echo htmlspecialchars($dados_estabelecimento['nome']); ?></h2>
                            <i class="far fa-bookmark save-icon" 
                                data-estabelecimento-id="<?php echo $dados_estabelecimento['id_estabelecimento']; ?>" 
                                data-usuario-email="<?php echo $usuario_email; ?>" 
                                onclick="addRemoveFav(this)"></i>
                        </div>
                        <p class="cabin2"><strong>Tipo do Local: </strong><?php echo htmlspecialchars($dados_estabelecimento['tipo_nome']); ?></p>
                        <p class="cabin2"><strong>Endereço: </strong><?php echo htmlspecialchars($dados_estabelecimento['localizacao']); ?></p>
                        <p class="cabin2"><strong>Descrição: </strong><?php echo htmlspecialchars($dados_estabelecimento['descricao']); ?></p>
                        <p class="cabin2"><strong>Horário de Funcionamento: </strong>
                            <?php echo date('H:i', strtotime($dados_estabelecimento['horario_abertura'])); ?> -
                            <?php echo date('H:i', strtotime($dados_estabelecimento['horario_fechamento'])); ?>
                        </p>

                        <p class="cabin2"><strong>Restrição de Idade: </strong><?php echo htmlspecialchars($dados_estabelecimento['idadeMinima']); ?></p>
                        <p class="cabin2"><strong>Telefone: </strong><?php echo htmlspecialchars($dados_estabelecimento['telefone']); ?></p>
                        <p class="cabin2"><strong>Rede Social: </strong><a href="#"><?php echo htmlspecialchars($dados_estabelecimento['rede_social']); ?></a></p>
                        <p class="cabin2"><strong>Site: </strong><a href="<?php echo htmlspecialchars($dados_estabelecimento['site']); ?>"><?php echo htmlspecialchars($dados_estabelecimento['site']); ?></a></p>
                    </div>
                </div>
            </div>

            <div class="conteiner col-md-6 color8">
                <h2 class="cabin2" style="margin-top: 12px;">Comentários</h2>
                <form action="salvarComentario.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="estabelecimento_id" value="<?php echo $id_estabelecimento; ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                    <div class="mb-3">
                        <label for="stars" class="form-label cabin2">Avaliação (1 a 5 estrelas):</label>
                        <input type="number" class="form-control" id="stars" name="estrelas" min="1" max="5">
                    </div>
                    <div class="mb-3">
                        <label for="textarea" class="form-label cabin2">Deixe seu comentário:</label>
                        <textarea class="form-control cabin2" id="textarea" rows="3" name="comentario"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary cabin2">Salvar Comentário</button>
                </form>

                <!-- comentarios -->
                <div class="mt-4">
                    <?php
                    $sql_comments = "SELECT c.id_comentario, c.texto, c.estrelas, u.nome, c.horario, c.usuario_email
                        FROM comentario_estabelecimento c
                        JOIN usuario u ON c.usuario_email = u.email
                        WHERE c.estabelecimento_id = ?
                        ORDER BY c.horario DESC";
                    $stmt_comments = $conn->prepare($sql_comments);
                    $stmt_comments->bind_param('i', $id_estabelecimento);
                    $stmt_comments->execute();
                    $result_comments = $stmt_comments->get_result();

                    if ($result_comments->num_rows > 0) {
                        while ($comentario = $result_comments->fetch_assoc()) {
                            echo '<div class="card mt-2">';
                            echo '<div class="card-body d-flex justify-content-between align-items-center">';

                            echo '<div>';
                            echo '<h5 class="card-title">' . htmlspecialchars($comentario['nome']) . '</h5>';
                            if (isset($comentario['estrelas'])) {
                                for ($i = 0; $i < $comentario['estrelas']; $i++) {
                                    echo '⭐';
                                }
                                echo '</p>';
                            } else {
                                echo 'Sem avaliação de estrelas</p>';
                            }
                            echo '<p class="card-text">' . htmlspecialchars($comentario['texto']) . '</p>';
                            $data_formatada = date('d/m/Y', strtotime($comentario['horario']));
                            $hora_formatada = date('H:i', strtotime($comentario['horario']));
                            echo '<p class="text-muted">' . $data_formatada . ' - ' . $hora_formatada . '</p>';
                            echo '</div>';
                
                            if (isset($_SESSION['email']) && $_SESSION['email'] === $comentario['usuario_email']) {
                                echo '<div class="d-flex">';
                                echo '<div>'; // Abertura de uma nova div
                                echo '<form action="atualizarExcluirComentarios.php" method="POST">';
                                echo '<input type="hidden" name="comentario_id" value="' . $comentario['id_comentario'] . '">';
                                echo '<input type="hidden" name="action" value="delete">';
                                echo '<button type="submit" class="btn btn-danger me-2">Excluir</button>';
                                echo '</form>';
                                echo '</div>'; // Fechamento da div
                                echo '</div>'; // Fechamento da div .d-flex
                            }
                            echo '</div>'; // Fechamento da div .card-body
                            echo '</div>'; // Fechamento da div .card
                        }
                    } else {
                        echo '<p>Sem comentários ainda.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    <!-- Bootstrap JavaScript -->
<script>
function addRemoveFav(element) {
    const estabelecimentoId = element.getAttribute('data-estabelecimento-id');
    const usuarioEmail = element.getAttribute('data-usuario-email');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'addRemoveFav.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'added') {
                element.classList.remove('far');
                element.classList.add('fas');
                element.style.color = '#F1835E';
            } else if (response.status === 'removed') {
                element.classList.remove('fas');
                element.classList.add('far');
                element.style.color = 'black';
            }
        }
    };
    xhr.send('estabelecimento_id=' + estabelecimentoId + '&usuario_email=' + usuarioEmail);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


