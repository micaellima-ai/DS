<?php 

    // Carregando o arquivo de rotas e guardando o valor retornando por ele na variável $rotas
    $rotas = require __DIR__ . "/routes/web.php";

    // Se a rota estiver vazia, vai direcionar automaticamente para o portfolio.
    $rota = $_GET['rota'] ?? 'portfolio';

    // Definindo a variavel de verificação  de metodo HTTP requisitado
    $metodo = $_SERVER ["REQUEST_METHOD"];

    // Verificando se a rota existe, se não existir, define status 404.
    if (!isset($rotas[$metodo][$rota])){
        http_response_code(404);
        echo "Página não encontrada!";
        exit;
    }

    // 
    [$controller, $acao] = $rotas[$metodo][$rota];


    //
    $controller->$acao();
?>