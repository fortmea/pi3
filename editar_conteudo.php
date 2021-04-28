<?php
require_once("config.php");
$metodo = $_SERVER["REQUEST_METHOD"];
if ($metodo == "POST") {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!isset($_POST["imagem"])) {
        if ($_FILES["imagem"]["error"] > 0) {
            print_r($_FILES["imagem"]);
            echo "Error: " . $_FILES["imagem"]["error"] . "<br>";
            exit();
        } else {
            $nome = $_POST['nome'];
            $sinopse = $_POST['sinopse'];
            $lancamento = $_POST['lancamento'];
            $genero = $_POST['genero'];
            $tipofilme = $_POST['tipo'];
            move_uploaded_file($_FILES["imagem"]["tmp_name"], "uploads/" . $_FILES["imagem"]["name"]);
            $bin_string = file_get_contents("uploads/" . $_FILES["imagem"]["name"]);
            $hex_string = base64_encode($bin_string);
            $tipo = $_FILES["imagem"]["type"];
            $base64 = "data:$tipo;base64,$hex_string";
            unlink("uploads/" . $_FILES["imagem"]["name"]);
            $query = 'INSERT INTO `filme`(`nome`,`sinopse`,`lancamento`,`genero`,`imagem`,`tipo`) VALUES(?, ?, ?, ?, ?, ?)';
            $exec = $conn->prepare($query);
            $exec->bindParam(1, $nome);
            $exec->bindParam(2, $sinopse);
            $exec->bindParam(3, $lancamento);
            $exec->bindParam(4, $genero);
            $exec->bindParam(5, $base64);
            $exec->bindParam(6, $tipofilme);
            $exec->execute();
            $id = $conn->lastInsertId();
            for ($x = 0; $x < count($_POST['estudios']); $x++) {
                $query_estudio = "INSERT INTO `filme_estudio` VALUES(:id_filme, :id_estudio)";
                $instestudio = $conn->prepare($query_estudio);
                $instestudio->bindParam(':id_filme', $id);
                $instestudio->bindParam(':id_estudio', $_POST['estudios'][$x]);
                $instestudio->execute();
            }
            for ($x = 0; $x < count($_POST['pessoas']); $x++) {
                $query_pessoa = "INSERT INTO `filme_pessoa` VALUES(:id_filme, :id_pessoa)";
                $instpessoa = $conn->prepare($query_pessoa);
                $instpessoa->bindParam(':id_filme', $id);
                $instpessoa->bindParam(':id_pessoa', $_POST['pessoas'][$x]);
                $instpessoa->execute();
            }

            header("Location: conteudo.php?id=$id");
        }
    }
} else {
    $recebeid = $_GET['id'];
    
    $sql = "SELECT f.id, f.nome, f.sinopse, f.lancamento, f.genero, f.imagem, f.tipo  FROM filme f where id='$recebeid'";

    $exe = $conn->prepare($sql);

    $exe->execute();

    $filme = $exe->fetch(PDO::FETCH_OBJ);
    $genero = $filme->genero;
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
        <title>Adicionar conteúdo - moview</title>
    </head>

    <body class="bg-dark text-light">
        <?php include_once("nav.php"); ?>
        <div class="container vertical">
            <div class="card border-primary bg-dark" style="padding: 1em;">
                <h3 class="text-primary">Adicionar filme ou série</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label text-light">Nome</label>
                        <input type="text" class="form-control text-light bg-dark" name="nome" placeholder="Ace Ventura" value="<?= $filme->nome ?>">
                    </div>
                    <div class="mb-3">
                        <label>Data de lançamento</label><br>
                        <input type="date" class="bg-secondary text-light btn-outline-light col-12" name="lancamento" value="<?= $filme->lancamento ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Sinopse</label>
                        <textarea class="form-control text-light bg-dark" name="sinopse" rows="3"> <?= $filme->sinopse ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label text-light">Imagem de capa (1920x880)</label>
                        <input class="form-control text-light bg-dark" type="file" value="<?= $filme->imagem ?>" accept="image/gif, image/jpeg, image/png, image/bmp" name="imagem">
                    </div>
                    <div class="mb-3">
                        <p>
                        <h5>Categoria</h5>
                        </p>
                        <div class="form-check">
                            <?php $check="checked"; ?> 
                            <?php 
                                if($filme->tipo == 0){
                                   ?>   <input class="form-check-input" type="radio" name="tipo" value="0" checked>
                                    <label class="form-check-label">
                                        Série
                                    </label>
                                     </div>
                                     </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="1" >
                                    <label class="form-check-label">
                                        Filme
                                    </label>
                                </div>
                                    <?php
                                   
                                }else{
                                    ?>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="0" >
                                    <label class="form-check-label">
                                        Série
                                    </label>
                                </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="1" checked>
                                    <label class="form-check-label">
                                        Filme
                                    </label>
                                </div><?php
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <p>
                        <h5>Gênero</h5>
                        </p>
                        <select class="form-select form-select-lg mb-3 bg-dark text-light" aria-label=".form-select-lg example" name="genero">
                            <?php
                            $querygenero = 'SELECT * FROM `genero_filme`';
                            $execqg = $conn->prepare($querygenero);
                            $execqg->execute();
                            while ($linha = $execqg->fetch(PDO::FETCH_OBJ)) { ?>
                            <?php
                                if($linha->idgenero_filme == $genero){?>
                                 <option value="<?= $linha->idgenero_filme ?>" selected><?= $linha->desc ?></option>
                                 <?php   
                                }else{
                            ?>
                                <option value="<?= $linha->idgenero_filme ?>"><?= $linha->desc ?></option>
                            <?php
                            }}
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <p>
                        <h4>Atores e direção</h4>
                        </p>
                        <input type="hidden" id="father">

                        <select class="form-select form-select-lg mb-3 bg-dark text-light" id="selectpessoa1" name="pessoas[0]">
                            <?php
                            $querypessoa = 'SELECT * FROM `pessoa`';
                            $execqp = $conn->prepare($querypessoa);
                            $execqp->execute();
                            $count = 0;
                            while ($linhap = $execqp->fetch(PDO::FETCH_OBJ)) { ?>
                                <option value="<?= $linhap->id ?>"><?= $linhap->nome ?></option>
                            <?php
                                $count++;
                            }
                            ?>
                        </select>
                        <p>
                            <button class="btn btn-outline-primary" type="button" onclick="add_act_selector()">Adicionar</button>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p>
                        <h4>Estúdio(s)</h4>
                        </p>
                        <input type="hidden" id="father2">

                        <select class="form-select form-select-lg mb-3 bg-dark text-light" id="selectestudio1" name="estudios[0]">
                            <?php
                            $queryestudio = 'SELECT * FROM `estudio`';
                            $execqe = $conn->prepare($queryestudio);
                            $execqe->execute();
                            $count = 0;
                            while ($linhae = $execqe->fetch(PDO::FETCH_OBJ)) { ?>
                                <option value="<?= $linhae->idestudio ?>"><?= $linhae->nome ?></option>
                            <?php
                                $count++;
                            }
                            ?>
                        </select>
                        <p>
                            <button class="btn btn-outline-primary" type="button" onclick="add_est_selector()">Adicionar</button>
                        </p>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="addconteudo" class="btn btn-primary col-12">
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>

    </html><?php
        }
            ?>