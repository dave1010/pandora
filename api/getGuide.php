<?php

$guide = file_get_contents(__DIR__ . '/../the-llms-guide-to-effective-text-editing.txt');

echo json_encode([
    'guide' => $guide
]);