<?php

 require_once __DIR__ . "/funcoes-help.php";

$mensagem = "";

//identificar a operação solicitada
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    if ($acao === "cadastrar") {
        $sucesso = cadastrarChamados(
            $_POST["nome"] ?? "",
            $_POST["setor"] ?? "",
            $_POST["equipamento"] ?? "",
            $_POST["descricao"] ?? "",
            $_POST["prioridade"] ?? ""
        );
        $mensagem = $sucesso ? "Chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique os dados.";
    }

    if ($acao === "atualizar") {
        // O (INT) é uma conversão de tipo, também chamada de type casting.
        // Ele tenta transformar o valor em um numero inteiro
        $sucesso = atualizarChamado(
            (int) ($_POST["posicao"] ?? -1),
            $_POST["status"] ?? ""
        );
        $mensagem = $sucesso ? "Status atualizado!" : "Não foi possível atualizar";
    }

    if ($acao === "excluir") {
        $sucesso = excluirChamado((int) ($_POST["posicao"] ?? -1));

        $mensagem = $sucesso ? "Chamado exluído!" : "Não foi possível excluir";
    }
}

$chamados = lerChamados();
$relatorio = gerarChamados();

//Evitar exibir HTML enviado pelo usuário
function escapar($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
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
    <h2>Cadastrar chamado</h2>

    <form method="POST">

        <label>Nome do funcionário:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>Setor:</label>
        <select name="setor" required>
            <option value="Produção">Produção</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Logística">Logística</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Enfermagem">Enfermaria</option>
            <option value="TI">TI</option>
        </select>
        <br><br>

        <label>Equipamento:</label>
        <select name="equipamento" required>
            <option value="Computador">Computador</option>
            <option value="Impressora">Impressora</option>
            <option value="Rede">Rede</option>
            <option value="Sistema">Sistema</option>
            <option value="Outro">Outro</option>
        </select>
        <br><br>

        <label>Descrição do problema:</label>
        <br>
        <textarea name="descricao" required></textarea>
        <br><br>

        <label>Prioridade:</label>
        <select name="prioridade" required>
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select>
        <br><br>

        <button type="submit" name="acao" value="cadastrar">
            Cadastrar chamado
        </button>

    </form>

    <hr>
    <h2><?= $mensagem ?> </h2>

    <div class="res">
        <h2>Relatório de atendimentos</h2>

        <p>Total de chamados: <?= $relatorio["total"] ?></p>
        <p>Chamados abertos: <?= $relatorio["abertos"] ?></p>
        <p>Chamados em andamento: <?= $relatorio["andamento"] ?></p>
        <p>Chamados resolvidos: <?= $relatorio["resolvidos"] ?></p>

        <hr>

        <h2>Lista de chamados</h2>

        <?php  if (count($chamados) === 0) { ?>

            <p>Nenhum chamado cadastrado.</p>

        <?php  } else { ?>

            <?php  foreach ($chamados as $posicao => $chamado) { ?>

                <h3>Chamado nº <?= $posicao + 1 ?></h3>

                <p><strong>Solicitante:</strong><?= htmlspecialchars($chamado["nome"], ENT_QUOTES, "UTF-8") ?></p>

                <p><strong>Setor:</strong><?= htmlspecialchars($chamado["setor"], ENT_QUOTES, "UTF-8") ?></p>

                <p><strong>Equipamento:</strong><?= htmlspecialchars($chamado["equipamento"], ENT_QUOTES, "UTF-8") ?> </p>

                <p><strong>Descrição:</strong><?= htmlspecialchars($chamado["descricao"], ENT_QUOTES, "UTF-8") ?></p>

                <p><strong>Prioridade:</strong><?= htmlspecialchars($chamado["prioridade"], ENT_QUOTES, "UTF-8") ?></p>

                <p><strong>Status:</strong><?= htmlspecialchars($chamado["status"], ENT_QUOTES, "UTF-8") ?></p>

                <!-- ATUALIZAR STATUS -->
                <form method="POST">

                    <input type="hidden" name="posicao" value="<?= $posicao ?>">

                    <label>Alterar status:</label>

                    <select name="status" required>
                        <option value="Aberto">Aberto</option>
                        <option value="Em andamento">Em andamento</option>
                        <option value="Resolvido">Resolvido</option>
                    </select>

                    <button type="submit" name="acao" value="atualizar">
                        Atualizar
                    </button>

                </form>

                <!-- EXCLUIR CHAMADO -->
                <form method="POST">

                    <input type="hidden" name="posicao" value="<?= $posicao ?>">

                    <button type="submit" name="acao" value="deletar">
                        Excluir chamado
                    </button>

                </form>

                <hr>

            <?php } ?>

        <?php  } ?>

    </div>


    <br><br>
    <a href="../index.php"> ← Voltar</a>

</body>

</html>