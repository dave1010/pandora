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

function doExec($command)
{
    $descriptorspec = array(
        0 => array("pipe", "r"),  // stdin
        1 => array("pipe", "w"),  // stdout
        2 => array("pipe", "w")   // stderr
     );
     
    $process = proc_open($command, $descriptorspec, $pipes);
     
    if (!is_resource($process)) {
        return ['error' => 'Could not create process resource'];
    }

    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);

    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    $return_value = proc_close($process);

    return [
        'stdout' => $stdout,
        'stderr' => $stderr,
        'return_value' => $return_value,
    ];
     
}