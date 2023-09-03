<?php
header('Content-Type: application/json');

require '../class/estoque.php';

$nameEmp = $_POST["nome_emp"];
$nameProd = $_POST["nome_prod"];

if (empty($nameEmp)) {
  echo json_encode('A variável Name nao foi definida');
} else {
  $estoque = new Estoque();

  $nomesEstoque = $estoque->getMore($nameEmp, $nameProd);

  if (!empty($nomesEstoque)) {
    echo json_encode($nomesEstoque);
  } else {
    echo json_encode('Nenhuma empresa encontrada');
  }
}
