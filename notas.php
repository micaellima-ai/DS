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

        <label for="nota1">Nota1</label>
        <input type="number" name="nota1" id="nota1" placeholder="Digite sua 1° Nota">

        <label for="nota2">Nota2</label>
        <input type="number" name="nota2" id="nota2" placeholder="Digite sua 2° Nota">

        <label for="nota3">Nota3</label>
        <input type="number" name="nota3" id="nota3" placeholder="Digite sua 3° Nota">

        <label for="nota4">Nota4</label>
        <input type="number" name="nota4" id="nota4" placeholder="Digite sua 4° Nota">

        <label for="nota5">Nota5</label>
        <input type="number" name="nota5" id="nota5" placeholder="Digite sua 5° Nota">




        <button type="submit">Enviar</button>









</body>
</html>