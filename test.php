<?php
header('Content-Type: application/json');
$jsonInput = file_get_contents("php://input");
echo json_encode([
    "received" => !empty($jsonInput),
    "raw_json" => $jsonInput
]);
?>
