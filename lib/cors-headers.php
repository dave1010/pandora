<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, openai-conversation-id, openai-ephemeral-user-id');
header('Access-Control-Max-Age: 1728000');