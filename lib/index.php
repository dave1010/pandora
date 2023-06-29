<?php

$requestUri = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/(.*)$/', $requestUri, $matches)) {
    $apiEndpoint = $matches[1];
    if (file_exists(__DIR__ . "/../api/$apiEndpoint.php")) {
        header('Content-Type: application/json');
        require_once __DIR__."/../api/$apiEndpoint.php";
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found.']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Page not found.']);
}