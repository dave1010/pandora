<?php

require_once __DIR__ . '/../lib/functions.php';

$data = getJsonInput();
$command = $data['command'] ?? null;

if (!$command) {
    http_response_code(400);
    echo json_encode(['error' => 'No command provided.']);
    return;
}

if ($command[0] !== '/') {
    $command = 'cd ' . dirname(__DIR__) . '/WORKDIR && ' . $command;
}

$output = shell_exec($command);

echo json_encode(['output' => $output]);
