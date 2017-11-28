<?php

$conexao = pg_connect("host=localhost dbname=sm port=5432 user=sm_user password=9090") or die ("Não foi possível conectar ao servidor PostGreSQL");
$res= pg_query($conexao, "SELECT level FROM measure_level WHERE id = '1'");

$value = pg_fetch_array($res);
$level = $value['level'];

echo $level;
?>