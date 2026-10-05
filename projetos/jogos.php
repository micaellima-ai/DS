<?php
$nome = "";
$genero = "";
$ano = 0;
$resultado = "";
$nota = 0;


require __DIR__ . "/../conexao.php";


$sql = "CREATE TABLE IF NOT EXISTS lista_jogos (

    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    nota INT NOT NULL,
    ano INT NOT NULL
)";

$pdo->exec($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $ano = $_POST["ano"];
    $nota = $_POST["nota"];


    $sql_cadastro = "INSERT INTO lista_jogos (nome, genero, nota, ano) VALUES ('$nome', '$genero', '$nota', '$ano')";
    if ($pdo->exec($sql_cadastro)) {
        $resultado = "Jogo cadastrado!";
    } else {
        $resultado = "Erro! Jogo não cadastrado";
    }
}




$buscar = "SELECT *FROM lista_jogos";

$stmt = $pdo->query($buscar);

$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <form method="POST">
        <h1>Cadastro de jogos</h1>


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

</body>

</html>