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
        $conta = 0;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        while ($linha = $execqg->fetch(PDO::FETCH_OBJ)) {
            $querypontos = "SELECT SUM(r.pontuacao)/COUNT(r.filme) AS pontos FROM `resenha` r where r.filme = $linha->id";
            $execqp = $conn->prepare($querypontos);
            $execqp->execute();
            $conta++;
        ?>
            <div class="card bg-dark border-primary mb-3">

                <div class="card-body bg-dark">
                    <div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src=<?= $linha->imagem ?> class="img-thumbnail foto">

                            </div>
                            <div class="col-md-8">
                                <p>
                                    <a class="stretched-link link-secondary" style="text-decoration:none" href="conteudo.php?id=<?= $linha->id ?>">
                                        <h1><?= $linha->nome ?></h1>
                                    </a>
                                </p>
                                <p>
                                <h6><?= $linha->sinopse ?></h6>
                                </p>
                                <p class="text-secondary mb-3">Data de lan??amento: <span class="text-light"><?= $linha->lancamento ?></span></p>
                                <?php
                                $contaav = 0;
                                while ($linhap = $execqp->fetch(PDO::FETCH_OBJ)) {
                                    $contaav++;
                                    if ($contaav == 1) {
                                ?>

                                        <h6 class="text-secondary">M??dia das avalia????es: <span class="text-light"><?= number_format((float)$linhap->pontos, 2, '.', ''); ?></span></h6>
                                    <?php }
                                    else if($contaav == 0) {
                                    ?>
                                        <h6 class="text-secondary">M??dia das avalia????es: ainda n??o avaliado</h6>
                                <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="margin-top:1em">
                    <a href="conteudo.php?id=<?= $linha->id ?>" class="btn btn-outline-primary">Ir para a p??gina do conte??do</a>
                </div>
            </div>
        <?php
        }
        if ($conta == 0) {
        ?>
            <div class="alert alert-warning">
                Nenhuma resposta encontrada, tente outro termo.
            </div>
        <?php }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>

</html>