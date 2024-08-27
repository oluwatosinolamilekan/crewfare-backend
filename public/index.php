<?php

header("Access-Control-Allow-Origin: *"); // Allow all origins (replace * with specific domains if needed)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

require '../vendor/autoload.php';

use App\Service\Router;

// Initialize the router with the routes from web.php
$router = new Router(require '../routes/web.php');

// Dispatch the request
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Handle preflight requests
if ($requestMethod === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$response = $router->dispatch($requestMethod, $requestUri);

// Set response headers for JSON and output the response
header('Content-Type: application/json');
echo $response;
