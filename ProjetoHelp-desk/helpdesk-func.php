<?php 

$nome = "";
$setor = "";
$prioridade = "";
$equipamento = "";

// 1. DECLARAR O CAMINHO DO ARQUIVO JSON 
$caminho = __DIR__ . "/chamados.json";

// 2. ABRIR/ LER O ARQUIVO JSON
$json = file_get_contents($caminho);

// 3. TRANSFORMAR JSPN EM ARRAY PHP
$funcionarios = json_decode($json, true);



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $acao = $_POST["acao"];

    if ($acao === "cadastrar") {
        // 4. CRIAR UM CHAMADO
        $novoFuncionario = [
            "nome" => $_POST["nome"],
            "setor" => $_POST["setor"],
            "prioridade" => $_POST["prioridade"],
            "equipamento" => $_POST["equipamento"]
        ];

        // 5. ADICIONAR O FUNCIONARIO NO ARRAY
        $funcionarios[] = $novoFuncionario;

        // 6. TRANSFORMAR ARRAY PHP EM JSON
        $jsonAtualizado = json_encode(
            $funcionarios,
            JSON_PRETTY_PRINT |
                JSON_UNESCAPED_UNICODE
        );

        // 7. SALVAR NO ARQUIVO
        file_put_contents($caminho, $jsonAtualizado);

        echo "DADOS REGISTRADOS EM dados.json";
    }


        // ATUALIZAR
    if ($acao === "atualizar") {

        // PEGAR OS DADOS DO FORMULÁRIO
        $nome = $_POST["nome"];
        $novoSetor = $_POST["setor"];
        $novaPrioridade = $_POST["prioridade"];
        $novoEquipamento =$_POST["equipamento"];

        // PERCORRER TODOS OS ALUNOS
        foreach($funcionarios as $posicao => $funcionario){
            if($funcionario ["nome"]== $nome){
                $funcionarios[$posicao]["setor"] = $novoSetor;
                $funcionarios[$posicao]["prioridade"] = $novaPrioridade;
                $funcionarios[$posicao]["Equipamento"] = $novoEquipamento;
            }
        }
        //  TRANSFORMAR ARRAY PHP EM JSON
        $jsonAtualizado = json_encode(
            $funcionarios,
            JSON_PRETTY_PRINT |
                JSON_UNESCAPED_UNICODE
        );

        //  SALVAR NO ARQUIVO
        file_put_contents($caminho, $jsonAtualizado);
    }


        // DELETAR
    if ($acao === "deletar") {
        $nome = $_POST["nome"];

        foreach($funcionarios as $posicao => $funcionario){
            if($funcionario["nome"] === $nome){
                unset($funcionario[$posicao]);
            }
        }

        $funcionarios= array_values($funcionarios);

    }
}

?>

