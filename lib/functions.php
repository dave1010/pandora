<?php

function getJsonInput()
{
    $requestBody = file_get_contents('php://input');
    $data = json_decode($requestBody, true); // true to get an associative array

    if (json_last_error() !== JSON_ERROR_NONE) {
        // Invalid JSON, handle the error
        echo json_encode(['error' => 'Invalid JSON in request body']);
        exit;
    }

    return $data;
}
