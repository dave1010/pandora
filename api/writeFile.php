<?php

require_once '../lib/headers.php';

$postData = json_decode(file_get_contents('php://input'), true);

if (!isset($postData['filePath']) || !isset($postData['content'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing filePath or content parameter.']);
    exit;
}

$filePath = $postData['filePath'];
$content = $postData['content'];
$force = $postData['force'] ?? false;

// TODO: Write the content to the file, taking into account the force flag.