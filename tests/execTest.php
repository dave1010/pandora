<?php

// Test the /exec endpoint

// Define the command to execute
$command = 'echo Hello, world!';

// Make the API request
$response = file_get_contents('http://localhost:8000/api/exec', false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query(['command' => $command]),
    ],
]));

// Decode the JSON response
$response = json_decode($response, true);

// Check the response
assert($response['output'] === "Hello, world!\n", 'Unexpected response from /exec endpoint.');

echo "Test passed!\n";
