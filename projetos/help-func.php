<?php

    require_once "funcoes-help.php";

    $mensagem = "";

    //identificar a operação solicitada
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $acao = $_POST ["acao"] ?? "";

        if($acao === "cadastrar"){
            $sucesso = cadastrarChamado(
                $_POST["nome"] ?? "",
                $_POST["setor"] ?? "",
                $_POST["equipamento"] ?? "",
                $_POST["descricao"] ?? "",
                $_POST["prioridade"] ?? ""
            ); 
            $mensagem = $sucesso ? "Chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique os dados.";
        }

        if($acao === "atualizar"){
            $sucesso = atualizarChamado(
                (int) ($_POST["posicao"] ?? -1),
                $_POST["status"] ?? ""
            );
            $mensagem = $sucesso ? "Status atualizado!" : "Não foi possível atualizar";

     }

     if($acao === "excluir"){
        $posicao = filter_var(
            $_POST["posicao"] ?? "",
            FILTER_VALIDATE_INT
        );
     }


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
    
</body>
</html>