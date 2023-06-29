<?php

// Test the /writeFile endpoint

// Define the file path and content
$filePath = __DIR__ . '/../sample-file.txt';
$content = 'Hello, world!';

// Make the API request
$response = file_get_contents('http://localhost:8000/api/writeFile', false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query(['filePath' => $filePath, 'content' => $content]),
    ],
]));

// Check the response
$responseData = json_decode($response, true);
assert($responseData['message'] === 'File written successfully.', 'Unexpected response from /writeFile endpoint.');

// Check the file content
assert(file_get_contents($filePath) === $content, 'Unexpected file content.');
