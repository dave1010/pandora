<?php

// Test the /getGuide endpoint

// Make the API request
$response = file_get_contents('http://localhost:8000/api/getGuide');

// Check the response
assert(strpos($response, 'The LLM\'s Guide to Effective Text Editing') !== false, 'Unexpected response from /getGuide endpoint.');
