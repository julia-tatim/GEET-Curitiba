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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    .rounded-circle {
    width: 50px;
    height: auto; 
    aspect-ratio: 1 / 1; 
    object-fit: cover;
    border-radius: 50%;
}
    </style>

    .tam{
        width: 60%;
        height: auto;
    }
    @media (max-width: 768px) {
        .tam{
            width: 30%;
        }
        .tam2{
        padding-left: 80px;
        padding-right: 80px;
        padding-top: 30px;
        padding-bottom: 30px;

    }
    }

    

    a {
        color: #007bff;
        text-decoration: none;
        background-color: transparent; }
    a:hover {
        color: #0056b3;
        text-decoration: underline; }


    a {
        color: #007bff;
        text-decoration: none;
        background-color: transparent; }
    a:hover {
        color: #0056b3;
        text-decoration: underline; }



    .btn {
        font-size: 14px; }
    .btn.btn-primary {
        background: #F1835E;
        border-color: #F1835E; }

    .owl-carousel .owl-dots {
        text-align: center;
        margin-top: 20px; }
    .owl-carousel .owl-dots .owl-dot {
      width: 10px;
      height: 10px;
      margin: 5px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.3);
      position: relative; }
      
    .owl-carousel .owl-dots .owl-dot.active {
        background: #F1835E; }
  

    .block-20 {
        overflow: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        height: 275px;
        position: relative;
        display: block; }


    .blog-entry .text .heading a {
        color: #000; }
    .blog-entry .text .heading a:hover, .blog-entry .text .heading a:focus, .blog-entry .text .heading a:active {
        color: #F1835E; }

    .imgcarrossel{
        border-radius: 10px;
    }
    .fontCarrossel{
        font-size: medium
    }
    
    .tamm {
            width: 100%;
            max-width: 150px;
        }
        .container-custom {
            margin-top: 20px;
        }
        .itemm {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .itemm img {
            margin-bottom: 15px;
        }
        .itemm h5, .itemm p {
            text-align: center;
        }
        @media (min-width: 992px) {
            .itemm {
                flex-direction: row;
            }
            .itemm img {
                margin-bottom: 0;
                margin-right: 15px;
            }
            .itemm h5, .itemm p {
                text-align: left;
            }
        }
        @media (max-width: 576px) {
            .container-custom {
                padding: 10px;
            }
            .tamm {
                max-width: 100px;
            }
            .itemm h5 {
                font-size: 1rem;
            }
            .itemm p {
                font-size: 0.875rem;
            }
        }
        
        @media (max-width: 650px) {
        .dim{
            font-size: 12px;
        }
        .dim2{
            width: 100px;
            height: 30px;
            font-size: 12px;
        }
        .dim3{
            font-size: 12px;
            margin-bottom:5px;
        }
    }

    @media (max-width: 768px) {
  .row2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
  .col-lg-6 {
    max-width: none;
  }
  .tamm {
    max-width: 100px; 
  }
  .itemm h5 {
    font-size: 1rem;
  }
  .itemm p {
    font-size: 0.875rem;
  }
}

.cardBackground {
  background-image: url('../image/imagemContato2.png'); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 600px;
}
   
   </style>
</head>
<body>
    <!-- cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../image\logo.svg" alt="Bootstrap" width="100" height=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                      <a class="nav-link text-dark cabin2" aria-current="page" href="#contato">Contato</a>
                  </li>
              </ul>
          </div>
            <form class="d-flex">
                <input class="form-control me-2 cabin2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-dark cabin2" type="submit">Buscar</button>
            </form>
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
                <div class="carousel-caption d-md-block">
                    <h5 class="cabin2 dim">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin dim3">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn dim2" >CLIQUE AQUI</button></a>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../image\olho.png" class="d-block w-100" alt="Jardim-Botanico">
                <div class="carousel-caption d-md-block">
                    <h5 class="cabin2 dim">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin dim3">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn dim2" >CLIQUE AQUI</button></a>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../image\opera-de-arame.png" class="d-block w-100" alt="Jardim-Botanico">
                <div class="carousel-caption d-md-block">
                    <h5 class="cabin2 dim">EXPLORE, DESCUBRA, DESFRUTE</h5>
                    <p class="cabin dim3">Os melhores destinos estão aqui!</p>
                    <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn dim2" >CLIQUE AQUI</button></a>
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
    <div class="container text-center container-custom">
        <div class="row row2">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="itemm">
                    <img src="../image/1.png" alt="Bootstrap" class="tamm mt-2">
                    <div>
                        <h5 class="p-3 cabin2">SÓ O MELHOR!</h5>
                        <p class="cabin2">Descubra os melhores passeios de Curitiba e aproveite cada momento.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="itemm">
                    <img src="../image/2.png" alt="Bootstrap" class="tamm mt-2">
                    <div>
                        <h5 class="p-3 cabin2">PARA FICAR DE OLHO</h5>
                        <p class="cabin2">Encontre aqui os melhores eventos da cidade. Fique de olho e não perca nada!</p>
                    </div> 
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="itemm">
                    <img src="../image/3.png" alt="Bootstrap" class="tamm mt-2">
                    <div>
                        <h5 class="p-3 cabin2">SALVE E COMENTE</h5>
                        <p class="cabin2">Faça seu cadastro, deixe seu feedback e salve todos seus lugares favoritos.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="itemm">
                    <img src="../image/4.png" alt="Bootstrap" class="tamm mt-2">
                    <div>
                        <h5 class="p-3 cabin2">MAIS PRÓXIMO DE VOCÊ</h5>
                        <p class="cabin2">Facilite ainda mais sua busca filtrando pela localização do bairro que você desejar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- parte das informações -->

    <!-- carrossel de destaques -->
    <section class="ftco-section">
        <h2 class="text-center cabin2 mb-4">Destaques</h2>
      <div class="text-center mb-3">
        <a href="explorar.html"><button type="button" class="btn btn-outline-light cabin2 color-btn" >MOSTRAR MAIS</button></a>
      </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img1.png');">
                                    
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">Museu do Olho</a></h3>
                    <p class="cabin2 fontCarrossel">Ponto Turistico</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2 ">Read More <span ></span></a></p>
                    </div>
                  </div>
                </div>
                        </div>

                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img2.png');">
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">Hard Rock</a></h3>
                    <p class="cabin2 fontCarrossel">Restaurante</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2">Read More</a></p>
                    </div>
                  </div>
                </div>
                        </div>

                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img3.png');">
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">Dunkel</a></h3>
                    <p class="cabin2 fontCarrossel">Balada</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2">Read More</a></p>
                    </div>
                  </div>
                </div>
                        </div>

                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img4.png');">
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">Opera de Arame</a></h3>
                    <p class="cabin2 fontCarrossel">Ponto Turistico</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2">Read More</a></p>
                    </div>
                  </div>
                </div>
                        </div>

                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img5.png');">
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">O Caldeirão Bruxo</a></h3>
                    <p class="cabin2 fontCarrossel">Restaurante</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2">Read More</a></p>
                    </div>
                  </div>
                </div>
                        </div>

                        <div class="item">
                            <div class="blog-entry">
                  <a href="#" class="block-20 d-flex align-items-start imgcarrossel" style="background-image: url('../image/img6.png');">
                  </a>
                  <div class="text border border-top-0 pt-4">
                    <h3 class="heading"><a href="#">Shed</a></h3>
                    <p class="cabin2 fontCarrossel">Balada</p>
                    <div class="d-flex align-items-center mt-4">
                        <p class="mb-0"><a href="#" class="btn btn-primary cabin2">Read More</a></p>
                    </div>
                  </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- carrossel de destaques -->

    <!-- contato -->

    
    <div class="cardBackground">
        <div class="container my-5">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="../image/carinha.png" alt="Descrição da Imagem" class="img-fluid">
                      </div>
                      <div class="col-md-8">
                        <form>
                            <div class="mb-3">
                              <h3>Entre em Contato</h3>
                              <label for="name" class="form-label">Nome</label>
                              <input type="text" class="form-control" id="name" placeholder="Digite seu nome" required>
                            </div>
                            <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" placeholder="Digite seu email" required>
                            </div>
                            <div class="mb-3">
                              <label for="subject" class="form-label">Assunto</label>
                              <input type="text" class="form-control" id="subject" placeholder="Digite o assunto" required>
                            </div>
                            <div class="mb-3">
                              <label for="message" class="form-label">Mensagem</label>
                              <textarea class="form-control" id="message" rows="3" placeholder="Digite sua mensagem" required></textarea>
                            </div>
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary">Enviar Email</button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
      
        <!-- contato -->
      </div>
    </div>
  </div>


    <!-- Bootstrap JavaScript -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function(){
      $(".owl-carousel").owlCarousel();
      
    });
    (function($) {
    var fullHeight = function() {
                           
    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
        $('.js-fullheight').css('height', $(window).height());
    });

};
fullHeight();

var carousel = function() {
    $('.featured-carousel').owlCarousel({
    loop:true,
    autoplay: true,
    margin:30,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    nav:true,
    dots: true,
    autoplayHoverPause: false,
    items: 1,
    navText : ["<span class='ion-ios-arrow-back'></span>","<span class='ion-ios-arrow-forward'></span>"],
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2
      },
      1000:{
        items:3
      }
    }
    });

};
carousel();

})(jQuery);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
