<?php

require_once __DIR__ . '/cors-headers.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // CORS preflight
    http_response_code(200);
    die();
}

$dir = dirname(__DIR__);

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (file_exists($dir . '/api' . $path . '.php')) {
    error_log("API: $path");
    header('Content-Type: application/json');
    require_once $dir . '/api' . $path . '.php';
    exit;
}

if (file_exists($dir . '/public' . $path)) {
    $path = $dir . '/public' . $path;
    error_log("$path");
    require_once __DIR__ . '/serve-static.php';
    exit;
}

if (file_exists($dir . '/WORKDIR' . $path )) {
    $path = $dir . '/WORKDIR' . $path;
    error_log("$path");
    require_once __DIR__ . '/serve-static.php';
    exit;
}

error_log("[404]: ".$path);
http_response_code(404);
echo json_encode(['error' => 'API endpoint not found.']);
exit(1);
