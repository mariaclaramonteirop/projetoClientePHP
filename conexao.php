<?php
// Conexão com banco de dados do projeto Imáginario
$host = "localhost";
$db = "crud_clientes";
$user = "root";
$pass = "";

$mysqli = new mysqli($host,$user,$pass,$db);

if($mysqli->connect_errno){
    die("Falha na conexão com o Banco de Dados."); 
}

function formatar_data($data){
    return implode('/',array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone){
        $ddd = substr($telefone,0, 2);
        $parte1 =substr($telefone,2, 5);
        $parte2 = substr($telefone,7);
        return "($ddd) $parte1 - $parte2";
}
?>