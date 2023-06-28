<?php

require_once '../lib/headers.php';

$postData = json_decode(file_get_contents('php://input'), true);

if (!isset($postData['command'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing command parameter.']);
    exit;
}

$command = $postData['command'];

// TODO: Execute the command and return the result.