<?php

$guide = file_get_contents(__DIR__ . '/../the-llms-guide-to-effective-text-editing.txt');

$apiResponse = file_get_contents('http://localhost:8000/api/getGuide');
$apiResponse = json_decode($apiResponse, true);

assert($apiResponse['guide'] === $guide, 'Guide from API does not match guide file');

echo "Test passed!\n";
