<?php

require_once __DIR__ . '/../lib/functions.php';

$data = getJsonInput();

$filePath = $data['filePath'];
$content = $data['content'];
$force = $data['force'] ?? false;

// Ensure all required parameters are provided
if (!$filePath || $content === null) {
    http_response_code(400);
    echo json_encode(['error' => 'filePath and content are required.']);
    return;
}

if ($filePath[0] !== '/') {
    $filePath = dirname(__DIR__) . '/WORKDIR/' . $filePath;
}

if (file_exists($filePath) && !$force) {
    http_response_code(400);
    echo json_encode(['error' => 'File already exists.']);
    return;
}

$newLine = ($data['appendNewlineAtEOF'] ?? false ? "\n" : "");

file_put_contents($filePath, $content . $newLine);

if (isset($data['permissions'])) {
    chmod($filePath, octdec($data['permissions']));
}

http_response_code(200);
echo json_encode(['message' => 'File written successfully.']);
