<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>moview</title>
    <link href="resources/css/style.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<?php
require("nav.php");
?>
<div>
<div id="carrossel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carrossel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carrossel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carrossel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <a href="bruh.php">
      <img src="resources/invocacao2.png" class="d-block w-100 " alt="">
      </a>
    </div>
    
    <div class="carousel-item">
    <img src="resources/naruto.png" class="d-block w-100" alt="Logomarca da empresa">

    </div>
    <div class="carousel-item">
    <img src="resources/kongzilla.png" class="d-block w-100" alt="Logomarca da empresa">

    </div>
  </div>
  <button class="carousel-control-prev " type="button" data-bs-target="#carrossel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next " type="button" data-bs-target="#carrossel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span> 
    <span class="visually-hidden">Próximo</span>
  </button>
</div>
</div>

<div class="card centralizado border-primary" id="sobre" style="max-width:100rem;margin-top:1em">
  <div class="card-body bg-dark ">
    <h5 class="card-title">Sobre o projeto moview</h5>
    <h6 class="card-subtitle mb-2 text-muted">O projeto moview surgiu com o objetivo de diminuir as horas perdidas na busca de filmes e séries
    . Além desse propósito também temos o intuito de criar uma comunidade que queira compartilhar suas resenhas dos filmes assistidos
   e com o diferencial que nosso site possui, pagaremos a essas pessoas de acordo com o calculo que nosso script fizer.
    </h6>
    <p class="card-text text-muted" >Integrantes do projeto:
    <br>Arthur Augusto Stati Possetti, João Walter Amadeu, Rodrigo Tavares Franco Junior, Wesley Fantineli.
</p>
  </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>