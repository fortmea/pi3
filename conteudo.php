<?php
require_once("config.php");

?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="resources/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="resources/js/jquery-3.6.0.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="resources/js/addconteudo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <title>Conteudo </title>
    </head>

    <body class="bg-dark text-light">
        <?php include_once("nav.php"); ?>
        <?php
        $recebeid = $_GET['id'];
        $querybuscafilme = "SELECT f.nome nom, f.sinopse si, f.lancamento lan, f.imagem, g.`desc` gen, f.tipo ti , e.nome est From filme f inner join genero_filme g ON f.genero = g.idgenero_filme INNER JOIN filme_estudio fe ON fe.filme_id = f.id INNER JOIN estudio e ON fe.estudio_id = e.idestudio where id=$recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();

        $linha = $exe->fetch(PDO::FETCH_OBJ);
        ?>
        <div class="container vertical">
            <div class="card border-primary bg-dark" style="padding: 1em;">
                <div class="card text-white bg-dark mb-3" style="max-width: 200rem;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src=<?= $linha->imagem ?>>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $linha->nom ?></h5>
                                <p class="card-text"> <?= $linha->si ?></p>
                                <p class="card-text">Data de Lançamento: <?= $linha->lan ?></p>
                                <p class="card-text">Gênero: <?= $linha->gen ?></p>
                                <p class="card-text"><?php
                                    if($linha->ti == 1){
                                        echo 'Tipo: Filme';
                                    }else{
                                        echo 'Tipo: Série';
                                    }
                                
                                ?> </p>
                                <p class="card-text">Estudio: <?= $linha->est ?></p>
                                <p class="card-text">Gênero: <?= $linha->gen ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>

    </html>