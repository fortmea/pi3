<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet">
    <title>Lista - Moview</title>
</head>

<body class="bg-dark text-light">
    <?php
    require("nav.php");
    ?>
    <div class="container-fluid card-lista vertical">
        <?php
        require_once("config.php");
        $queryfilme = 'SELECT * FROM `filme`';
        $execqg = $conn->prepare($queryfilme);
        $execqg->execute();
        while ($linha = $execqg->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="card bg-dark border-primary mb-3">
                <div class="card-header bg-dark bg-gradient">
                    <h5><?= $linha->nome ?></h5>
                </div>
                <div class="card-body bg-dark">
                    <div>
                        <img src=<?= $linha->imagem ?> class="img-thumbnail foto">
                        <p>
                        <h6><?= $linha->sinopse ?></h6>
                        </p>
                        <h6>Data de lançamento: <?=$linha->lancamento?></h6>
                    </div>
                </div>
                <div class="card-footer">
                <a href="conteudo.php?id=<?=$linha->id?>" class="btn btn-outline-primary">Ir para a página do conteúdo</a>
                </div>
            </div>
        <?php
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>

</html>