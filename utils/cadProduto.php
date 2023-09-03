<?php
header('Content-Type: application/json');

$p_name = $_POST["nome_prod"];
$p_marca = $_POST["marca"];
$p_tamQuant = $_POST["tam_quant"];

require '../class/produto.php';

$produto = new Produto();

$cadProduto = $produto->cadastrarProduto($p_name, $p_marca, $p_tamQuant);

echo json_encode($cadProduto);
