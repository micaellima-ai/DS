<?php 

$nome = "";
$idade = 0;
$curso = "";
    // 1. DECLARAR O CAMINHO DO ARQUIVO JSON 
    $caminho = __DIR__ . "/dados.json";

    // 2. ABRIR/ LER O ARQUIVO JSON
    $json = file_get_contents($caminho);

    // 3. TRANSFORMAR JSPN EM ARRAY PHP
    $alunos = json_decode($json, true);

    // 4. CRIAR UM ALUNO

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $novoAluno = [         
        "nome" => $_POST["nome"],
        "idade" => $_POST["idade"],
        "curso" => $_POST["curso"]
        ];
    

    // 5. ADICIONAR O ALUNO NO ARRAY
    $alunos[] = $novoAluno;

    // 6. TRANSFORMAR ARRAY PHP EM JSON
    $jsonAtualizado = json_encode($alunos, JSON_PRETTY_PRINT | 
    JSON_UNESCAPED_UNICODE
);

    // 7. SALVAR NO ARQUIVO
    file_put_contents($caminho, $jsonAtualizado);



    echo "DADOS REGISTRADOS EM dados.json";
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
    <form method="POST">

    <label >Nome:</label>
    <input type="text" id="nome" name="nome">

    <label >Idade:</label>
    <input type="number" id="idade" name="idade">

    <label >Curso:</label>
    <input type="text" id="curso" name="curso">

    <button type="submit">Enviar</button>

    </form>

    <h2>Alunos Cadastrados</h2>
    <?php foreach($alunos as $aluno){ ?>
    

        <h3><?= $aluno["nome"] ?></h3>
        
        <p>Idade: <?= $aluno["idade"]?></p>
        <p>Curso: <?= $aluno["curso"]?></p>

    <?php  } ?>


</body>
</html>