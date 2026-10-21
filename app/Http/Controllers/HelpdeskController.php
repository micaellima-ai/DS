<?php

// Caminho do arquivo JSON
$caminho = __DIR__ . "/chamados.json";

// LER OS CHAMADOS
function listarChamados()
{
    global $caminho;

    if (!file_exists($caminho)) {
        file_put_contents($caminho, "[]");
    }

    $json = file_get_contents($caminho);
    $chamados = json_decode($json, true);

    if (!is_array($chamados)) {
        return [];
    }

    return $chamados;
}

// SALVAR OS CHAMADOS
function salvarChamados($chamados)
{
    global $caminho;

    $json = json_encode(
        $chamados,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    return file_put_contents($caminho, $json) !== false;
}

// CADASTRAR CHAMADO
function cadastrarChamado($nome, $setor, $equipamento, $descricao, $prioridade)
{
    if (trim($nome) === "" || trim($descricao) === "") {
        return false;
    }

    $chamados = listarChamados();

    $novoChamado = [
        "nome" => $nome,
        "setor" => $setor,
        "equipamento" => $equipamento,
        "descricao" => $descricao,
        "prioridade" => $prioridade,
        "status" => "Aberto"
    ];

    $chamados[] = $novoChamado;

    return salvarChamados($chamados);
}

// ATUALIZAR STATUS
function atualizarChamado($posicao, $novoStatus)
{
    $statusPermitidos = [
        "Aberto",
        "Em andamento",
        "Resolvido"
    ];

    $chamados = listarChamados();

    if (!isset($chamados[$posicao])) {
        return false;
    }

    if (!in_array($novoStatus, $statusPermitidos, true)) {
        return false;
    }

    $chamados[$posicao]["status"] = $novoStatus;

    return salvarChamados($chamados);
}

// EXCLUIR CHAMADO
function excluirChamado($posicao)
{
    $chamados = listarChamados();

    if (!isset($chamados[$posicao])) {
        return false;
    }

    unset($chamados[$posicao]);

    $chamados = array_values($chamados);

    return salvarChamados($chamados);
}

// GERAR RELATÓRIO
function contarChamados()
{
    $chamados = listarChamados();

    $relatorio = [
        "total" => count($chamados),
        "abertos" => 0,
        "andamento" => 0,
        "resolvidos" => 0
    ];

    foreach ($chamados as $chamado) {
        if ($chamado["status"] === "Aberto") {
            $relatorio["abertos"]++;
        } elseif ($chamado["status"] === "Em andamento") {
            $relatorio["andamento"]++;
        } elseif ($chamado["status"] === "Resolvido") {
            $relatorio["resolvidos"]++;
        }
    }

    return $relatorio;
}
?>