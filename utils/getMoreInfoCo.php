<?php
header('Content-Type: application/json');

require '../class/empresa.php';

$nameEmp = $_POST["nome_emp"];

if (empty($nameEmp)) {
  echo json_encode('A variável Name nao foi definida');
} else {
  $empresa = new Empresa();

  $infoCompany = $empresa->getMoreInfoCo($nameEmp);

  if (!empty($infoCompany)) {
    echo json_encode($infoCompany);
  } else {
    echo json_encode('Nenhuma informacao encontrada');
  }
}
