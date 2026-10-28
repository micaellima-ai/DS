
<?php
session_start();

// CLASSE ABSTRATA
abstract class Maquina
{
    public $nome;
    private $producao;

    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->producao = 0;
    }

    public function getProducao()
    {
        return $this->producao;
    }

    public function registrarProducao($quantidade)
    {
        if ($quantidade <= 0) {
            return false;
        }

        $this->producao += $quantidade;
        return true;
    }

    abstract public function operar();
}

// HERANÇA
class Esteira extends Maquina
{
    public function operar()
    {
        return "Transportando peças...";
    }
}

class Prensa extends Maquina
{
    public function operar()
    {
        return "Prensando peças...";
    }
}

class RoboSoldagem extends Maquina
{
    public function operar()
    {
        return "Soldando peças...";
    }
}

// INICIALIZAÇÃO DA SESSÃO
if (!isset($_SESSION["maquinas"])) {
    $_SESSION["maquinas"] = [];
}

$mensagem = "";
$nome = "";
$tipo = "";
$quantidade = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = filter_input(
        INPUT_POST,
        "quantidade",
        FILTER_VALIDATE_INT
    );

    if (
        $nome === "" ||
        $quantidade === false ||
        $quantidade === null ||
        $quantidade <= 0
    ) {
        $mensagem = "Preencha os campos corretamente!";
    } else {
        // CRIAÇÃO DOS OBJETOS
        if ($tipo === "esteira") {
            $maquina = new Esteira($nome);
        } elseif ($tipo === "prensa") {
            $maquina = new Prensa($nome);
        } elseif ($tipo === "robosoldagem") {
            $maquina = new RoboSoldagem($nome);
        } else {
            $maquina = null;
        }

        if ($maquina !== null) {
            $maquina->registrarProducao($quantidade);

            $_SESSION["maquinas"][] = $maquina;

            $mensagem = "Máquina cadastrada com sucesso!";
        } else {
            $mensagem = "Selecione um tipo de máquina válido!";
        }
    }
}

// PROTEÇÃO CONTRA HTML INJETADO
function escapar($texto)
{
    return htmlspecialchars(
        (string) $texto,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Controle de Produção</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Controle de Produção</h1>
            <p>Sistema de Controle de Produção Industrial</p>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="conteudo">

            <div class="titulo-formulario">
                <h2>Cadastrar Máquina</h2>
                <p>Preencha os dados da máquina industrial.</p>
            </div>

            <!-- FORMULÁRIO -->
            <div class="formulario">
                <form action="" method="POST">

                    <div class="campo">
                        <label for="nome">Nome da máquina</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Ex.: Máquina 01"
                            required
                            value="<?= escapar($nome) ?>"
                        >
                    </div>

                    <div class="campo">
                        <label for="tipo">Tipo de máquina</label>
                        <select id="tipo" name="tipo" required>
                            <option value="">Selecione uma máquina</option>

                            <option value="esteira"
                                <?= $tipo === "esteira" ? "selected" : "" ?>>
                                Esteira
                            </option>

                            <option value="prensa"
                                <?= $tipo === "prensa" ? "selected" : "" ?>>
                                Prensa
                            </option>

                            <option value="robosoldagem"
                                <?= $tipo === "robosoldagem" ? "selected" : "" ?>>
                                Robô de Soldagem
                            </option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="quantidade">Quantidade produzida</label>
                        <input
                            type="number"
                            id="quantidade"
                            name="quantidade"
                            min="1"
                            step="1"
                            placeholder="Ex.: 100"
                            required
                            value="<?= escapar($quantidade) ?>"
                        >
                    </div>

                    <div class="campo">
                        <button type="submit" name="acao" value="cadastrar">
                            Cadastrar Máquina
                        </button>
                    </div>

                </form>
            </div>

            <!-- MENSAGEM DO SISTEMA -->
            <?php if ($mensagem !== ""): ?>
                <div class="mensagem <?= isset($maquina) && $maquina !== null && $mensagem === "Máquina cadastrada com sucesso!" ? "sucesso" : "erro" ?>">
                    <?= escapar($mensagem) ?>
                </div>
            <?php endif; ?>

            <!-- DADOS DO CADASTRO -->
            <?php if (
                $mensagem === "Máquina cadastrada com sucesso!" &&
                isset($maquina) &&
                $maquina !== null
            ): ?>

                <div class="resultado">
                    <h2>Máquina cadastrada</h2>

                    <div class="info">
                        <span>Nome da máquina</span>
                        <strong><?= escapar($maquina->nome) ?></strong>
                    </div>

                    <div class="info">
                        <span>Tipo</span>
                        <strong><?= escapar($tipo === "esteira" ? "Esteira" : ($tipo === "prensa" ? "Prensa" : "Robô de Soldagem")) ?></strong>
                    </div>

                    <div class="info">
                        <span>Quantidade produzida</span>
                        <strong><?= escapar($maquina->getProducao()) ?> peças</strong>
                    </div>

                    <div class="info">
                        <span>Status da operação</span>
                        <strong><?= escapar($maquina->operar()) ?></strong>
                    </div>
                </div>

            <?php endif; ?>

        </div>

        <!-- RODAPÉ -->
        <div class="rodape">
            <p>Sistema de Controle de Produção Industrial</p>
        </div>

    </div>

</body>
</html>
