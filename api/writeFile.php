<?php

require_once __DIR__ . '/../lib/headers.php';
require_once __DIR__ . '/../lib/functions.php';

// Extract the parameters from the request body
$filePath = $_POST['filePath'] ?? null;
$content = $_POST['content'] ?? null;
$force = $_POST['force'] ?? false;

// Ensure all required parameters are provided
if (!$filePath || $content === null) {
    http_response_code(400);
    echo json_encode(['error' => 'filePath and content are required.']);
    return;
}

// Check if the file already exists
if (file_exists($filePath) && !$force) {
    http_response_code(400);
    echo json_encode(['error' => 'File already exists.']);
    return;
}

// Write the content to the file
file_put_contents($filePath, $content);

// Return a success message
http_response_code(200);
echo json_encode(['message' => 'File written successfully.']);

// TODO: consider whether newline at end of file should be from content or an explicit flag to make it clear for the LLM

// TODO: add an optional flag for file permissions