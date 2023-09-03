<?php
header('Content-Type: application/json');

$name = $_POST["nome_emp"];
$ende = $_POST["end"];
$cid = $_POST["cidade"];
$nLojas = $_POST["num_lojas"];

require '../class/empresa.php';

$empresa = new Empresa();

$cadEmpresa = $empresa->cadastrarEmpresa($name, $ende, $cid, $nLojas);

echo json_encode($cadEmpresa);
