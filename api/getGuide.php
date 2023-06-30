<?php

$guide = file_get_contents(__DIR__ . '/../the-guide.txt');

echo json_encode([
    'guide' => $guide
]);