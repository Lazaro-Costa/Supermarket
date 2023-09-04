<?php
header('Content-Type: application/json');

require_once('../class/empresa.php');
$empresa = new Empresa();

$showComp = $empresa->showCompanies(); // Retorna informações básicas das empresas

if (!empty($showComp)) {
  // Exibir os nomes das empresas
  echo json_encode($showComp);
} else {
  echo json_encode('Nenhuma empresa encontrada');
}
