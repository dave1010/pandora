<?php

require_once __DIR__ . '/../lib/headers.php';
require_once __DIR__ . '/../lib/functions.php';

// Read the guide file
$guide = file_get_contents(__DIR__ . '/../the-llms-guide-to-effective-text-editing.txt');

// Return the guide
http_response_code(200);
header('Content-Type: text/plain');
echo $guide;
