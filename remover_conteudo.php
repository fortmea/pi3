<?php 
$metodo = $_SERVER["REQUEST_METHOD"];
if($metodo="POST"){
    require_once("config.php");
    $recebeid = $_POST['id'];
        $querybuscafilme = "DELETE FROM `filme` WHERE `id` = $recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        $querybuscafilme = "DELETE FROM `filme_pessoa` WHERE `filme` = $recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        $querybuscafilme = "DELETE FROM `filme_estudio` WHERE `filme` = $recebeid";
        $exe = $conn->prepare($querybuscafilme);
        $exe->execute();
        header('location: index.php');
}
?>