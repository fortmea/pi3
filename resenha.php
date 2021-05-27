<?php
require_once("config.php");
$metodo = $_SERVER["REQUEST_METHOD"];
if ($metodo == "POST") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $avaliacao = (int)$_POST['avaliacao'];
        $queryresenha = "INSERT INTO `resenha`(`titulo`,`pontuacao`,`autor`,`conteudo`,`filme`) values(?,?,1,?,?)";
        $execqg = $conn->prepare($queryresenha);
        $execqg->bindParam(1,$titulo);
        $execqg->bindParam(2,$avaliacao);
        $execqg->bindParam(3,$conteudo);
        $execqg->bindParam(4,$id);
        $execqg->execute();
        header('location: conteudo.php?id='.$id);
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $querybuscafilme = "SELECT `nome` From filme where id=$id";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        $conta = 0;
        while ($linha = $exe->fetch(PDO::FETCH_OBJ)) {
            $conta++;
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
                <title>Adicionar conteúdo - moview</title>
            </head>

            <body class="bg-dark text-light">
                <?php include_once("nav.php"); ?>

                <div class="container vertical">
                    <div class="card border-primary bg-dark" style="padding: 1em;">
                        <div class="card-header">
                            <h4 class="text-light">Enviar resenha de "<?= $linha->nome ?>"</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" oninput="$('#avalia').html('Sua avaliação: '+$('#avaliacao').val())">
                                <div class="mb-3">
                                    <label class="form-label">Título da resenha</label>
                                    <input type="text" class="form-control" name="titulo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Conteúdo da resenha</label>
                                    <textarea class="form-control" name="conteudo"></textarea>
                                </div>
                                <div class="md-4" style="max-width: 25em;">
                                    <label class="form-label" id="avalia">Sua avaliação</label>
                                    <input type="range" class="form-range" min="0" max="5" step="0.5" id="avaliacao" name="avaliacao">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="addresenha" class="btn btn-primary col-12">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
            </body>

            </html><?php
                }
                if ($conta == 0) {
                    header('location: index.php');
                }
            } else {
                header('location: index.php');
            }
        }
                    ?>