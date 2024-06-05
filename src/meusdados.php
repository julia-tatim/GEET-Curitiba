<?php
include_once('config.php');

session_start();

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.html');
    exit();
}

$email = $_SESSION['email'];
$imagem_src = '';

$sql = "SELECT nome, data_nascimento, confirmaSenha, senha, imagem FROM usuario WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $dataNascimento = $row['data_nascimento'];
    $confirmaSenha = $row['confirmaSenha'];
    $senha = $row['senha'];
    if (!empty($row['imagem'])) {
        $imagem_base64 = base64_encode($row['imagem']);
        $imagem_src = 'data:image;base64,' . $imagem_base64;
    }
} else {
    $nome = "Nome não encontrado";
    $dataNascimento = "Data de Nascimento não encontrada";
    $confirmaSenha = "Confirmação de senha não encontrada";
    $senha = "Senha não encontrada";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        .color-btn3:hover {
        background-color: rgb(104, 104, 104);
        color: #fff; 
        }

        .color-btn2:hover {
        background-color: #F1835E;
        color: #fff
        }

        .color-btn4 {
            color: white;
            border-color: red;
            background-color: red;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .color-btn4:hover {
        background-color: #800000;
        color: #fff; 
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

.imagem-perfil {
    width: 70%;
    height: auto; /* ou qualquer valor desejado */
    aspect-ratio: 1 / 1; /* para garantir que a imagem seja exibida em uma proporção de 1:1 (quadrada) */
    object-fit: cover; /* para garantir que a imagem mantenha suas proporções */
    border-radius: 50%; /* para fazer a imagem ficar redonda */
}
.imagemPerfil {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%; /* ou qualquer outra largura desejada */
    height: 100%; /* ou qualquer outra altura desejada */
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

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5 bg-light p-5" style="border-radius: 20px;">
                <!-- Seu conteúdo aqui -->
                <form method="POST" action="userUpdateDelete.php" enctype="multipart/form-data">

                    <div class="form-group d-flex justify-content-center align-items-centerp">
                        <p class="cabin2">Imagem perfil:</p>
                        <?php
                        if (!empty($imagem_src)) {
                            echo "<img src='$imagem_src' class='imagem-perfil cabin5' style='max-width: 100%;' alt='Imagem'>";
                        } else {
                            echo "<p>Imagem não selecionada</p>";
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="imagem" class="form-label cabin2">Nova Imagem de Perfil</label></br>                
                        <input type="file" class="form-control cabin2 corfundo" name="imagem" id="imagem" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="inputNome" class="cabin2">Nome</label>
                        <input type="text" class="form-control cabin2 corfundo" name="nome" id="inputNome" value="<?php echo $nome; ?>">
                    </div>                   
                    <div class="form-group">
                        <label for="inputSenha4" class="cabin2">Senha</label>
                        <input type="password" class="form-control cabin2 corfundo" name="senha" id="inputSenha4" >
                    </div>
                    <div class="form-group">
                        <label for="inputSenha4" class="cabin2">Confirme sua senha</label>
                        <input type="password" class="form-control cabin2 corfundo" name="confirmaSenha" id="confirmaSenha" >
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="cabin2">Email</label>
                            <input type="email" class="form-control cabin2 corfundo" name="email" id="inputEmail4" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNascimento" class="cabin2">Data de Nascimento:</label>
                            <input type="date" class="form-control cabin2 corfundo" id="inputNascimento" name="data_nascimento"     
                                required min="1910-01-01"  
                                max="<?php echo date('Y-m-d', strtotime('-10 years')); ?>" 
                                title="Insira uma data de nascimento válida (mínimo 10 anos)" 
                                value="<?php echo $dataNascimento; ?>">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-outline-light cabin2 color-btn cabin2 mr-2 "name="update" id="update">Editar</button>
                    <a class="btn btn-outline-light cabin2 color-btn3 cabin3" onclick="confirmarExclusao()">Excluir</a>
                    <div class="float-right">
                       <button type="submit" class="btn btn-outline-light cabin2 color-btn4 cabin2 " name="logout" id="logout">Deslogar</button> 
                    </div>
                    
                </form>
                
                <a type="submit" class="btn btn-outline-light cabin2 color-btn cabin2 mr-2 "name="favoritos" id="favoritos" href="favDosUsuarios.php">Favoritos</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarExclusao() {
    Swal.fire({
        title: "Tem certeza?",
        text: "Você está prestes a excluir sua conta permanentemente. Clique em 'Confirmar' para excluir ou 'Cancelar' para manter.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f1835e",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confirmar",
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'userUpdateDelete.php'; 

            const inputDelete = document.createElement('input');
            inputDelete.type = 'hidden';
            inputDelete.name = 'delete';
            inputDelete.value = 'true';
            form.appendChild(inputDelete);

            const inputEmail = document.createElement('input');
            inputEmail.type = 'hidden';
            inputEmail.name = 'email';
            inputEmail.value = '<?php echo $_SESSION['email']; ?>';
            form.appendChild(inputEmail);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>