<?php
//ini_set('display_errors', 0 );
//error_reporting(0);
$level = $_GET['level'];

$conexao = pg_connect("host=localhost dbname=sm port=5432 user=sm_user password=9090") or die ("Não foi possível conectar ao servidor PostGreSQL");
$result=pg_exec($conexao, "UPDATE measure_level SET level = '$level' WHERE id='1';");
echo "Limite alterado com sucesso!";
?>