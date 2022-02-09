<?php
//arquivo de conexao com o banco de dados...

$host     = "localhost";
$usuario  = "root";
$senha    = "";
$dataBase = "db_finecrew";

$conexaoMysqli = new mysqli($host, $usuario, $senha, $dataBase);

if($conexaoMysqli->connect_errno)
    echo "Falha na conexão: ("  . $conexaoMysqli->connect_errno . ") " . $conexaoMysqli->connect_error;

?>