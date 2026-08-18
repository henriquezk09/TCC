<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'meu_site';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
// Define o charset para evitar problemas com acentuação
$conexao->set_charset("utf8mb4");
?>