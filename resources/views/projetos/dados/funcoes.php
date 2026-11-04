<?php

function apresentarSistema()
{
    echo "Bem Vindo (a) ao Help Desk!";
}


apresentarSistema();


// ------------------------------- // 

function abrirChamado($nome, $problema)
{
    echo "$nome abriu um chamado: $problema";
}

abrirChamado("Micael", "Computador não esta ligando");

// ------------------------------- // 

function contarChamados($quantidades)
{
    return "Existem $quantidades chamados registrados";
}
$resultado = contarChamados(5);

// echo $resultado;

?>