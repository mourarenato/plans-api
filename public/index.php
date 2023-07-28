<?php

require_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    var_dump($_SERVER);
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    return;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['beneficiarios'], $data['idades'], $data['nomes'], $data['registro'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request data']);
    return;
}

$beneficiarios = $data['beneficiarios'];
$idades = $data['idades'];
$nomes = $data['nomes'];
$registro = $data['registro'];

if (!$idades || !$nomes || count($idades) !== $beneficiarios || count($nomes) !== $beneficiarios) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data format']);
    return;
}

$controller = new \App\Controller\PlansController($registro, $beneficiarios, $idades, $nomes);
$controller->buildJson();
