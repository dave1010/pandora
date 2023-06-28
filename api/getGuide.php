<?php

require_once '../lib/headers.php';

$guide = file_get_contents('../the-llms-guide-to-effective-text-editing.txt');

echo json_encode(['guide' => $guide]);