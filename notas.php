<?php
$nome = "";
$idade = 0;
$media = 0;
$situação = "";
$resto = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];


    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];
    $nota3 = $_POST["nota3"];
    $nota4 = $_POST["nota4"];
    $nota5 = $_POST["nota5"];



    $media = (
        ($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)
    ) / 10;

    if($media = 10){
        $situação = "APROVADO COM EXCELÊNCIA";
    }
    elseif($media >= 7) {
        $situação = "APROVADO";
    } 
    elseif ($media >= 5 && $media < 7) {
        $situação = "RECUPERAÇÃO";
        $resto = 7 - $media;
    } 
    else {
        $situação = "REPROVADO";
        $resto = 7 - $media;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="notas.css">
    <title>Nota Aluno</title>
</head>

<body>
    <h1>Requisitos</h1>

    <form method="POST">

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome">

        <label for="idade">Idade</label>
        <input type="number" id="idade" name="idade" min = 1 placeholder="Digite a idade">
        <br><br>

        <label for="nota1">Nota1</label>
        <input type="number" name="nota1" id="nota1" min=0 max=10 placeholder="Digite sua 1° Nota" required>
        <br><br>

        <label for="nota2">Nota2</label>
        <input type="number" name="nota2" id="nota2" min=0 max=10 placeholder="Digite sua 2° Nota" required>
        <br><br>

        <label for="nota3">Nota3</label>
        <input type="number" name="nota3" id="nota3" min=0 max=10 placeholder="Digite sua 3° Nota" required>
        <br><br>

        <label for="nota4">Nota4</label>
        <input type="number" name="nota4" id="nota4" min=0 max=10 placeholder="Digite sua 4° Nota" required>
        <br><br>

        <label for="nota5">Nota5</label>
        <input type="number" name="nota5" id="nota5" min=0 max=10 placeholder="Digite sua 5° Nota" required>
        <br><br>

        <button type="submit">Enviar</button>

    </form>



    <?php 
        if ($situação != "") {
    ?>
        <p> Nome do Aluno: <?= $nome ?> </p>
        <p> Idade do Aluno: <?= $idade ?> </p>
        <p>Nota 1: <?= $nota1 ?> </p>
        <p>Nota 2: <?= $nota2 ?> </p>
        <p>Nota 3: <?= $nota3 ?> </p>
        <p>Nota 4: <?= $nota4 ?> </p>
        <p>Nota 5: <?= $nota5 ?> </p>
        <p>Media do Aluno: <?= $media ?> </p>
        <p>Situação: <?= $situação ?> </p>
    <?php } ?>


    <br><br>
    <a href="index.php">Voltar</a>
</body>

</html>