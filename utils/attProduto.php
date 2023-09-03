<?php
header('Content-Type: application/json');

$p_name = $_POST["nome_prod"];
$emp_name = $_POST["nome_emp"];
$preco = $_POST["preco"];
$quant = $_POST["prod_quant"];

require '../class/produto.php';

$produto = new Produto();

$attProduto = $produto->attProduto($p_name, $emp_name, $preco, $quant);

echo json_encode($attProduto);
