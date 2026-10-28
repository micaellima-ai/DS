
<?php

class Chamado
{
    private $caminho;

    public function __construct()
    {
        $this->caminho = __DIR__ . "/../../storage/data/chamados.json";

        $pasta = dirname($this->caminho);

        if (!is_dir($pasta)) {
            mkdir($pasta, 0775, true);
        }

        if (!file_exists($this->caminho)) {
            file_put_contents($this->caminho, "[]");
        }
    }

    // LER OS CHAMADOS
    public function listarChamados()
    {
        if (!is_readable($this->caminho)) {
            return [];
        }

        $json = file_get_contents($this->caminho);
        $chamados = json_decode($json, true);

        return is_array($chamados) ? $chamados : [];
    }

    // SALVAR OS CHAMADOS
    public function salvarChamados($chamados)
    {
        $json = json_encode(
            array_values($chamados),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        if ($json === false) {
            return false;
        }

        return file_put_contents(
            $this->caminho,
            $json,
            LOCK_EX
        ) !== false;
    }

    // CADASTRAR CHAMADO
    public function cadastrarChamado(
        $nome,
        $setor,
        $equipamento,
        $descricao,
        $prioridade
    ) {
        $nome = trim($nome);
        $setor = trim($setor);
        $equipamento = trim($equipamento);
        $descricao = trim($descricao);
        $prioridade = trim($prioridade);

        if (
            $nome === "" ||
            $setor === "" ||
            $equipamento === "" ||
            $descricao === "" ||
            $prioridade === ""
        ) {
            return false;
        }

        $setoresPermitidos = [
            "Produção",
            "Administrativo",
            "Logística",
            "Financeiro",
            "Enfermagem",
            "TI"
        ];

        $equipamentosPermitidos = [
            "Computador",
            "Impressora",
            "Rede",
            "Sistema",
            "Outro"
        ];

        $prioridadesPermitidas = [
            "Baixa",
            "Média",
            "Alta"
        ];

        if (
            !in_array($setor, $setoresPermitidos, true) ||
            !in_array($equipamento, $equipamentosPermitidos, true) ||
            !in_array($prioridade, $prioridadesPermitidas, true)
        ) {
            return false;
        }

        $chamados = $this->listarChamados();

        $chamados[] = [
            "nome" => $nome,
            "setor" => $setor,
            "equipamento" => $equipamento,
            "descricao" => $descricao,
            "prioridade" => $prioridade,
            "status" => "Aberto"
        ];

        return $this->salvarChamados($chamados);
    }

    // ATUALIZAR STATUS
    public function atualizarChamado($posicao, $novoStatus)
    {
        $statusPermitidos = [
            "Aberto",
            "Em andamento",
            "Resolvido"
        ];

        $chamados = $this->listarChamados();

        if (
            !isset($chamados[$posicao]) ||
            !in_array($novoStatus, $statusPermitidos, true)
        ) {
            return false;
        }

        $chamados[$posicao]["status"] = $novoStatus;

        return $this->salvarChamados($chamados);
    }

    // EXCLUIR CHAMADO
    public function excluirChamado($posicao)
    {
        $chamados = $this->listarChamados();

        if (!isset($chamados[$posicao])) {
            return false;
        }

        unset($chamados[$posicao]);

        return $this->salvarChamados(array_values($chamados));
    }

    // GERAR RELATÓRIO
    public function contarChamados()
    {
        $chamados = $this->listarChamados();

        $relatorio = [
            "total" => count($chamados),
            "abertos" => 0,
            "andamento" => 0,
            "resolvidos" => 0
        ];

        foreach ($chamados as $chamado) {
            $status = $chamado["status"] ?? "";

            if ($status === "Aberto") {
                $relatorio["abertos"]++;
            } elseif ($status === "Em andamento") {
                $relatorio["andamento"]++;
            } elseif ($status === "Resolvido") {
                $relatorio["resolvidos"]++;
            }
        }

        return $relatorio;
    }
}
