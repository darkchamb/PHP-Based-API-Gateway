<?php
// gateway.php

// Check for the presence of API key (this can be expanded later)
$valid_api_keys = ['key123' => 'UserA', 'key456' => 'UserB'];

$request_path = isset($_GET['request_path']) ? $_GET['request_path'] : '';

$api_key = null;
if (isset($_SERVER['HTTP_X_API_KEY'])) {
    $api_key = $_SERVER['HTTP_X_API_KEY'];
}

// Check if the API key is valid
if (!in_array($api_key, array_keys($valid_api_keys))) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Invalid or missing API Key']);
    exit;
}

// Simple routing logic
switch ($request_path) {
    case 'users':
        include('services/service_users.php');
        break;
    case 'products':
        include('services/service_products.php');
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'API endpoint not found']);
        break;
}
?>
