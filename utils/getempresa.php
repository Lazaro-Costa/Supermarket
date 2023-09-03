<?php
header('Content-Type: application/json');

require_once('../class/empresa.php');
$empresa = new Empresa();

$nomesEmpresas = $empresa->getNomesEmpresas(); // Retorna apenas o nome das empresas

if (!empty($nomesEmpresas)) {
  // Exibir os nomes das empresas
  echo json_encode($nomesEmpresas);
} else {
  echo json_encode('Nenhuma empresa encontrada');
}