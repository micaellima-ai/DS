
<?php

require_once __DIR__ . "/../Models/Chamado.php";

class HelpdeskController
{
    // EXIBIR A PÁGINA
    public function index()
    {
        $model = new Chamado();

        $chamados = $model->listarChamados();
        $relatorio = $model->contarChamados();
        $mensagem = "";

        require __DIR__ . "/../../resources/views/projetos/helpdesk.php";
    }

    // PROCESSAR OS FORMULÁRIOS
    public function salvar()
    {
        $model = new Chamado();

        $acao = $_POST["acao"] ?? "";
        $sucesso = false;

        if ($acao === "cadastrar") {
            $sucesso = $model->cadastrarChamado(
                $_POST["nome"] ?? "",
                $_POST["setor"] ?? "",
                $_POST["equipamento"] ?? "",
                $_POST["descricao"] ?? "",
                $_POST["prioridade"] ?? ""
            );

            $mensagem = $sucesso
                ? "Chamado cadastrado com sucesso!"
                : "Erro ao cadastrar. Verifique os dados.";
        } elseif ($acao === "atualizar") {
            $sucesso = $model->atualizarChamado(
                (int) ($_POST["posicao"] ?? -1),
                $_POST["status"] ?? ""
            );

            $mensagem = $sucesso
                ? "Status atualizado com sucesso!"
                : "Não foi possível atualizar o status.";
        } elseif ($acao === "excluir") {
            $sucesso = $model->excluirChamado(
                (int) ($_POST["posicao"] ?? -1)
            );

            $mensagem = $sucesso
                ? "Chamado excluído com sucesso!"
                : "Não foi possível excluir o chamado.";
        } else {
            $mensagem = "Operação inválida.";
        }

        // Atualizar os dados exibidos
        $chamados = $model->listarChamados();
        $relatorio = $model->contarChamados();

        require __DIR__ . "/../../resources/views/projetos/helpdesk.php";
    }
}
