<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML no PHP</title>
</head>
<body>
    <?php
    $nome= "Micael";
    $idade = 23;

    if ($nome > 18){
        $maior = "Sim";
    }else{
        $maior = "Não";
    }
    ?>
    <h1>Nome: <?= $nome ?> </h1>
    <p>Idade: <?= $idade ?></p>

    <p>É de Maior?: <?= $maior ?></p>
</body>
</html>