<?php

require_once __DIR__ . '/../lib/functions.php';

$data = getJsonInput();
$command = $data['command'] ?? null;
$readGuide = $data['guideFollowed'] ?? false;

if (!$readGuide) {
    http_response_code(400);
    echo json_encode(['error' => 'The guide must have been read recently and followed.']);
    return;
}


if (!$command) {
    http_response_code(400);
    echo json_encode(['error' => 'No command provided.']);
    return;
}

if ($command[0] !== '/') {
    $command = 'cd ' . dirname(__DIR__) . '/WORKDIR && ' . $command;
}

$output = doExec($command);

if (isset($output['return_value']) && $output['return_value'] !== 0) {
    $output['help'] = 'VERY IMPORTANT: check the guide (getGuide) for how to fix problems before attempting something yourself!';
}

echo json_encode($output);
