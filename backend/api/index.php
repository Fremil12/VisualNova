<?php
header("Content-Type: application/json");
require './config/config.php';
require './config/db.php';

// Define project base folder (adjust as needed)
$baseFolder = './backend/api';

// Remove base folder from request URI
$uri = str_replace($baseFolder, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$uriParts = array_values(array_filter(explode('/', $uri)));

$endpoint = $uriParts[0] ?? ''; // Get endpoint (e.g., 'users')
$method = $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN';
$id = $_GET['id'] ?? null;

$endpointFile = $baseFolder . '\endpoints\\' . strtolower($endpoint) . '.php';

// Debugging Output (Remove in production)
error_log("Endpoint: $endpoint, Method: $method");

var_dump($endpointFile);
if (file_exists($endpointFile)) {
    require $endpointFile;
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint not found"]);
}
?>
