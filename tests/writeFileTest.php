<?php

$filename = 'test-'.md5(time());
$content = 'Hello, World!';
$force = true;
$appendNewline = true;
$permissions = '0644';

$data = [
    'filePath' => $filename,
    'content' => $content,
    'force' => $force,
    'appendNewline' => $appendNewline,
    'permissions' => $permissions,
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n",
        'content' => json_encode($data),
    ],
];

$context = stream_context_create($options);
$result = json_decode(file_get_contents('http://localhost:8000/api/writeFile', false, $context), true);

assert($result['message'] === 'File written successfully.');

$localFile = dirname(__DIR__).'/WORKDIR/'.$filename;

assert(file_get_contents($localFile) === $content . "\n");
assert(substr(sprintf('%o', fileperms($localFile)), -4) === $permissions);

unlink($localFile);

echo "Test passed!\n";
