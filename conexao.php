<?php 
session_start();
error_reporting(0);
/*
 * Método de conexão sem padrões
 */

$banco = "chamados";
$usuario_banco = "root";
$senha_banco = "";
 
$conexao = new PDO('mysql:host=localhost;dbname='.$banco, $usuario_banco, $senha_banco);
$conexao->exec("SET CHARACTER SET utf8");

//var_dump($conexao);