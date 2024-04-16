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
        .carousel-control-prev, .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 30px; 
            height: 30px; 
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5); 
            color: #000; 
            font-size: 24px; 
            line-height: 30px;
            text-align: center;
        }
        .custom-carousel-button {
            background-color: #318EB9; 
            border-color: #318EB9; 
        }
        .custom-carousel-button:hover {
            background-color: #F1835E; 
            border-color: #F1835E;
        }
        .carousel-control-prev {
            left: 10px; 
        }
        .carousel-control-next {
            right: 10px;
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
      
      .custom-background {
      background: linear-gradient(to left, #1E659B, #f0f0f0);
      width: 100%;
    }
    .contact-container {
      padding: 50px 0;
      position: relative; 
    }
    .contact-form {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .contact-image {
            position: absolute;
            top: 0;
            left: 0;
    }

    .button-color{
        background-color: #1E659B;
        color: #fff;
    }

    </style>
</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="../image\logo.svg" alt="Bootstrap" width="100" height=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                      <a class="nav-link text-dark cabin2" aria-current="page" href="#contato">Contato</a>
                  </li>
              </ul>
          </div>
            <form class="d-flex">
                <input class="form-control me-2 cabin2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-dark cabin2" type="submit">Buscar</button>
            </form>
            <a class="navbar-brand m-2" href="meusdados.php"><img src="..\image\perfil.svg" alt="Bootstrap" width="50" height=""></a>
        </div>
    </nav>
    <!-- cabeçalho -->

    <!-- carrossel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../image\botanico.png" class="d-block w-100" alt="Jardim-Botanico">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="cabin2">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn" >CLIQUE AQUI</button></a>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../image\olho.png" class="d-block w-100" alt="Jardim-Botanico">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="cabin2">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn" >CLIQUE AQUI</button></a>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../image\opera-de-arame.png" class="d-block w-100" alt="Jardim-Botanico">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="cabin2">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn" >CLIQUE AQUI</button></a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- carrossel -->

    <!-- parte das informações -->
    <div class="container text-center">
        <div class="row">
            <div class="col p-3">
                <img src="../image\1.png" alt="Bootstrap" width="60%" height="">
                <h5 class="p-3 cabin2">SÓ O MELHOR!</h5>
                <p class="cabin2">Encontre os melhores passeios de Curitiba.</p>
            </div>
            <div class="col p-3">
                <img src="../image\2.png" alt="Bootstrap" width="60%" height="">
                <h5 class="p-3 cabin2">PARA FICAR DE OLHO</h5>
                <p class="cabin2">Os melhores eventos que acontecem na cidade você encontra aqui, fique de olho e não perca!</p>
            </div>
            <div class="col p-3">
                <img src="../image\3.png" alt="Bootstrap" width="60%" height="">
                <h5 class="p-3 cabin2">SALVE E COMENTE</h5>
                <p class="cabin2">Faça seu cadastro, deixe seu feedback e salve seus lugares favoritos.</p>
            </div>
            <div class="col p-3">
                <img src="../image\4.png" alt="Bootstrap" width="60%" height="">
                <h5 class="p-3 cabin2">MAIS PRÓXIMO DE VOCÊ</h5>
                <p class="cabin2">Para facilitar sua buscar filtre pela localização do bairro que desejar.</p>
            </div>
        </div>
    </div>
    <!-- parte das informações -->

    <!-- carrossel de destaques -->
    <div class="container my-5">
      <h2 class="text-center my-5 cabin2 mb-4">Destaques</h2>
      <div class="text-center mb-3">
        <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn" >MOSTRAR MAIS</button></a>
      </div>
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="row justify-content-center">
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img1.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">Museu do Olho</h5>
                                  <p class="card-text">Ponto Turistico</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img2.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">Hard Rock</h5>
                                  <p class="card-text">Restaurante</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">

                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img3.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">Dunkel</h5>
                                  <p class="card-text">Balada</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <div class="row justify-content-center">
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img4.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">Opera de Arame</h5>
                                  <p class="card-text">Ponto Turistico</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img5.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">O Caldeirão Bruxo</h5>
                                  <p class="card-text">Restaurante tematico</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-5 p-3">
                          <div class="card">
                              <img src="../image\img6.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">Shed</h5>
                                  <p class="card-text">Balada</p>
                                  <img src="../image\estrelas.svg" class="card-img-top" alt="...">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <button class="carousel-control-prev custom-carousel-button" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next custom-carousel-button" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
      </div>
  </div>
    <!-- carrossel de destaques -->

    <!-- contato -->
    <div id="contato" class="container-fluid custom-background">
    <div class="container p-3">
        <div class="row contact-container">
            <div class="col-md-6  ">
          <h2 class="cabin2 p-3">CONTATO</h2>
          <form class="contact-form button-color">
            <div class="form-group">
              <label for="name" class="cabin2">Nome</label>
              <input type="text" class="form-control cabin2 my-1" id="name" placeholder="Digite seu nome" style="color: rgb(104, 104, 104);">
            </div>
            <div class="form-group">
              <label for="email" class="cabin2">Email</label>
              <input type="email" class="form-control cabin2 my-1" id="email" placeholder="Digite seu email" style="color: rgb(104, 104, 104);">
            </div>
            <div class="form-group">
              <label for="message" class="cabin2">Mensagem</label>
              <textarea class="form-control cabin2 my-1" id="message" rows="3" placeholder="Digite sua mensagem" style="color: rgb(104, 104, 104);"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-light button-color cabin2 my-3">Enviar</button>
          </form>
        </div>
        <div class="col-md-6">
          <img src="../image\carinha.png" alt="" class="img-fluid">
        </div>
        <!-- contato -->
      </div>
    </div>
  </div>


    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
