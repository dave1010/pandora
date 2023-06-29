<?php

require_once __DIR__ . '/../lib/headers.php';
require_once __DIR__ . '/../lib/functions.php';

$data = getJsonInput();

$filePath = $data['filePath'];
$content = $data['content'];
$force = $data['force'];
$appendNewline = $data['appendNewline'] ?? false;
$permissions = $data['permissions'];

// Ensure all required parameters are provided
if (!$filePath || $content === null) {
    http_response_code(400);
    echo json_encode(['error' => 'filePath and content are required.']);
    return;
}

if ($filePath[0] !== '/') {
    $filePath = dirname(__DIR__) . '/WORKDIR/' . $filePath;
}

// Check if the file already exists
if (file_exists($filePath) && !$force) {
    http_response_code(400);
    echo json_encode(['error' => 'File already exists.']);
    return;
}

// Write the content to the file
file_put_contents($filePath, $content);

if ($appendNewline) {
    file_put_contents($filePath, "\n", FILE_APPEND);
}

// Change the file permissions if the flag is set
if ($permissions !== null) {
    chmod($filePath, octdec($permissions));
}

// Return a success message
http_response_code(200);
echo json_encode(['message' => 'File written successfully.']);
