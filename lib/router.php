<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, openai-conversation-id, openai-ephemeral-user-id');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = dirname(__DIR__) . '/public' . $path;

if (file_exists($path)) {

    $extension = pathinfo($path, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'json':
            header('Content-Type: application/json');
            break;
        case 'yaml':
            header('Content-Type: application/x-yaml');
            break;
    }

    readfile($path);
    exit;
}

include_once __DIR__ . '/index.php';
