<?php
$host = "localhost";
$banco = "micael315";
$usuario = "micael315";
$senha = "315!@#";


try{
    $pdo = new PDO("mysql:host=$host;ddname=$banco;charset=utf8mb4", $usuario, $senha);
    
    
    
    
    
    $pdo -> setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    echo "conectado com sucesso!";

} catch (PDOException $erro){

    echo "Erro ao conectar: ". $erro ->getMessage();

}
















?>