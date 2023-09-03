<?php
header('Content-Type: application/json');

require_once('../class/produto.php');
$emp = $_POST["nome_emp"];
$produto = new Produto();

$nomesProduto = $produto->listarProdutos($emp);

if (!empty($nomesProduto)) {
  // Exibir os nomes das empresas
  echo json_encode($nomesProduto);
} else {
  echo json_encode('Nenhuma empresa encontrada');
}
