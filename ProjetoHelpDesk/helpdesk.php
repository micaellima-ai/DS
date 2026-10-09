<?php 
include 'helpdesk-func.php' ;

require __DIR__ . "/helpdesk.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- CADASTRAR -->
    <form method="POST">

        <label>Nome:</label>
        <input type="text" id="nome" name="nome">

        <label>Setor:</label>
        <input type="text" id="setor" name="setor">

        <label>Prioridade:</label>
        <input type="text" id="prioridade" name="prioridade">

        <label>Equipamento:</label>
        <input type="text" id="equipamento" name="equipamento">

        <button type="submit" name="acao" value="cadastrar">Enviar</button>

    </form>


    <h2>CHAMADO CADASTRADO</h2>
    <?php foreach ($funcionarios as $funcionario) { ?>


        <h3><?= $funcionario["nome"] ?></h3>
        <p>Idade: <?= $funcionario["idade"] ?></p>
        <p>Curso: <?= $funcionario["curso"] ?></p>

    <?php  } ?>

    <!-- ALTUALIZAR -->
    <h2>Atualizar</h2>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" id="nome" name="nome">

        <label>Setor:</label>
        <input type="text" id="setor" name="setor">

        <label>Prioridade:</label>
        <input type="text" id="prioridade" name="prioridade">

        <label>Equipamento:</label>
        <input type="text" id="equipamento" name="equipamento">

        <button type="submit" name="acao" value="atualizar">Atualizar</button>

    </form>

    <!-- DELETAR -->
    <h3>DELETAR</h3>
    <form method="POST">

        <label>Nome:</label>
        <input type="text" id="nome" name="nome">

        <button type="submit" name="acao" value="deletar">Deletar</button>


    </form>



</body>

</html>