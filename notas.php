<?php
$nome = "";
$idade = 0;
$media = 0;
$situação = "";
$resto = 0;
$restofre = 0;



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];


    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];
    $nota3 = $_POST["nota3"];
    $nota4 = $_POST["nota4"];
    $nota5 = $_POST["nota5"];
    $frequencia = $_POST ["frequencia"];
    



    $media = (
        ($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)
    ) / 10;

    if($media == 10 && $frequencia >= 75){
        $situação = "APROVADO COM EXCELÊNCIA";
    }
    elseif($media >= 7 && $frequencia >= 75) {
        $situação = "APROVADO";
    } 
    elseif ($media >= 5 && $media < 7 && $frequencia >= 75) {
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

        <label for="frequencia">Frequencia</label>
        <input type="number" name="frequencia" id= "frequencia" min=0 max=100 placeholder="Digite a Frequencia (%)" required>
        <br><br>

        <button type="submit">Enviar</button>

    </form>



    <?php if ($situação != "") {?>

        <p><strong> Nome do Aluno: </strong> <?= $nome ?> </p>
        <p> <strong> Idade do Aluno: </strong> <?= $idade ?> </p>
        <ul>
            <li>
                <p>Nota 1: <?= $nota1 ?> </p>
            </li>
            
            <li>
                <p>Nota 2: <?= $nota2 ?> </p>
            </li>
            
            
            <li>
                <p>Nota 3: <?= $nota3 ?> </p>
            </li>
                
            <li>
                <p>Nota 4: <?= $nota4 ?> </p>
            </li>
                
            <li>
                <p>Nota 5: <?= $nota5 ?> </p>
            </li>
            

        </ul>
    
        <p> <strong> Media do Aluno: </strong><?= $media ?> </p>
        <p> <strong> Situação: </strong> 
            <span style="color: <?= ($situação == 'APROVADO' || $situação == 'APROVADO COM EXCELÊNCIA') ? 'green ' : (($situação == 'RECUPERAÇÃO') ? 'orange' : 'red') ?> "> 
                 <?= $situação ?> 
            </span>
    </p>
        <p> <strong> Frequencia do aluno: </strong><?= $frequencia ?> %</p>

    <?php } ?>

    <?php if (($situação == "RECUPERAÇÃO" || $situação == "REPROVADO" ) && $frequencia >= 75 ) {  ?>

        <p>Faltaram <?= $resto ?> pontos para APROVAÇÃO!! </p>

    <?php } ?>

    

<br><br>

    <a href="index.php">Voltar</a>

</body>

</html>