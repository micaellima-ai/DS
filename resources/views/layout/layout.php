<?php






?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/layout.css">
    <title>Document</title>
</head>

<body>
    <!-- CABEÇALHO -->
    <header>
        <nav class="navbar">
            <h2 class="logo">
                Meu Portfólio
            </h2>
            <ul class="menu">
                <li>
                    <a href="index.php"> Inicio </a>
                </li>
                <li>
                    <a href="index.php#projetos"> Projetos </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- -->
    <main class="pagina-projeto">
        <!-- -->
        <section class="cabecalho-projeto">
            <p class="projeto-tipo">
                Projeto
            </p>
            <h1>
                Cadastro de Jogos
            </h1>
            <p>
                Atividade desenvolvida durante as aulas de Desenvolvimento de Sistemas.
            </p>
        </section>

        <!-- -->
        <section class="conteudo-projeto">
            <h2>Cadastro de Jogos</h2>

            <form method="POST">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do jogo" required>

                <label for="genero">Genero</label>
                <input type="text" id="genero" name="genero" placeholder="Digite o nome do jogo" required>

                <label for="nota"></label>
                <input type="number" id="nota" name="nota" min=0 max=5 placeholder="Digite a nota do jogo 0 a 5" required>
                <br><br>

                <label for="ano"></label>
                <input type="number" name="ano" id="ano" min=1980 max=2026 placeholder="Digite o ano do jogo" required>

                <button type="submit">Enviar</button>

                <?php if ($resultado != "") { ?>

                    <span style="color: <?= ($resultado == 'Jogo cadastrado!') ? 'green' : 'red' ?>; font-weight: bold;">
                        <?= $resultado ?>
                    </span>

                <?php } ?>
            </form>


            <h2>Jogos cadastrado</h2>

            <table>
                <tr>
                <tr>ID</tr>
                <tr>Nome</tr>
                <tr>Gênero</tr>
                <tr>Nota</tr>
                <tr>Ano</tr>
                </tr>

                <?php foreach ($jogos as $jogos) { ?>
                    <tr>
                        <td><?= $jogo["id"] ?></td>
                        <td><?= $jogo["nome"] ?></td>
                        <td><?= $jogo["genero"] ?></td>
                        <td><?= $jogo["nota"] ?></td>
                        <td><?= $jogo["ano"] ?></td>
                    </tr>

                <?php } ?>
            </table>

        </section>
        <!-- FIM DA ATIVIDADE -->
         <div class="voltar-projetos">
            <a href="index.php#projetos"> ← Voltar para Projetos </a>
         </div>
    </main>

    <!-- RODAPÉ -->
     <footer>
        <p>Desenvolvido por <a href="https://micael315.devlook.xyz"> Micael Álvaro </a> ● 2026 </p>
     </footer>

</body>

</html>