<?php
header('Content-Type: application/json');

require '../class/estoque.php';

$name = $_POST["nome_emp"];

if (empty($name)) {
  echo json_encode('A variável Name nao foi definida');
} else {
  $estoque = new Estoque();

  $nomesEstoque = $estoque->listarEstoque($name);

  if (!empty($nomesEstoque)) {
    // Exibir os nomes das empresas
    echo json_encode($nomesEstoque);
  } else {
    echo json_encode('Nenhuma empresa encontrada');
  }
}
