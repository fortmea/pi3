<?php
if(!isset($_GET["k"])){
    header("Location: lista.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet">
    <title>Pesquisando por "<?=$_GET["k"]?>"</title>
</head>

<body class="bg-dark text-light">
    <?php
    require("nav.php");
    ?>
    <div class="container-fluid card-lista vertical">
        <?php
        require_once("config.php");
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $termo_pesquisa = $_GET['k'];
        $queryfilme = "SELECT * FROM `filme` where `filme`.`nome` like '$termo_pesquisa%'";
        $execqg = $conn->prepare($queryfilme);
        $execqg->execute();
        while ($linha = $execqg->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="card bg-dark border-primary mb-3">

                <div class="card-body bg-dark">
                    <div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src=<?= $linha->imagem ?> class="img-thumbnail foto">

                            </div>
                            <div class="col-md-8">
                                <p>
                                <h1><?= $linha->nome ?></h1>
                                </p>
                                <p>
                                <h6><?= $linha->sinopse ?></h6>
                                </p>
                                <h6>Data de lançamento: <?= $linha->lancamento ?></h6>
                                <h6>Média das avaliações: Não avaliado</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="margin-top:1em">
                        <a href="conteudo.php?id=<?= $linha->id ?>" class="btn btn-outline-primary">Ir para a página do conteúdo</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>

</html>