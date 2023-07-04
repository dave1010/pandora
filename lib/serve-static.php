<?php

$extension = pathinfo($path, PATHINFO_EXTENSION);
switch ($extension) {
    case 'json':
        header('Content-Type: application/json');
        break;
    case 'yaml':
        header('Content-Type: application/x-yaml');
        break;
    case 'png':
        header('Content-Type: image/png');
        break;
    case 'svg':
        header('Content-Type: image/svg+xml');
        break;
}

readfile($path);
