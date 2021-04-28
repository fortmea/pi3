<?php
require_once("config.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="resources/js/jquery-3.6.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="resources/js/addconteudo.js"></script>
    <link href="resources/css/style.css" rel="stylesheet">
    <title>Conteudo </title>
</head>

<body class="bg-dark text-light">
    <?php include_once("nav.php"); ?>
    <div class="container vertical">
        <?php
        $recebeid = $_GET['id'];
        $querybuscafilme = "SELECT f.nome nom, f.sinopse si, f.lancamento lan, f.imagem, g.`desc` gen, f.tipo ti From filme f inner join genero_filme g ON (f.genero = g.idgenero_filme) where id=$recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        $conta = 0;
        while ($linha = $exe->fetch(PDO::FETCH_OBJ)) {
            $conta++;
        ?>

            <div class="card border-primary bg-dark">
                <div class="card-header bg-dark bg-gradient">
                    <h5 class="card-title"><?= $linha->nom ?></h5>
                </div>

                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="img-thumbnail foto" src='<?= $linha->imagem ?>'>
                        </div>
                        <div class="col-md-8">
                            <p class="card-text"> <?= $linha->si ?></p>
                            <p class="card-text">Data de Lançamento: <?= $linha->lan ?></p>
                            <p class="card-text">Gênero: <?= $linha->gen ?></p>
                            <p class="card-text"><?php
                                                    if ($linha->ti == 1) {
                                                        echo 'Filme';
                                                    } else {
                                                        echo 'Série';
                                                    }

                                                    ?> </p>
                            <div>
                                <h5>Estúdios:</h5>
                                <?php
                                $queryestudios = "SELECT * from `estudio` e INNER JOIN `filme_estudio` fe ON(fe.estudio_id = e.idestudio)  where fe.filme_id = $recebeid";
                                $exeqe = $conn->prepare($queryestudios);
                                $exeqe->execute();
                                while ($linhaest = $exeqe->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                    <p class="card-text"><?= $linhaest->nome ?></p>
                                <?php
                                }
                                ?>
                            </div>
                            <div>
                                <h5>Atores:</h5>
                                <?php
                                $queryestudios = "SELECT * from `pessoa` p INNER JOIN `filme_pessoa` fp ON(fp.pessoa = p.id)  where fp.filme = $recebeid";
                                $exeqe = $conn->prepare($queryestudios);
                                $exeqe->execute();
                                while ($linhaest = $exeqe->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                    <p class="card-text"><?= $linhaest->nome ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer bg-dark vertical">
                            <h2>Avaliações:</h2>
                            <?php
                                $queryresenhas = "SELECT *, u.nome as 'nome_autor' from `resenha` r INNER JOIN `usuario` u ON(r.autor = u.idusuario) where r.filme = $recebeid";
                                $exeqre = $conn->prepare($queryresenhas);
                                $exeqre->execute();
                                $contare = 0;
                                while ($linhare = $exeqre->fetch(PDO::FETCH_OBJ)) {
                                    $contare++;
                                ?><div class="vertical bg-dark bg-gradient" style="padding:1em">
                                    <p class="card-text"><h5><?= $linhare->titulo ?></h5></p>
                                    <p class="card-text"><h6><?= $linhare->subtitulo ?></h6></p>
                                    <p class="card-text"><?= $linhare->conteudo ?></p>
                                    <p class="card-text">Avaliação: <?= $linhare->pontuacao ?></p>
                                    <p class="card-text">Data da publicação: <?= $linhare->data_pub ?></p>
                                    <cite><p class="card-text">Autor: <?= $linhare->nome_autor ?></p></cite>
                                    </div>
                                <?php
                                }
                                if ($contare == 0) {
                                    ?>
                                        <div class="alert alert-warning">
                                            Nenhuma resenha encontrada, adiciona uma!
                                        </div>
                                    <?php }
                                    ?>
                        </div>
                    </div>
                </div>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>