<?php
    $nome = "";
    $idade = 0;
    $resultado = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
    }

    if ($idade > 18) {
        $resultado = "Sim";
    } else {
        $resultado = "Não";
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>HTML no PHP</title>
    </head>

    <body>

        <div class="ti">
            <h1>Nome: <?= $nome ?> </h1>
            <p>Idade: <?= $idade ?></p>
        </div>



        <form method="POST">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome">

            <label for="idade">Idade</label>
            <input type="number" id="idade" name="idade" placeholder="Digite a idade">

            <button type="submit">Enviar</button>

        </form>

        <?php if ($resultado != "") { ?>
            <div class="res">
                <p > Seu nome é <?= $nome ?> e tem <?= $idade ?> anos.
                    <br>
                    Você é de maior de idade?: <?= $resultado ?></p> 
                </p>

            </div>
        <?php } ?>


    </body>

    </html>