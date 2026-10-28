<?php
//================================
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL
//================================

// 1. CLASSE ABSTRATA
abstract class Maquina
{
    public $nome;
    private $producao;

    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->producao = 0;
    }

    //ENCAPSULAMENTO - GETTER
    public function getProducao()
    {
        return $this->producao;
    }

    //ENCAPSULAMENTO - GETTER
    public function registrarProducao($quantidade)
    {
        if ($quantidade <= 0) {
            return false;
        }

        $this->producao += $quantidade;
        return true;
    }

    // ABSTRAÇÃO
    abstract public function operar();
}

//2.HERANÇA
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
        return "Soldadndo peças...";
    }
}

// 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO
if (!isset($_SESSION["maquinas"])) {
    $_SESSION["maquinas"] = [];
}

$mensagem = "";

//4. RECEBER FORMULÁRIO VIA POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null;

    if (
        $nome === "" ||
        $quantidade === false ||
        $quantidade <= 0
    ) {
        $mensagem = "Preencha os campos corretamente!";
    } else {
        // CRIANDO OBJETOS COM BSE NO FORMULÁRIO
        if ($tipo === "esteira") {
            $maquina = new Esteira($nome);
        } elseif ($tipo === "prensa") {
            $maquina = new Prensa($nome);
        } elseif ($tipo === "robosoldagem") {
            $maquina = new RoboSoldagem($nome);
        }


        // EXECUTANDO OS MÉTODOS DO OBJETO
        $maquina->registrarProducao($quantidade);

        //GUARDANDO O OBJETO NA SESSÃO
        $_SESSION["maquina"][] = $maquina;

        $mensagem = "Máquina cadastrada com sucesso!";
    }
}


//.EVITAR INTERPRETAR TEXTOS COMO HTML
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
    <link rel="stylesheet" href="../css/poo.css">
    <title>Pogramação orientada a objeto</title>
</head>

<body>

    <div class="container">

        <div class="cabecalho">
            <h2>SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL</h2>
        </div>

        <div class="conteudo">

            <div class="formulario">

                <form action="" method="POST">

                    <div class="campo">
                        <label for="nome">Nome Maquina:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="campo">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="esteira">Esteira</option>
                            <option value="prensa">Prensa</option>
                            <option value="robosoldagem">Robo Soldagem</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" id="quantidade" name="quantidade" min="0" required>
                    </div>

                    <div class="campo">
                        <button type="submit" name="acao" value="cadastrar">
                            Cadastrar
                        </button>
                    </div>

                </form>

            </div>

            <?php if ($mensagem != "") { ?>

                <div class="mensagem">

                    <h3><?= $mensagem ?></h3>

                    <p>Nome Máquina: <?= escapar($nome) ?></p>
                    <p>Tipo: <?= escapar($tipo) ?></p>
                    <p>qtde.: <?= escapar($quantidade) ?></p>

                </div>

            <?php } ?>

        </div>

    </div>

</body>

</html>