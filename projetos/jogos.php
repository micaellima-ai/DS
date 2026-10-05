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

$pdo -> exec($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $ano = $_POST["ano"];
    $nota = $_POST["nota"];


    if ($pdo ->exec($sql_cadastro)){
        $resultado = "Jogo cadastrado!";

    } else {
        $resultado = "Erro! Jogo não cadastrado";
    }
}




$buscar = "SELECT *FROM lista_jogos";

$stmt = $pdo -> query($buscar);

$jogos = $stmt -> fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



</body>
</html>