<?php

$guide = file_get_contents(__DIR__ . '/../the-guide.txt');

$otherGuides = scandir(__DIR__ . '/../guides');
array_shift($otherGuides); // .
array_shift($otherGuides); // ..

echo json_encode([
    'guide' => $guide,
    'other-guides' => $otherGuides,
]);