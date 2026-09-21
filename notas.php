<?php
$nome= "";
$idade= 0;
$media = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];


    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];
    $nota3 = $_POST["nota3"];
    $nota4 = $_POST["nota4"];
    $nota5 = $_POST["nota5"];



    $media = (
        ($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) +($nota4 * 1) + ($nota5 * 3)
        );
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome">

        <label for="idade">Idade</label>
        <input type="number" id="idade" name="idade" placeholder="Digite a idade">


        

        <button type="submit">Enviar</button>









</body>
</html>