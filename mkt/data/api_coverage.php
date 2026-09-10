<?php
require_once __DIR__ . '/../includes/firebase.php';
header('Content-Type: application/json');

$exp_names = firebase_get('/coverage/exp_names');
$raw_data = firebase_get('/coverage/raw_data');

echo json_encode([
    'exp_names' => $exp_names,
    'raw_data' => $raw_data
]);
exit;
