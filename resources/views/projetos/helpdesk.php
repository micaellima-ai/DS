
<?php
function escapar($valor)
{
    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES,
        "UTF-8"
    );
}

$acaoUrl = $_SERVER["SCRIPT_NAME"] . "?rota=helpdesk";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="resources/css/helpdesk.css">

    <title>Helpdesk - Chamados</title>
</head>

<body>

    <h1>Helpdesk</h1>

    <h2>Cadastrar chamado</h2>

    <form action="<?= escapar($acaoUrl) ?>" method="POST">

        <label for="nome">Nome do funcionário:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="setor">Setor:</label>
        <select id="setor" name="setor" required>
            <option value="Produção">Produção</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Logística">Logística</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Enfermagem">Enfermaria</option>
            <option value="TI">TI</option>
        </select>
        <br><br>

        <label for="equipamento">Equipamento:</label>
        <select id="equipamento" name="equipamento" required>
            <option value="Computador">Computador</option>
            <option value="Impressora">Impressora</option>
            <option value="Rede">Rede</option>
            <option value="Sistema">Sistema</option>
            <option value="Outro">Outro</option>
        </select>
        <br><br>

        <label for="descricao">Descrição do problema:</label>
        <br>
        <textarea id="descricao" name="descricao" required></textarea>
        <br><br>

        <label for="prioridade">Prioridade:</label>
        <select id="prioridade" name="prioridade" required>
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

    <?php if (!empty($mensagem)): ?>
        <p role="status">
            <?= escapar($mensagem) ?>
        </p>
    <?php endif; ?>

    <section class="res">

        <h2>Relatório de atendimentos</h2>

        <p>Total de chamados:
            <?= (int) $relatorio["total"] ?>
        </p>

        <p>Chamados abertos:
            <?= (int) $relatorio["abertos"] ?>
        </p>

        <p>Chamados em andamento:
            <?= (int) $relatorio["andamento"] ?>
        </p>

        <p>Chamados resolvidos:
            <?= (int) $relatorio["resolvidos"] ?>
        </p>

        <hr>

        <h2>Lista de chamados</h2>

        <?php if (count($chamados) === 0): ?>

            <p>Nenhum chamado cadastrado.</p>

        <?php else: ?>

            <?php foreach ($chamados as $posicao => $chamado): ?>

                <article class="chamado">

                    <h3>Chamado nº <?= (int) $posicao + 1 ?></h3>

                    <p>
                        <strong>Solicitante:</strong>
                        <?= escapar($chamado["nome"] ?? "") ?>
                    </p>

                    <p>
                        <strong>Setor:</strong>
                        <?= escapar($chamado["setor"] ?? "") ?>
                    </p>

                    <p>
                        <strong>Equipamento:</strong>
                        <?= escapar($chamado["equipamento"] ?? "") ?>
                    </p>

                    <p>
                        <strong>Descrição:</strong>
                        <?= escapar($chamado["descricao"] ?? "") ?>
                    </p>

                    <p>
                        <strong>Prioridade:</strong>
                        <?= escapar($chamado["prioridade"] ?? "") ?>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <?= escapar($chamado["status"] ?? "Aberto") ?>
                    </p>

                    <!-- ATUALIZAR STATUS -->
                    <form action="<?= escapar($acaoUrl) ?>" method="POST">

                        <input type="hidden"
                               name="posicao"
                               value="<?= (int) $posicao ?>">

                        <label for="status-<?= (int) $posicao ?>">
                            Alterar status:
                        </label>

                        <select id="status-<?= (int) $posicao ?>"
                                name="status" required>

                            <option value="Aberto"
                                <?= ($chamado["status"] ?? "") === "Aberto" ? "selected" : "" ?>>
                                Aberto
                            </option>

                            <option value="Em andamento"
                                <?= ($chamado["status"] ?? "") === "Em andamento" ? "selected" : "" ?>>
                                Em andamento
                            </option>

                            <option value="Resolvido"
                                <?= ($chamado["status"] ?? "") === "Resolvido" ? "selected" : "" ?>>
                                Resolvido
                            </option>

                        </select>

                        <button type="submit"
                                name="acao"
                                value="atualizar">
                            Atualizar status
                        </button>

                    </form>

                    <!-- EXCLUIR CHAMADO -->
                    <form action="<?= escapar($acaoUrl) ?>"
                          method="POST"
                          onsubmit="return confirm('Deseja realmente excluir este chamado?');">

                        <input type="hidden"
                               name="posicao"
                               value="<?= (int) $posicao ?>">

                        <button type="submit"
                                name="acao"
                                value="excluir">
                            Excluir chamado
                        </button>

                    </form>

                    <hr>

                </article>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

    <p>
        <a href="index.php">← Voltar</a>
    </p>

</body>
</html>
