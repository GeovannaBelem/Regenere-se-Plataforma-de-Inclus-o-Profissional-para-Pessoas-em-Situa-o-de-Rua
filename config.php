<?php

session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'form_regenerese';

global $conexao; 

try{
    $conexao = new PDO("mysql:dbname=".$dbName."; host=".$dbHost,$dbUsername, $dbPassword);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e){
    echo "ERRO: ".$e->getMessage();
    exit;
}


/*if($conexao->connect_errno)
{
    echo "Erro";
}
else
{
    echo "Conexão efetuada com sucesso";
}

$conexao = new PDO('mysql:host=localhost ;dbname=form_regenerese', 'root', 'cimatec');*/

?>