<?php

// READ - ler todos os chamados
function lerChamados()
{
    $arquivo = __DIR__ . "./chamados.json";

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, "[]");
    }

    //ler o arquivo
    $conteudo = (file_get_contents($arquivo));


    //converter o JSON para ARRAY PHP
    $chamados = json_decode($conteudo, true);

    return is_array($chamados) ? $chamados : []; //IF de um forma resumida
}

// SALVAR os chamados no JSON 
function salvarChamados($chamados)
{
    $arquivo = __DIR__ . "/../dados/chamados.json";

    return file_put_contents(
        $arquivo,
        json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    ) !== false;
}

// CREATE - Cadastrar chamados
function cadastrarChamados($nome, $setor, $equipamento, $descricao, $prioridade)
{
    if (trim($nome) === "" || trim($descricao) === "") {
        return false;
    }

    $chamados = lerChamados();

    $novoChamado = [
        "nome" => trim($nome),
        "setor" => ($setor),
        "equipamento" => ($equipamento),
        "descrição" => trim($descricao),
        "prioridade" => ($prioridade),
        "status" => "Aberto"
    ];

    $chamados[] = $novoChamado;

    return salvarChamados($chamados);
}

// UPDADATE - Atualizar status do chamado
function atualizarChamados($posicao, $novoStatus)
{
    $chamados = lerChamados();

    $statusPermitidos = [
        "Aberto",
        "Em andamento",
        "Resolvido"
    ];

    //isset() verifica se uma variavel ou posição existe e não contém null       
    if (!isset($chamados[$posicao])) {
        return false;
    }

    //in_array() verifica se um valor existe dentro de um array
    if (!in_array($novoStatus, $statusPermitidos, true)) {
        return false;
    }

    $chamados[$posicao]["status"] = $novoStatus;
    return salvarChamados($chamados);
}

//DELETE - Excluir chamados 
function deletarChamados($posicao)
{

    $chamados = lerChamados();

    if (!isset($chamados[$posicao])) {
        return false;
    }

    unset($chamados[$posicao]);

    $chamados = array_values($chamados);

    return salvarChamados($chamados);
}

//Relatorio de atendimentos
function gerarChamados()
{
    $chamados = lerChamados();

    $relatorio = [
        "total" => count($chamados),
        "abertos" => 0,
        "andamento" => 0,
        "resolvidos" => 0
    ];

    foreach ($chamados as $chamado) {
        if ($chamado["status"] === "Aberto") {
            $relatorio["Aberto"]++;
        } elseif ($chamado["status"] === "Em andamento") {
            $relatorio["andamento"]++;
        } elseif ($chamado["status"] === "Resolvido") {
            $relatorio["resolvidos"]++;
        }
    }
    return $relatorio;
}

?>