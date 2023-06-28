<?php

$requestUri = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/api\/(.*)$/', $requestUri, $matches)) {
    $apiEndpoint = $matches[1];
    if (file_exists("../api/$apiEndpoint.php")) {
        require_once "../api/$apiEndpoint.php";
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found.']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Page not found.']);
}