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
?>