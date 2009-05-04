<?php

$servidor='localhost'; //servidor padrão = localhost
$bd='megacreddb'; //banco de dados
$usuario='megacreddb'; //usuario de autenticação do banco de dados
$senha='mega1010'; //senha do usuario do banco de dados

//######################################################
$conectar = @mysql_connect($servidor,$usuario,$senha)
or die ("Não foi possível se conectar ao banco.");

mysql_select_db($bd)
or die ("Não foi possível encontrar o banco de dados.");
//######################################################


?>
