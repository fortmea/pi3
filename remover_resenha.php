<?php 
$metodo = $_SERVER["REQUEST_METHOD"];
if($metodo="POST"){
    require_once("config.php");
    $recebeid = $_POST['id'];
    $idconteudo = $_POST['conteudo'];
        $querybuscafilme = "DELETE FROM `resenha` WHERE `idresenha` = $recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        header('location: conteudo.php?id='.$idconteudo);
}
?>