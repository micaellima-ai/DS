<?php

$host = "localhost";
$banco = "micael315";
$usuario = "micael315";
$senha = "315!@#";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $erro) {

    die("Erro ao conectar: " . $erro->getMessage());

}

?>